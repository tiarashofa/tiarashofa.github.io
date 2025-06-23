<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Customer - Tiara Glow</title>
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
            <a href="/orders" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:brand-gradient hover:text-white transition font-semibold"><i class="fa fa-receipt mr-1"></i>Order</a>
            <a href="/customers" class="px-4 py-2 brand-gradient text-white rounded shadow font-semibold"><i class="fa fa-users mr-1"></i>Customer</a>
        </nav>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-700 tracking-tight drop-shadow">Daftar Customer</h1>
            <a href="{{ route('customers.create') }}" class="px-5 py-2 brand-gradient text-white rounded shadow hover:scale-105 transition flex items-center font-semibold"><i class="fa fa-plus mr-2"></i>Tambah Customer</a>
        </div>
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white/90 shadow-xl rounded-2xl overflow-x-auto border border-indigo-100">
            <table class="min-w-full divide-y divide-indigo-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Telepon</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-indigo-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-indigo-100">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-pink-50 transition">
                        <td class="px-4 py-3 font-mono text-sm">{{ $customer->id }}</td>
                        <td class="px-4 py-3 font-semibold text-indigo-800">{{ $customer->name }}</td>
                        <td class="px-4 py-3">{{ $customer->email }}</td>
                        <td class="px-4 py-3">{{ $customer->phone }}</td>
                        <td class="px-4 py-3">{{ Str::limit($customer->address, 50) }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('customers.show', $customer) }}" class="inline-block px-3 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 text-xs font-semibold"><i class="fa fa-eye"></i> Lihat</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="inline-block px-3 py-1 bg-yellow-400 text-white rounded shadow hover:bg-yellow-500 text-xs font-semibold"><i class="fa fa-edit"></i> Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus customer ini?')" class="px-3 py-1 bg-red-500 text-white rounded shadow hover:bg-red-600 text-xs font-semibold"><i class="fa fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada customer.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 