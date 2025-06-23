

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Kategori</h2>
        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td><?php echo e($category->description); ?></td>
                    <td>
                        <a href="<?php echo e(route('categories.show', $category)); ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('categories.edit', $category)); ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/categories/index.blade.php ENDPATH**/ ?>