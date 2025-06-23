<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems.product'])->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'shipping_address' => $request->shipping_address,
                'status' => 'pending',
                'total_amount' => 0
            ]);

            $total = 0;
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi");
                }

                $orderItem = $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);

                $product->decrement('stock', $item['quantity']);
                $total += $product->price * $item['quantity'];
            }

            $order->update(['total_amount' => $total]);
            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'orderItems.product']);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Hanya transaksi dengan status pending yang dapat diubah');
        }

        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Hanya transaksi dengan status pending yang dapat diubah');
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_address' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            // Kembalikan stok produk yang ada
            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                $product->increment('stock', $item->quantity);
            }

            // Hapus order items yang ada
            $order->orderItems()->delete();

            // Update order
            $order->update([
                'customer_id' => $request->customer_id,
                'shipping_address' => $request->shipping_address,
                'total_amount' => 0
            ]);

            // Buat order items baru
            $total = 0;
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi");
                }

                $orderItem = $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);

                $product->decrement('stock', $item['quantity']);
                $total += $product->price * $item['quantity'];
            }

            $order->update(['total_amount' => $total]);
            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Transaksi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Hanya transaksi dengan status pending yang dapat dihapus');
        }

        DB::beginTransaction();
        try {
            // Kembalikan stok produk
            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                $product->increment('stock', $item->quantity);
            }

            // Hapus order items
            $order->orderItems()->delete();

            // Hapus order
            $order->delete();
            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        if ($request->status === 'cancelled' && $order->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya transaksi dengan status pending yang dapat dibatalkan');
        }

        DB::beginTransaction();
        try {
            if ($request->status === 'cancelled') {
                // Kembalikan stok produk
                foreach ($order->orderItems as $item) {
                    $product = Product::find($item->product_id);
                    $product->increment('stock', $item->quantity);
                }
            }

            $order->update(['status' => $request->status]);
            DB::commit();

            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
