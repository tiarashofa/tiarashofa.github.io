

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Detail Produk</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="img-fluid rounded">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p class="card-text">
                                <strong>Harga:</strong> Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </p>
                            <p class="card-text">
                                <strong>Stok:</strong> <?php echo e($product->stock); ?>

                            </p>
                            <p class="card-text">
                                <strong>Deskripsi:</strong><br>
                                <?php echo e($product->description ?: 'Tidak ada deskripsi'); ?>

                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Riwayat Transaksi</h5>
                        <?php if($product->orderItems->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $product->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->order->id); ?></td>
                                                <td><?php echo e($item->order->created_at->format('d/m/Y H:i')); ?></td>
                                                <td><?php echo e($item->quantity); ?></td>
                                                <td>Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Belum ada transaksi untuk produk ini</p>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Kembali</a>
                        <div>
                            <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/products/show.blade.php ENDPATH**/ ?>