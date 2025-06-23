<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - Register</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <svg class="w-20 h-20 fill-current text-gray-500" viewBox="0 0 81 81" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" fill-rule="evenodd">
                            <path d="M40.5 81C62.868 81 81 62.868 81 40.5S62.868 0 40.5 0 0 18.132 0 40.5 18.132 81 40.5 81z" fill="#F0F0F0"></path>
                            <path d="M46.812 40.5l5.882-10.188-11.765-20.375-11.764 20.375L35.05 40.5l-5.882 10.188 11.764 20.375 11.765-20.375-5.883-10.188z" stroke="#333" stroke-width="3"></path>
                        </g>
                    </svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <!-- Validation Errors -->
                <?php if($errors->any()): ?>
                    <div class="mb-4">
                        <div class="font-medium text-red-600">
                            <?php echo e(__('Whoops! Something went wrong.')); ?>

                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                        <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus />
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
                        <input id="username" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="username" value="<?php echo e(old('username')); ?>" required />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" value="<?php echo e(old('email')); ?>" required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                        <input id="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?php echo e(route('login')); ?>">
                            <?php echo e(__('Already registered?')); ?>

                        </a>

                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\tiara-glow\resources\views/auth/register.blade.php ENDPATH**/ ?>