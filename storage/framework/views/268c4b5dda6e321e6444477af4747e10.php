
<?php $__env->startSection('title'); ?>
    Bartender
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if(Session::get('success')): ?>
                    <!-- Alert -->
                    <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        <?php echo e(Session::get('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if(Session::get('deleted')): ?>
                    <!-- Alert -->
                    <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <?php echo e(Session::get('deleted')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card card-success card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h4>List of Bartenders</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addbartender">
                                <i class="fa-solid fa-plus"></i> Add Bartender
                            </button>
                            <a href="<?php echo e(route('bartenders.exportPDFAll')); ?>" target="_blank" class="btn btn-danger"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="<?php echo e(route('bartenders.exportExcel')); ?>" target="_blank" class="btn btn-primary"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addbartender" tabindex="-1" aria-labelledby="addbartenderLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('bartenders.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addbartenderLabel">Add Bartender</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="bartender"
                                                    placeholder="Enter bartender" value="<?php echo e(old('name')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary me-auto"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <table id="bartenderTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bartenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bartender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bartender->id); ?></td>
                                        <td><?php echo e($bartender->name); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editbartender-<?php echo e($bartender->id); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editbartender-<?php echo e($bartender->id); ?>" tabindex="-1"
                                                aria-labelledby="addbartenderLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('bartenders.update',$bartender->id)); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('put'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editbartenderLabel">Edit
                                                                    Bartender
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="editbartender">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="editbartender"
                                                                        placeholder="Enter bartender"
                                                                        value="<?php echo e($bartender->name); ?>">
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary me-auto"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-md btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletebartender-<?php echo e($bartender->id); ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deletebartender-<?php echo e($bartender->id); ?>"
                                                tabindex="-1" aria-labelledby="addbartenderLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('bartenders.delete',$bartender->id)); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editbartenderLabel">Delete
                                                                    bartender
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="text-danger">Are you sure to delete the record?
                                                                </h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary me-auto"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-warning">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($bartenders->isEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            <?php echo e($bartenders->links('pagination::bootstrap-5')); ?>

                        </div>

                    </div>
                </div>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#bartenderTable').DataTable({
            paging: false, // disable DataTables pagination
            info: false, // hide "Showing x to y of z entries"
            searching: false,
            ordering: true,
            language: {
                emptyTable: "No categories available" // ✅ custom message
            }
        });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/bartender.blade.php ENDPATH**/ ?>