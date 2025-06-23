<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Order - Tiara Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .brand-gradient {
            background: linear-gradient(90deg, #a78bfa 0%, #f472b6 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-50 to-indigo-100 min-h-screen">
    <div class="max-w-6xl mx-auto py-10">
        <nav class="flex space-x-4 mb-8 sticky top-0 z-10 bg-white/80 backdrop-blur rounded shadow px-4 py-2">
            <a href="/dashboard" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:brand-gradient hover:text-white transition font-semibold"><i class="fa fa-home mr-1"></i>Dashboard</a>
            <a href="/products" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:brand-gradient hover:text-white transition font-semibold"><i class="fa fa-box mr-1"></i>Produk</a>
            <a href="/orders" class="px-4 py-2 brand-gradient text-white rounded shadow font-semibold"><i class="fa fa-receipt mr-1"></i>Order</a>
            <a href="/customers" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:brand-gradient hover:text-white transition font-semibold"><i class="fa fa-users mr-1"></i>Customer</a>
        </nav>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-700 tracking-tight drop-shadow">Daftar Order</h1>
            <a href="<?php echo e(route('orders.create')); ?>" class="px-5 py-2 brand-gradient text-white rounded shadow hover:scale-105 transition flex items-center font-semibold"><i class="fa fa-plus mr-2"></i>Tambah Order</a>
        </div>
        <?php if(session('success')): ?>
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="bg-white/90 shadow-xl rounded-2xl overflow-x-auto border border-indigo-100">
            <table class="min-w-full divide-y divide-indigo-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">ID Order</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Pelanggan</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-indigo-100">
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-pink-50 transition">
                        <td class="px-4 py-3 font-mono text-sm">#<?php echo e($order->id); ?></td>
                        <td class="px-4 py-3 font-semibold text-indigo-800"><?php echo e($order->customer->name ?? 'N/A'); ?></td>
                        <td class="px-4 py-3"><?php echo e($order->created_at->format('d M Y')); ?></td>
                        <td class="px-4 py-3 text-pink-600 font-bold">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php if($order->status == 'completed'): ?> bg-green-100 text-green-800 
                                <?php elseif($order->status == 'pending'): ?> bg-yellow-100 text-yellow-800 
                                <?php elseif($order->status == 'cancelled'): ?> bg-red-100 text-red-800 
                                <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                <i class="fa fa-circle mr-1 text-[8px]"></i><?php echo e(ucfirst($order->status)); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="<?php echo e(route('orders.show', $order)); ?>" class="inline-block px-3 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 text-xs font-semibold"><i class="fa fa-eye"></i> Lihat</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada order.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> <?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/orders/index.blade.php ENDPATH**/ ?>