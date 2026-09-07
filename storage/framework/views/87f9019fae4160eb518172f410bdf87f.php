<?php $__env->startSection('title', trans('lang.admin')); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">
        <i class="fas fa-cog me-2 text-primary"></i><?php echo e(trans('lang.admin')); ?>

    </h2>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i><?php echo e(trans('lang.home')); ?>

    </a>
</div>


<div class="card mb-4 border-0">
    <div class="card-header bg-primary text-white fw-semibold">
        <i class="fas fa-plus me-2"></i><?php echo e(trans('lang.add_translation')); ?>

    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold"><?php echo e(trans('lang.language')); ?></label>
                    <select name="locale" class="form-select" required>
                        <?php $__currentLoopData = ['en'=>'English','fr'=>'Français','de'=>'Deutsch','es'=>'Español','hi'=>'हिन्दी','ar'=>'العربية','gu'=>'ગુજરાતી']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($code); ?>"><?php echo e($code); ?> - <?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><?php echo e(trans('lang.key')); ?></label>
                    <input type="text" name="key" class="form-control" placeholder="e.g. greeting" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold"><?php echo e(trans('lang.value')); ?></label>
                    <input type="text" name="value" class="form-control" placeholder="Translation value" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="card border-0">
    <div class="card-header bg-dark text-white fw-semibold d-flex justify-content-between align-items-center">
        <span><i class="fas fa-database me-2"></i><?php echo e(trans('lang.db_translations')); ?></span>
        <span class="badge bg-warning text-dark"><?php echo e($translations->count()); ?> <?php echo e(trans('lang.db_translations')); ?></span>
    </div>
    <div class="card-body p-0">
        <?php if($translations->isEmpty()): ?>
            <div class="text-center py-5 text-muted">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <p>No translations yet. Add one above!</p>
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th><?php echo e(trans('lang.language')); ?></th>
                        <th><?php echo e(trans('lang.key')); ?></th>
                        <th><?php echo e(trans('lang.value')); ?></th>
                        <th><?php echo e(trans('lang.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-muted"><?php echo e($translation->id); ?></td>
                        <td>
                            <span class="badge bg-primary"><?php echo e(strtoupper($translation->locale)); ?></span>
                        </td>
                        <td>
                            <form action="<?php echo e(route('admin.update', $translation)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="text" name="value" value="<?php echo e($translation->value); ?>" class="form-control form-control-sm d-inline-block" style="width: 300px;" required>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-sm btn-outline-success me-1">
                                    <i class="fas fa-save"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?php echo e(route('admin.destroy', $translation)); ?>" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this translation?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\git_desktop\PHP_Laravel12_Localization\resources\views/admin.blade.php ENDPATH**/ ?>