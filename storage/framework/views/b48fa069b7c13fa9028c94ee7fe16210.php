
<?php $__env->startSection('title'); ?>
    Supplier
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
                            <h4>List of suppliers</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addsupplier">
                                <i class="fa-solid fa-plus"></i> Add Supplier
                            </button>
                            <a href="<?php echo e(route('suppliers.exportPDFAll')); ?>" target="_blank" rel="noopener noreferrer"
                                class="btn btn-danger">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="<?php echo e(route('suppliers.exportExcel')); ?>" target="_blank" rel="noopener noreferrer"
                                class="btn btn-primary">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addsupplier" tabindex="-1" aria-labelledby="addsupplierLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('suppliers.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addsupplierLabel">Add Supplier</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="supplier"
                                                    placeholder="Enter Supplier" value="<?php echo e(old('name')); ?>">
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
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter Email" value="<?php echo e(old('email')); ?>">
                                                <?php $__errorArgs = ['email'];
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
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="number" name="contact" class="form-control" id="contact"
                                                    placeholder="Enter Contact" value="<?php echo e(old('contact')); ?>">
                                                <?php $__errorArgs = ['contact'];
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
                        <table id="supplierTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Suppliers</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($supplier->id); ?></td>
                                        <td><?php echo e($supplier->name); ?></td>
                                        <td><?php echo e($supplier->email); ?></td>
                                        <td><?php echo e($supplier->contact); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editsupplier-<?php echo e($supplier->id); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editsupplier-<?php echo e($supplier->id); ?>" tabindex="-1"
                                                aria-labelledby="addsupplierLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('suppliers.update', $supplier->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('put'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editsupplierLabel">Edit
                                                                    Supplier
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="supplier"
                                                                        placeholder="Enter Supplier"
                                                                        value="<?php echo e($supplier->name); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control" id="email"
                                                                        placeholder="Enter Email"
                                                                        value="<?php echo e($supplier->email); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <div class="form-group">
                                                                    <label for="contact">Contact</label>
                                                                    <input type="number" name="contact"
                                                                        class="form-control" id="contact"
                                                                        placeholder="Enter Contact"
                                                                        value="<?php echo e($supplier->contact); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['contact'];
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
                                                data-bs-target="#deletesupplier-<?php echo e($supplier->id); ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deletesupplier-<?php echo e($supplier->id); ?>"
                                                tabindex="-1" aria-labelledby="addsupplierLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('suppliers.delete', $supplier->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editsupplierLabel">Delete
                                                                    Supplier
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
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($suppliers->isEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            <?php echo e($suppliers->links('pagination::bootstrap-5')); ?>

                        </div>

                    </div>
                </div>
            </div> <!-- /.col-12 -->
            <div class="col-12">

                <div class="card card-danger card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Export Supplier</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Table -->
                        <table id="supplierTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Suppliers</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($supplier->id); ?></td>
                                        <td><?php echo e($supplier->name); ?></td>
                                        <td><?php echo e($supplier->email); ?></td>
                                        <td><?php echo e($supplier->contact); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('suppliers.exportPDF',$supplier->id )); ?>" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-danger">
                                                <i class="fa fa-download"></i> Export PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($suppliers->isEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            <?php echo e($suppliers->links('pagination::bootstrap-5')); ?>

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
        $('#supplierTable').DataTable({
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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/admin/suppliers.blade.php ENDPATH**/ ?>