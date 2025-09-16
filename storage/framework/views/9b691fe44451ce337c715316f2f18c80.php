
<?php $__env->startSection('title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-white text-bg-info">
                <div class="inner">
                    <h3><?php echo e(App\Models\User::count()); ?></h3>
                    <p>System Users</p>
                </div>
                <i class="small-box-icon fa fa-user-secret"></i>
                <a href="<?php echo e(route('users')); ?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 2-->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3><?php echo e(App\Models\Category::count()); ?></h3>
                    <p>Category</p>
                </div>
                <i class="small-box-icon fa-solid fa-list"></i>
                
                <a href="<?php echo e(route('category.index')); ?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 2-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 3-->
            <div class="small-box text-white text-bg-warning">
                <div class="inner">
                    <h3><?php echo e(App\Models\Product::count()); ?></h3>
                    <p>Product</p>
                </div>
                <i class="small-box-icon fa-regular fa-boxes-stacked"></i>
                <a href="<?php echo e(route('products.index')); ?>"
                    class="small-box-footer link-lightlink-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 3-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 4-->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo e(App\Models\Bartender::count()); ?></h3>
                    <p>Bartenders</p>
                </div>
                <i class="small-box-icon fa-solid fa-users"></i>
                <a href="<?php echo e(route('bartenders.index')); ?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 4-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo e(App\Models\Supplier::count()); ?></h3>
                    <p>Supplier</p>
                </div>
                <i class="small-box-icon fa-solid fa-signal-bars"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box bg-pink">
                <div class="inner">
                    <h3><?php echo e(App\Models\IncomingProduct::count()); ?></h3>
                    <p>Total Purchase</p>
                </div>
                <i class="small-box-icon fa-solid fa-cart-plus"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
        <div class="col-lg-3 col-6">
            <!--begin::Small Box Widget 1-->
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3><?php echo e(App\Models\OutgoingProduct::count()); ?></h3>
                    <p>Total Outgoing</p>
                </div>
                <i class="small-box-icon fa-solid fa-box-open"></i>
                <a href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
            <!--end::Small Box Widget 1-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    
    <!-- /.row (main row) -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>