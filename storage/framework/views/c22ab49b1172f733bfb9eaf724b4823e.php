<?php $__env->startSection('title', __('lang.welcome')); ?>

<?php $__env->startSection('content'); ?>


<div class="card hero-card text-white mb-4 border-0">
    <div class="card-body py-5 text-center">
        <h1 class="display-4 fw-bold mb-3">
            <i class="fas fa-globe me-3"></i><?php echo e(trans('lang.welcome')); ?>

        </h1>
        <p class="lead mb-4 opacity-90"><?php echo e(trans('lang.msg')); ?></p>
        <span class="badge bg-warning text-dark badge-locale fs-6">
            <?php echo e(trans('lang.current_language')); ?>: <strong><?php echo e(strtoupper($locale)); ?></strong>
        </span>
    </div>
</div>


<?php if($isRtl): ?>
<div class="rtl-note p-3 mb-4 text-center fw-semibold">
    <i class="fas fa-align-right me-2"></i><?php echo e(trans('lang.rtl_note')); ?>

</div>
<?php endif; ?>


<?php if(session('browser_detected')): ?>
<div class="alert alert-info d-flex align-items-center">
    <i class="fas fa-robot me-2 fs-4"></i>
    <div><strong><?php echo e(trans('lang.browser_detected')); ?></strong></div>
</div>
<?php endif; ?>

<div class="row g-4">

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-language me-2 text-primary"></i><?php echo e(trans('lang.select_language')); ?>

                </h5>
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
                <div class="row g-2">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6">
                        <a href="<?php echo e(route('locale.set', $code)); ?>"
                           class="btn w-100 text-start d-flex align-items-center gap-2 <?php echo e($locale === $code ? 'btn-primary' : 'btn-outline-secondary'); ?>">
                            <span class="fs-5"><?php echo e($lang['flag']); ?></span>
                            <span class="flex-grow-1"><?php echo e($lang['native']); ?></span>
                            <?php if($locale === $code): ?>
                                <i class="fas fa-check-circle ms-auto"></i>
                            <?php endif; ?>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-calendar-alt me-2 text-success"></i><?php echo e(trans('lang.current_date')); ?> & <?php echo e(trans('lang.current_time')); ?>

                </h5>
                <div class="mb-3 p-3 bg-light rounded">
                    <div class="text-muted small mb-1"><i class="far fa-calendar me-1"></i><?php echo e(trans('lang.current_date')); ?></div>
                    <div class="fs-5 fw-semibold text-success">📅 <?php echo e($currentDate); ?></div>
                </div>
                <div class="p-3 bg-light rounded">
                    <div class="text-muted small mb-1"><i class="far fa-clock me-1"></i><?php echo e(trans('lang.current_time')); ?></div>
                    <div class="fs-5 fw-semibold text-primary">🕐 <?php echo e($currentTime); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-money-bill-wave me-2 text-danger"></i><?php echo e(trans('lang.price_label')); ?> (Number/Currency)
                </h5>
                <div class="p-4 bg-light rounded text-center">
                    <div class="text-muted small mb-1"><?php echo e(trans('lang.price_label')); ?> (<?php echo e(trans('lang.current_language')); ?>: <?php echo e(strtoupper($locale)); ?>)</div>
                    <div class="display-4 fw-bold text-danger"><?php echo e($formattedPrice); ?></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-list-ol me-2 text-warning"></i>Pluralization <code>trans_choice()</code>
                </h5>
                <p class="text-muted small mb-3"><?php echo e(trans('lang.items_count')); ?></p>
                <?php $__currentLoopData = $itemCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center mb-2 p-2 bg-light rounded">
                    <span class="badge bg-warning text-dark me-3" style="min-width:30px"><?php echo e($count); ?></span>
                    <span><?php echo e(trans_choice('lang.items_count', $count, ['count' => $count])); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-file-code me-2 text-info"></i>JSON Translations <code>__()</code>
                </h5>
                <?php $__currentLoopData = ['Hello', 'Goodbye', 'Thank you']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                    <span class="text-muted small"><?php echo e($key); ?></span>
                    <span class="badge bg-info text-dark fs-6"><?php echo e(__($key)); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="card feature-card h-100 border-0">
            <div class="card-body">
                <h5 class="section-title">
                    <i class="fas fa-link me-2 text-secondary"></i>URL Prefix Routes
                </h5>
                <p class="text-muted small mb-3">Visit these URLs to change locale from URL prefix:</p>
                <?php $__currentLoopData = ['en','fr','de','es','hi','ar','gu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url($code . '/home')); ?>" class="btn btn-sm btn-outline-secondary me-1 mb-2">
                    /<?php echo e($code); ?>/home
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="col-12">
        <div class="card feature-card border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="section-title mb-0">
                        <i class="fas fa-database me-2 text-primary"></i><?php echo e(trans('lang.db_translations')); ?> (<?php echo e(strtoupper($locale)); ?>)
                    </h5>
                    <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-primary">
                        <i class="fas fa-cog me-1"></i><?php echo e(trans('lang.admin')); ?>

                    </a>
                </div>
                <?php if($dbTranslations->isEmpty()): ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p>No database translations yet. Go to Admin Panel to add some!</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo e(trans('lang.key')); ?></th>
                                    <th><?php echo e(trans('lang.value')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $dbTranslations->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><code><?php echo e($t->key); ?></code></td>
                                    <td><?php echo e($t->value); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($dbTranslations->count() > 5): ?>
                    <div class="text-center mt-3">
                        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-outline-primary btn-sm">
                            View All <?php echo e($dbTranslations->count()); ?> Translations
                        </a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\PHP_Laravel12_Localization\resources\views/home.blade.php ENDPATH**/ ?>