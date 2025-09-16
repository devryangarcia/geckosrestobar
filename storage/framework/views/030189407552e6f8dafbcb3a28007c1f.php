

<?php $__env->startSection('title'); ?>
    Incoming Products
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <?php if(Session::get('success')): ?>
                    <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        <?php echo e(Session::get('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if(Session::get('deleted')): ?>
                    <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <?php echo e(Session::get('deleted')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card card-success card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Purchase Products Lists</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addincoming">
                                <i class="fa-solid fa-plus"></i> Add New Purchase
                            </button>
                            <a href="<?php echo e(route('incomingproducts.exportPDFAll')); ?>" target="_blank" class="btn btn-danger"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="<?php echo e(route('incomingproducts.exportExcel')); ?>" target="_blank" class="btn btn-primary"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>
                        </div>

                        <div class="modal fade" id="addincoming" tabindex="-1" aria-labelledby="addincoming"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addincomingproductModalLabel">Add Outgoing Products
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="product_id">Product</label>
                                                <select name="product_id" class="form-control" id="product_id">
                                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <?php $__errorArgs = ['product_id'];
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
                                                <label for="supplier_id">Supplier</label>
                                                <select name="supplier_id" class="form-control" id="supplier_id">
                                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <?php $__errorArgs = ['supplier_id'];
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
                                                <label for="qty">Quantity</label>
                                                <input type="number" name="qty" class="form-control" id="qty">
                                            </div>
                                            <?php $__errorArgs = ['qty'];
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
                                                <label for="date">Date</label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    required>
                                            </div>
                                            <?php $__errorArgs = ['date'];
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
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <table id="incomingproductsTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products</th>
                                    <th>Suppliers</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $incomingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomingprod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($incomingprod->id); ?></td>
                                        <td><?php echo e($incomingprod->product->name); ?></td>
                                        <td><?php echo e($incomingprod->supplier->name); ?></td>
                                        <td><?php echo e($incomingprod->qty); ?></td>
                                        <td><?php echo e($incomingprod->date); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editincomingproduct-<?php echo e($incomingprod->id); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <div class="modal fade" id="editincomingproduct-<?php echo e($incomingprod->id); ?>"
                                                tabindex="-1"
                                                aria-labelledby="editincomingproduct-<?php echo e($incomingprod->id); ?>"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="<?php echo e(route('incomingproducts.update', $incomingprod->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('put'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"
                                                                    id="editincomingproductModalLabel">
                                                                    Edit Purchase Products
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="product_id">Product</label>
                                                                    <select name="product_id" class="form-control"
                                                                        id="product_id">
                                                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($id); ?>"
                                                                                <?php if($incomingprod->product_id == $id): echo 'selected'; endif; ?>>
                                                                                <?php echo e($name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <?php $__errorArgs = ['product_id'];
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
                                                                    <label for="supplier_id">Supplier</label>
                                                                    <select name="supplier_id" class="form-control"
                                                                        id="supplier_id">
                                                                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($id); ?>"
                                                                                <?php if($incomingprod->supplier_id == $id): echo 'selected'; endif; ?>>
                                                                                <?php echo e($name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <?php $__errorArgs = ['supplier_id'];
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
                                                                    <label for="qty">Quantity</label>
                                                                    <input type="number" name="qty"
                                                                        class="form-control" id="qty"
                                                                        value="<?php echo e($incomingprod->qty); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['qty'];
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
                                                                    <label for="date">Date</label>
                                                                    <input type="date" name="date"
                                                                        class="form-control" id="date"
                                                                        value="<?php echo e($incomingprod->date); ?>" required>
                                                                </div>
                                                                <?php $__errorArgs = ['date'];
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
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteincomingproduct-<?php echo e($incomingprod->id); ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteincomingproduct-<?php echo e($incomingprod->id); ?>"
                                                tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form
                                                            action="<?php echo e(route('incomingproducts.delete', $incomingprod->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editproductLabel">Delete
                                                                    product
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
                                <?php if($incomingproducts->isEmpty()): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($incomingproducts->links('pagination::bootstrap-5')); ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12">

                <div class="card card-danger card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Export Invoice</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="incomingproductsTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products</th>
                                    <th>Supplier</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $incomingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incomingprod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($incomingprod->id); ?></td>
                                        <td><?php echo e($incomingprod->product->name); ?></td>
                                        <td><?php echo e($incomingprod->supplier->name); ?></td>
                                        <td><?php echo e($incomingprod->qty); ?></td>
                                        <td><?php echo e($incomingprod->date); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('incomingproducts.exportPDF',$incomingprod->id)); ?>" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                                                <i class="fa fa-download"></i> Export Invoice
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($incomingproducts->isEmpty()): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($incomingproducts->links('pagination::bootstrap-5')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if there are validation errors and show the modal
            <?php if($errors->any()): ?>
                $('#addincomingproductModal').modal('show');
            <?php endif; ?>

            // Initialize DataTable only if you are not using server-side pagination
            // Since you have Laravel pagination, it's better to disable DataTables features
            // that conflict with it. The `searching`, `paging`, and `info` options are
            // disabled, leaving only sorting enabled if desired.
            $('#incomingproductsTable').DataTable({
                paging: false,
                info: false,
                searching: false,
                ordering: true,
                language: {
                    emptyTable: "No outgoing products available."
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/admin/incomingproducts.blade.php ENDPATH**/ ?>