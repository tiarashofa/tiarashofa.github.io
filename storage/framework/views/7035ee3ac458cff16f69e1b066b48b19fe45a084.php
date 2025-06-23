

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Tambah Transaksi Baru</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('orders.store')); ?>" method="POST" id="orderForm">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="customer_id" class="form-label">Pelanggan</label>
                            <select class="form-select <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="customer_id" name="customer_id" required>
                                <option value="">Pilih Pelanggan</option>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($customer->id); ?>" <?php echo e(old('customer_id') == $customer->id ? 'selected' : ''); ?>>
                                        <?php echo e($customer->name); ?> - <?php echo e($customer->email); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="shipping_address" name="shipping_address" rows="3" required><?php echo e(old('shipping_address')); ?></textarea>
                            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <h5>Produk</h5>
                            <div id="items">
                                <div class="row mb-2 item">
                                    <div class="col-md-6">
                                        <select class="form-select product-select" name="items[0][product_id]" required>
                                            <option value="">Pilih Produk</option>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>" data-stock="<?php echo e($product->stock); ?>">
                                                    <?php echo e($product->name); ?> - Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?> (Stok: <?php echo e($product->stock); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control quantity-input" name="items[0][quantity]" placeholder="Jumlah" min="1" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-item" style="display: none;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" id="addItem">
                                <i class="fas fa-plus"></i> Tambah Produk
                            </button>
                        </div>

                        <div class="mb-3">
                            <h5>Total: <span id="total">Rp 0</span></h5>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsContainer = document.getElementById('items');
    const addItemButton = document.getElementById('addItem');
    const totalElement = document.getElementById('total');
    let itemCount = 1;

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.item').forEach(item => {
            const productSelect = item.querySelector('.product-select');
            const quantityInput = item.querySelector('.quantity-input');
            if (productSelect.value && quantityInput.value) {
                const price = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
                const quantity = parseInt(quantityInput.value);
                total += price * quantity;
            }
        });
        totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }

    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-item');
        removeButtons.forEach(button => {
            button.style.display = removeButtons.length > 1 ? 'block' : 'none';
        });
    }

    function addItem() {
        const template = document.querySelector('.item').cloneNode(true);
        template.querySelectorAll('select, input').forEach(input => {
            input.value = '';
            input.name = input.name.replace('[0]', `[${itemCount}]`);
        });
        template.querySelector('.remove-item').style.display = 'block';
        itemsContainer.appendChild(template);
        itemCount++;
        updateRemoveButtons();
    }

    addItemButton.addEventListener('click', addItem);

    itemsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.item').remove();
            updateTotal();
            updateRemoveButtons();
        }
    });

    itemsContainer.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
            const item = e.target.closest('.item');
            const productSelect = item.querySelector('.product-select');
            const quantityInput = item.querySelector('.quantity-input');
            
            if (productSelect.value && quantityInput.value) {
                const stock = parseInt(productSelect.options[productSelect.selectedIndex].dataset.stock);
                if (parseInt(quantityInput.value) > stock) {
                    alert('Jumlah melebihi stok yang tersedia');
                    quantityInput.value = stock;
                }
            }
            updateTotal();
        }
    });

    document.getElementById('orderForm').addEventListener('submit', function(e) {
        let hasItems = false;
        document.querySelectorAll('.item').forEach(item => {
            const productSelect = item.querySelector('.product-select');
            const quantityInput = item.querySelector('.quantity-input');
            if (productSelect.value && quantityInput.value) {
                hasItems = true;
            }
        });

        if (!hasItems) {
            e.preventDefault();
            alert('Pilih minimal satu produk');
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/orders/create.blade.php ENDPATH**/ ?>