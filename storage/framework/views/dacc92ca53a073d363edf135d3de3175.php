
<?php $__env->startSection('title'); ?>
    Products
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
                            <h4>List of Products</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addproducts">
                                <i class="fa-solid fa-plus"></i> Add Products
                            </button>
                            <button class="btn btn-danger">Export PDF</button>
                            <button class="btn btn-primary">Export Excel</button>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addproducts" tabindex="-1" aria-labelledby="addproductsLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="<?php echo e(route('products.store')); ?>" method="post"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addproductsLabel">Add products</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Products</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter products" value="<?php echo e(old('name')); ?>">
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
                                                <label for="qty">Quantity</label>
                                                <input type="number" name="qty" class="form-control" id="qty"
                                                    placeholder="Enter quantity" value="<?php echo e(old('qty')); ?>">
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
                                                <label for="img">Image</label>
                                                <input type="file" name="img" class="form-control" id="img"
                                                    placeholder="Enter Image">
                                            </div>
                                            <?php $__errorArgs = ['img'];
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
                                                <label for="category_id">Category</label>
                                                <select name="category_id" id="category_id" class="form-control select"
                                                    required>
                                                    <option value="">-- Choose Category --</option>
                                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>" <?php if(old('qty')): echo 'selected'; endif; ?>>
                                                            <?php echo e($name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                            <?php $__errorArgs = ['category_id'];
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
                        <!-- Table -->
                        <table id="productsTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($product->id); ?></td>
                                        <td><?php echo e($product->name); ?></td>
                                        <td><?php echo e($product->qty); ?></td>
                                        <td><img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt=""
                                                class="img-fluid" style="max-height: 4rem"></td>
                                        <td><?php echo e($product->category->name); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editproducts-<?php echo e($product->id); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editproducts-<?php echo e($product->id); ?>" tabindex="-1"
                                                aria-labelledby="editproductsLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('products.update',$product->id)); ?>" method="post"
                                                            enctype="multipart/form-data">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('put'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editproductsLabel">Edit
                                                                    Products
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="name">Products</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter products"
                                                                        value="<?php echo e($product->name); ?>">
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
                                                                    <label for="price">Price</label>
                                                                    <input type="number" name="price"
                                                                        class="form-control" id="price"
                                                                        placeholder="Enter price"
                                                                        value="<?php echo e($product->price); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['price'];
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
                                                                        placeholder="Enter quantity"
                                                                        value="<?php echo e($product->qty); ?>">
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
                                                                    <label for="img">Image</label>
                                                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                                                        alt="" class="img-fluid"
                                                                        style="max-height: 4rem">
                                                                    <input type="file" name="img"
                                                                        class="form-control" id="img"
                                                                        placeholder="Enter Image"
                                                                        value="<?php echo e($product->image); ?>">
                                                                </div>
                                                                <?php $__errorArgs = ['img'];
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
                                                                    <label for="category_id">Category</label>
                                                                    <select name="category_id" id="category_id"
                                                                        class="form-control select" required>
                                                                        <option value="" disabled>-- Choose Category --
                                                                        </option>
                                                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option <?php if($product->category->id == $id): echo 'selected'; endif; ?>
                                                                                value="<?php echo e($id); ?>">
                                                                                <?php echo e($name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                                <?php $__errorArgs = ['category_id'];
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
                                                data-bs-target="#deleteproducts-<?php echo e($product->id); ?>">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteproducts-<?php echo e($product->id); ?>" tabindex="-1"
                                                aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="<?php echo e(route('products.delete',$product->id)); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editproductLabel">Delete product
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="text-danger">Are you sure to delete the record?</h4>
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
                                <?php if($products->isEmpty()): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            <?php echo e($products->links('pagination::bootstrap-5')); ?>

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
        $('#productsTable').DataTable({
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

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\King Ryan\Music\InventoryMS\resources\views/products.blade.php ENDPATH**/ ?>