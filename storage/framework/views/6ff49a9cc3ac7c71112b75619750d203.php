<!DOCTYPE html>
<html
    lang="<?php echo e($locale); ?>"
    dir="<?php echo e($isRtl ? 'rtl' : 'ltr'); ?>">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo e(__('lang.title')); ?>

    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <?php if($isRtl): ?>
    <style>
        body {
            direction: rtl;
            text-align: right;
        }
    </style>
    <?php endif; ?>

</head>

<body class="bg-light">

    <div class="container py-5">

        

        <?php if(session('success')): ?>

        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>

        <?php endif; ?>

        

        <?php if(session('error')): ?>

        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>

        <?php endif; ?>


        <div class="card shadow">

            <div class="card-body">

                <h1 class="mb-3">
                    <?php echo e(__('lang.title')); ?>

                </h1>

                <p class="text-muted">
                    <?php echo e(__('lang.welcome')); ?>

                </p>

                <hr>


                

                <h5>
                    <?php echo e(__('lang.current_language')); ?>

                </h5>

                <div class="alert alert-info">

                    <strong>
                        <?php echo e(strtoupper($locale)); ?>

                    </strong>

                </div>


                

                <h5>
                    <?php echo e(__('lang.select_language')); ?>

                </h5>

                <div class="d-flex gap-2 flex-wrap mb-4">

                    <?php $__currentLoopData = $supportedLocales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <a
                        href="<?php echo e(route('localization.change', $language)); ?>"
                        class="btn
                        <?php echo e($locale === $language
                            ? 'btn-success'
                            : 'btn-outline-primary'); ?>">

                        <?php switch($language):

                        case ('en'): ?>
                        English
                        <?php break; ?>

                        <?php case ('fr'): ?>
                        Français
                        <?php break; ?>

                        <?php case ('de'): ?>
                        Deutsch
                        <?php break; ?>

                        <?php case ('es'): ?>
                        Español
                        <?php break; ?>

                        <?php case ('hi'): ?>
                        हिन्दी
                        <?php break; ?>

                        <?php case ('ar'): ?>
                        العربية
                        <?php break; ?>

                        <?php case ('gu'): ?>
                        ગુજરાતી
                        <?php break; ?>

                        <?php endswitch; ?>

                    </a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>


                

                <div class="alert alert-secondary">

                    <strong>
                        RTL:
                    </strong>

                    <?php echo e($isRtl ? 'Yes' : 'No'); ?>


                </div>


                

                <a
                    href="<?php echo e(route('localization.home')); ?>"
                    class="btn btn-dark">
                    Open Localization Demo
                </a>


                

                <a
                    href="<?php echo e(route('admin.index')); ?>"
                    class="btn btn-primary">
                    Translation Admin
                </a>

            </div>

        </div>

    </div>

</body>

</html><?php /**PATH D:\xampp\htdocs\PHP_Laravel12_Localization\resources\views/localization.blade.php ENDPATH**/ ?>