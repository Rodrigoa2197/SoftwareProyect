<title><?php echo e(config('chatify.name')); ?></title>


<meta name="route" content="<?php echo e($route); ?>">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


<link href="<?php echo e(asset('css/chatify/'.$dark_mode.'.mode.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />


<?php echo $__env->make('Chatify::layouts.messengerColor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Frederick\Desktop\UCA\main_file\resources\views/vendor/Chatify/layouts/headLinks.blade.php ENDPATH**/ ?>