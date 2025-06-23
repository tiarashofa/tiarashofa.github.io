<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?> - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-gradient {
            background: linear-gradient(90deg, #a78bfa 0%, #f472b6 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-pink-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen">
        <!-- Navigation Menu -->
        <nav class="bg-white/80 backdrop-blur border-b border-indigo-100 sticky top-0 z-20 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-6">
                        <div class="text-2xl font-extrabold text-indigo-700 tracking-wide drop-shadow">Tiara Glow</div>
                        <a href="/dashboard" class="flex items-center px-3 py-2 rounded font-semibold text-indigo-700 hover:brand-gradient hover:text-white transition"><i class="fa fa-home mr-2"></i>Dashboard</a>
                        <a href="/products" class="flex items-center px-3 py-2 rounded font-semibold text-gray-700 hover:brand-gradient hover:text-white transition"><i class="fa fa-box mr-2"></i>Produk</a>
                        <a href="/orders" class="flex items-center px-3 py-2 rounded font-semibold text-gray-700 hover:brand-gradient hover:text-white transition"><i class="fa fa-receipt mr-2"></i>Order</a>
                        <a href="/customers" class="flex items-center px-3 py-2 rounded font-semibold text-gray-700 hover:brand-gradient hover:text-white transition"><i class="fa fa-users mr-2"></i>Customer</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="font-medium text-base text-gray-800"><i class="fa fa-user-circle mr-1"></i><?php echo e(Auth::user()->name); ?></div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="px-3 py-2 bg-pink-500 text-white rounded font-semibold hover:bg-pink-600 transition"><i class="fa fa-sign-out-alt mr-1"></i>Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        <header class="bg-white/90 shadow-sm border-b border-indigo-100">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-extrabold text-2xl text-indigo-700 leading-tight tracking-tight drop-shadow">Dashboard</h2>
            </div>
        </header>
        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <a href="/products" class="rounded-2xl shadow-xl p-8 bg-white/90 border-t-4 border-indigo-400 hover:scale-105 hover:shadow-2xl transition flex flex-col items-center text-center">
                            <div class="text-4xl mb-3 text-indigo-500"><i class="fa fa-box"></i></div>
                            <div class="text-lg font-bold text-indigo-700 mb-1">Produk</div>
                            <div class="text-gray-500 text-sm">Kelola data produk Tiara Glow</div>
                        </a>
                        <a href="/orders" class="rounded-2xl shadow-xl p-8 bg-white/90 border-t-4 border-pink-400 hover:scale-105 hover:shadow-2xl transition flex flex-col items-center text-center">
                            <div class="text-4xl mb-3 text-pink-500"><i class="fa fa-receipt"></i></div>
                            <div class="text-lg font-bold text-pink-700 mb-1">Order</div>
                            <div class="text-gray-500 text-sm">Kelola transaksi dan pesanan</div>
                        </a>
                        <a href="/customers" class="rounded-2xl shadow-xl p-8 bg-white/90 border-t-4 border-yellow-400 hover:scale-105 hover:shadow-2xl transition flex flex-col items-center text-center">
                            <div class="text-4xl mb-3 text-yellow-500"><i class="fa fa-users"></i></div>
                            <div class="text-lg font-bold text-yellow-700 mb-1">Customer</div>
                            <div class="text-gray-500 text-sm">Kelola data pelanggan</div>
                        </a>
                    </div>
                    <div class="mt-12 flex justify-center">
                        <div class="bg-gradient-to-r from-indigo-400 via-pink-400 to-yellow-400 text-white px-8 py-4 rounded-2xl shadow-lg text-lg font-semibold tracking-wide animate-pulse">
                            Selamat datang di Dashboard Tiara Glow!
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/dashboard.blade.php ENDPATH**/ ?>