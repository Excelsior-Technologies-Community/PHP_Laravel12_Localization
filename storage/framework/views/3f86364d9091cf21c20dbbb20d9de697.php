<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(in_array(app()->getLocale(), ['ar']) ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', __('lang.welcome')); ?> - Laravel Localization</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php if(in_array(app()->getLocale(), ['ar'])): ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <?php endif; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; letter-spacing: -0.5px; }
        .lang-btn { border-radius: 20px; font-size: 0.75rem; padding: 4px 12px; margin: 2px; }
        .lang-btn.active { background: #0d6efd; color: white; border-color: #0d6efd; }
        .card { border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-radius: 16px; transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
        .feature-card { transition: transform 0.2s; }
        .feature-card:hover { transform: translateY(-4px); }
        .badge-locale { font-size: 1rem; padding: 8px 20px; border-radius: 20px; }
        .rtl-note { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 12px; }
        .section-title { border-left: 4px solid #0d6efd; padding-left: 12px; margin-bottom: 16px; font-weight: 600; }
        [dir="rtl"] .section-title { border-left: none; border-right: 4px solid #0d6efd; padding-left: 0; padding-right: 12px; }
        .hero-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .footer { background: #1a1d21; color: #adb5bd; }
        .lang-dropdown-item { cursor: pointer; }
        .lang-dropdown-item:hover { background: #f8f9fa; }
        .alert-dismissible .btn-close { padding: 0.75rem 1rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand text-warning" href="<?php echo e(route('home')); ?>">
            <i class="fab fa-laravel me-2"></i>Laravel I18N
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <i class="fas fa-home me-1"></i><?php echo e(trans('lang.home')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.*') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('admin.index')); ?>">
                        <i class="fas fa-cog me-1"></i><?php echo e(trans('lang.admin')); ?>

                    </a>
                </li>
            </ul>

            
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fw-semibold"><?php echo e(strtoupper(app()->getLocale())); ?></span>
                    <i class="fas fa-globe"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <?php
                        $languages = [
                            'en' => ['flag' => '🇬🇧', 'name' => 'English',  'native' => 'English'],
                            'fr' => ['flag' => '🇫🇷', 'name' => 'French',   'native' => 'Français'],
                            'de' => ['flag' => '🇩🇪', 'name' => 'German',   'native' => 'Deutsch'],
                            'es' => ['flag' => '🇪🇸', 'name' => 'Spanish',  'native' => 'Español'],
                            'hi' => ['flag' => '🇮🇳', 'name' => 'Hindi',    'native' => 'हिन्दी'],
                            'ar' => ['flag' => '🇸🇦', 'name' => 'Arabic',   'native' => 'العربية'],
                            'gu' => ['flag' => '🇮🇳', 'name' => 'Gujarati', 'native' => 'ગુજરાતી'],
                        ];
                    ?>
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('locale.set', $code)); ?>"
                               class="dropdown-item lang-dropdown-item d-flex align-items-center justify-content-between <?php echo e(app()->getLocale() === $code ? 'active text-primary fw-bold' : ''); ?>">
                                <span><?php echo e($lang['flag']); ?> <?php echo e($lang['native']); ?></span>
                                <?php if(app()->getLocale() === $code): ?>
                                    <i class="fas fa-check text-primary"></i>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</nav>


<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show m-0 rounded-0" role="alert">
    <div class="container">
        <i class="fas fa-check-circle me-2"></i><strong><?php echo e(session('success')); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger alert-dismissible fade show m-0 rounded-0" role="alert">
    <div class="container">
        <i class="fas fa-exclamation-circle me-2"></i><strong><?php echo e(session('error')); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<?php endif; ?>

<div class="container py-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<footer class="footer text-center py-4 mt-5">
    <div class="container">
        <p class="mb-0">
            <i class="fab fa-laravel me-2"></i>Laravel 12 Localization Demo
        </p>
        <small class="text-muted">7 Languages Supported | Session + Cookie + Browser Auto-Detect | RTL Support</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\git_desktop\PHP_Laravel12_Localization\resources\views/layouts/app.blade.php ENDPATH**/ ?>