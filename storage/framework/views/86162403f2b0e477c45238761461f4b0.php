<!DOCTYPE html>
<html
    lang="<?php echo e(app()->getLocale()); ?>"
    dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Translation Admin
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <?php if(app()->getLocale() === 'ar'): ?>
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

        

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="mb-1">
                    Translation Admin
                </h1>

                <p class="text-muted mb-0">
                    Manage translations for all supported languages.
                </p>

            </div>

            <div>

                <a
                    href="<?php echo e(route('localization.index')); ?>"
                    class="btn btn-dark">

                    Home

                </a>

            </div>

        </div>


        

        <?php if(session('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?php echo e(session('success')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        <?php endif; ?>


        

        <?php if(session('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <?php echo e(session('error')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        <?php endif; ?>


        

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <form
                    method="GET"
                    action="<?php echo e(route('admin.index')); ?>">

                    <div class="row g-3 align-items-end">

                        

                        <div class="col-md-5">

                            <label class="form-label">
                                Search
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                class="form-control"
                                placeholder="Search key or value...">

                        </div>


                        

                        <div class="col-md-3">

                            <label class="form-label">
                                Language
                            </label>

                            <select
                                name="locale"
                                class="form-select">

                                <option value="">
                                    All Languages
                                </option>

                                <option
                                    value="en"
                                    <?php echo e(request('locale') === 'en' ? 'selected' : ''); ?>>
                                    EN
                                </option>

                                <option
                                    value="fr"
                                    <?php echo e(request('locale') === 'fr' ? 'selected' : ''); ?>>
                                    FR
                                </option>

                                <option
                                    value="de"
                                    <?php echo e(request('locale') === 'de' ? 'selected' : ''); ?>>
                                    DE
                                </option>

                                <option
                                    value="es"
                                    <?php echo e(request('locale') === 'es' ? 'selected' : ''); ?>>
                                    ES
                                </option>

                                <option
                                    value="hi"
                                    <?php echo e(request('locale') === 'hi' ? 'selected' : ''); ?>>
                                    HI
                                </option>

                                <option
                                    value="ar"
                                    <?php echo e(request('locale') === 'ar' ? 'selected' : ''); ?>>
                                    AR
                                </option>

                                <option
                                    value="gu"
                                    <?php echo e(request('locale') === 'gu' ? 'selected' : ''); ?>>
                                    GU
                                </option>

                            </select>

                        </div>


                        

                        <div class="col-md-2">

                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                Search

                            </button>

                        </div>


                        

                        <div class="col-md-2">

                            <a
                                href="<?php echo e(route('admin.index')); ?>"
                                class="btn btn-secondary w-100">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>


                

                <div class="mt-3 d-flex gap-2 flex-wrap">

                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#addTranslationModal">

                        Add Translation

                    </button>


                    <a
                        href="<?php echo e(route('admin.export')); ?>"
                        class="btn btn-outline-primary">

                        Export CSV

                    </a>


                    <a
                        href="<?php echo e(route('admin.cache.clear')); ?>"
                        class="btn btn-outline-warning">

                        Clear Cache

                    </a>

                </div>

            </div>

        </div>


        

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="mb-0">
                        All Translations
                    </h4>

                    <span class="badge bg-primary">

                        <?php echo e($translations->total()); ?>


                        Records

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Locale
                                </th>

                                <th>
                                    Key
                                </th>

                                <th>
                                    Value
                                </th>

                                <th style="width: 220px;">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <tr>


                                <td>
                                    <?php echo e($translations->firstItem() + $loop->index); ?>

                                </td>

                                <td>

                                    <span class="badge bg-info text-dark">

                                        <?php echo e(strtoupper($translation->locale)); ?>


                                    </span>

                                </td>

                                <td>

                                    <code>
                                        <?php echo e($translation->key); ?>

                                    </code>

                                </td>

                                <td>

                                    <?php echo e($translation->value); ?>


                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTranslation<?php echo e($translation->id); ?>">

                                            Edit

                                        </button>


                                        

                                        <form
                                            method="POST"
                                            action="<?php echo e(route('admin.destroy', $translation)); ?>"
                                            onsubmit="return confirm('Are you sure you want to delete this translation?');">

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                            

                            <div
                                class="modal fade"
                                id="editTranslation<?php echo e($translation->id); ?>"
                                tabindex="-1"
                                aria-hidden="true">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">
                                                Edit Translation
                                            </h5>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                            </button>

                                        </div>


                                        <form
                                            method="POST"
                                            action="<?php echo e(route('admin.update', $translation)); ?>">

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('PUT'); ?>


                                            <div class="modal-body">

                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Locale
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="<?php echo e(strtoupper($translation->locale)); ?>"
                                                        disabled>

                                                </div>


                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Key
                                                    </label>

                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        value="<?php echo e($translation->key); ?>"
                                                        disabled>

                                                </div>


                                                <div class="mb-3">

                                                    <label class="form-label">
                                                        Value
                                                    </label>

                                                    <textarea
                                                        name="value"
                                                        class="form-control"
                                                        rows="4"
                                                        required><?php echo e($translation->value); ?></textarea>

                                                </div>

                                            </div>


                                            <div class="modal-footer">

                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">

                                                    Cancel

                                                </button>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary">

                                                    Update

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td
                                    colspan="5"
                                    class="text-center py-4">

                                    No translations found.

                                </td>

                            </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>


                

                <?php if($translations->hasPages()): ?>

                <div class="d-flex justify-content-center mt-4">

                    <ul class="pagination mb-0">

                        <?php for(
                        $page = 1;
                        $page <= $translations->lastPage();
                            $page++
                            ): ?>

                            <li
                                class="page-item
                                <?php echo e($translations->currentPage() == $page
                                    ? 'active'
                                    : ''); ?>">

                                <a
                                    class="page-link"
                                    href="<?php echo e($translations->url($page)); ?>">

                                    <?php echo e($page); ?>


                                </a>

                            </li>

                            <?php endfor; ?>

                    </ul>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </div>


    

    <div
        class="modal fade"
        id="addTranslationModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Translation
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>


                <form
                    method="POST"
                    action="<?php echo e(route('admin.store')); ?>">

                    <?php echo csrf_field(); ?>


                    <div class="modal-body">

                        

                        <div class="mb-3">

                            <label class="form-label">
                                Language
                            </label>

                            <select
                                name="locale"
                                class="form-select"
                                required>

                                <option value="">
                                    Select Language
                                </option>

                                <option value="en">
                                    English
                                </option>

                                <option value="fr">
                                    Français
                                </option>

                                <option value="de">
                                    Deutsch
                                </option>

                                <option value="es">
                                    Español
                                </option>

                                <option value="hi">
                                    हिन्दी
                                </option>

                                <option value="ar">
                                    العربية
                                </option>

                                <option value="gu">
                                    ગુજરાતી
                                </option>

                            </select>

                        </div>


                        

                        <div class="mb-3">

                            <label class="form-label">
                                Translation Key
                            </label>

                            <input
                                type="text"
                                name="key"
                                class="form-control"
                                placeholder="Example: welcome"
                                required>

                        </div>


                        

                        <div class="mb-3">

                            <label class="form-label">
                                Translation Value
                            </label>

                            <textarea
                                name="value"
                                class="form-control"
                                rows="4"
                                placeholder="Enter translation..."
                                required></textarea>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="btn btn-success">

                            Save Translation

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html><?php /**PATH D:\xampp\htdocs\PHP_Laravel12_Localization\resources\views/admin.blade.php ENDPATH**/ ?>