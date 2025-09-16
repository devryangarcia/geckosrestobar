

<?php $__env->startSection('title'); ?>
    Outgoing Products
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
                            <h4>List of Outgoing Products</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addoutgoing">
                                <i class="fa-solid fa-plus"></i> Add Outgoing Product
                            </button>
                            <a href="<?php echo e(route('outgoingproducts.exportPDFAll')); ?>" target="_blank"
                                rel="noopener noreferrer"class="btn btn-danger">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="<?php echo e(route('outgoingproducts.exportExcel')); ?>" target="_blank" rel="noopener noreferrer"class="btn btn-primary">
                                <i class="fa fa-download"></i> Export Excel
                            </a>
                        </div>

                        <div class="modal fade" id="addoutgoing" tabindex="-1" aria-labelledby="addoutgoing"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('outgoingproducts.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addOutgoingProductModalLabel">Add Outgoing Products
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
                                                <label for="bartender_id">Bartender</label>
                                                <select name="bartender_id" class="form-control" id="bartender_id">
                                                    <?php $__currentLoopData = $bartenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <?php $__errorArgs = ['bartender_id'];
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

                        <table id="outgoingProductsTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products</th>
                                    <th>Bartenders</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $outgoingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outgoingprod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($outgoingprod->id); ?></td>
                                        <td><?php echo e($outgoingprod->product->name); ?></td>
                                        <td><?php echo e($outgoingprod->bartender->name); ?></td>
                                        <td><?php echo e($outgoingprod->qty); ?></td>
                                        <td><?php echo e($outgoingprod->date); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editOutgoingProduct-<?php echo e($outgoingprod->id); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>

                                            <div class="modal fade" id="editOutgoingProduct-<?php echo e($outgoingprod->id); ?>"
                                                tabindex="-1" aria-labelledby="editoutgoing" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="<?php echo e(route('outgoingproducts.update', $outgoingprod->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('put'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"
                                                                    id="editOutgoingProductModalLabel">
                                                                    Edit Outgoing Products
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
                                                                                <?php if($outgoingprod->product_id == $id): echo 'selected'; endif; ?>>
                                                                                <?php echo e($name); ?>

                                                                            </option>
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
                                                                    <label for="bartender_id">Bartender</label>
                                                                    <select name="bartender_id" class="form-control"
                                                                        id="bartender_id">
                                                                        <?php $__currentLoopData = $bartenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($id); ?>"
                                                                                <?php if($outgoingprod->bartender_id == $id): echo 'selected'; endif; ?>>
                                                                                <?php echo e($name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <?php $__errorArgs = ['bartender_id'];
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
                                                                        value="<?php echo e($outgoingprod->qty); ?>">
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
                                                                        value="<?php echo e($outgoingprod->date); ?>" required>
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
                                                data-bs-target="#deleteOutgoingProduct-<?php echo e($outgoingprod->id); ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteOutgoingProduct-<?php echo e($outgoingprod->id); ?>"
                                                tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form
                                                            action="<?php echo e(route('outgoingproducts.delete', $outgoingprod->id)); ?>"
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
                                <?php if($outgoingproducts->isEmpty()): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($outgoingproducts->links('pagination::bootstrap-5')); ?>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-danger card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Export Invoices</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="outgoingProductsTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Products</th>
                                    <th>Bartenders</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $outgoingproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $outgoingprod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($outgoingprod->id); ?></td>
                                        <td><?php echo e($outgoingprod->product->name); ?></td>
                                        <td><?php echo e($outgoingprod->bartender->name); ?></td>
                                        <td><?php echo e($outgoingprod->qty); ?></td>
                                        <td><?php echo e($outgoingprod->date); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('outgoingproducts.exportPDF',$outgoingprod->id)); ?>" target="_blank"
                                                rel="noopener noreferrer"class="btn btn-danger">
                                                <i class="fa fa-download"></i> Export PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($outgoingproducts->isEmpty()): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?php echo e($outgoingproducts->links('pagination::bootstrap-5')); ?>

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
                $('#addOutgoingProductModal').modal('show');
            <?php endif; ?>

            // Initialize DataTable only if you are not using server-side pagination
            // Since you have Laravel pagination, it's better to disable DataTables features
            // that conflict with it. The `searching`, `paging`, and `info` options are
            // disabled, leaving only sorting enabled if desired.
            $('#outgoingProductsTable').DataTable({
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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/admin/outgoingproducts.blade.php ENDPATH**/ ?>