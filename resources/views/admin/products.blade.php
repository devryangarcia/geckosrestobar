@extends('layouts.layout')
@section('title')
    Products
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::get('success'))
                    <!-- Alert -->
                    <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::get('deleted'))
                    <!-- Alert -->
                    <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{ Session::get('deleted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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


                        <!-- Action Buttons + Search -->
                        <div class="d-flex justify-content-between mb-3 mt-2">
                            <!-- Left side: Action Buttons -->
                            <div>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addproducts">
                                    <i class="fa-solid fa-plus"></i> Add Products
                                </button>
                                <a href="{{ route('products.exportPDFAll') }}" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-danger">
                                    <i class="fa fa-download"></i> Export PDF
                                </a>
                                <a href="{{ route('products.exportExcel') }}" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-primary">
                                    <i class="fa fa-download"></i> Export Excel
                                </a>
                            </div>

                            <!-- Right side: Search Form -->
                            <div>
                                <form class="d-flex" method="GET" action="{{ route('products.index') }}">
                                    <input class="form-control me-2" type="text" name="search"
                                        value="{{ request('search') }}" placeholder="Search products...">
                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                </form>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="addproducts" tabindex="-1" aria-labelledby="addproductsLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('products.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addproductsLabel">Add products</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Products</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter products" value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="qty">Quantity</label>
                                                <input type="number" name="qty" class="form-control" id="qty"
                                                    placeholder="Enter quantity" value="{{ old('qty') }}">
                                            </div>
                                            @error('qty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="img">Image</label>
                                                <input type="file" name="img" class="form-control" id="img"
                                                    placeholder="Enter Image">
                                            </div>
                                            @error('img')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select name="category_id" id="category_id" class="form-control select"
                                                    required>
                                                    <option value="">-- Choose Category --</option>
                                                    @foreach ($category as $id => $name)
                                                        <option value="{{ $id }}" @selected(old('qty'))>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td><img src="{{ asset('storage/' . $product->image) }}" alt=""
                                                class="img-fluid" style="max-height: 4rem"></td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editproducts-{{ $product->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editproducts-{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="editproductsLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('products.update', $product->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
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
                                                                        value="{{ $product->name }}">
                                                                </div>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="price">Price</label>
                                                                    <input type="number" name="price"
                                                                        class="form-control" id="price"
                                                                        placeholder="Enter price"
                                                                        value="{{ $product->price }}">
                                                                </div>
                                                                @error('price')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="qty">Quantity</label>
                                                                    <input type="number" name="qty"
                                                                        class="form-control" id="qty"
                                                                        placeholder="Enter quantity"
                                                                        value="{{ $product->qty }}">
                                                                </div>
                                                                @error('qty')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="img">Image</label>
                                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                                        alt="" class="img-fluid"
                                                                        style="max-height: 4rem">
                                                                    <input type="file" name="img"
                                                                        class="form-control" id="img"
                                                                        placeholder="Enter Image"
                                                                        value="{{ $product->image }}">
                                                                </div>
                                                                @error('img')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="category_id">Category</label>
                                                                    <select name="category_id" id="category_id"
                                                                        class="form-control select" required>
                                                                        <option value="" disabled>-- Choose Category
                                                                            --
                                                                        </option>
                                                                        @foreach ($category as $id => $name)
                                                                            <option @selected($product->category->id == $id)
                                                                                value="{{ $id }}">
                                                                                {{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="help-block with-errors"></span>
                                                                </div>
                                                                @error('category_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
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
                                                data-bs-target="#deleteproducts-{{ $product->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteproducts-{{ $product->id }}"
                                                tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="{{ route('products.delete', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
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
                                @endforeach
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $products->links('pagination::bootstrap-5') }}
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
@endsection
