@extends('layouts.layout')
@section('title')
    Supplier
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
                            <a href="{{ route('suppliers.exportPDFAll') }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-danger">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('suppliers.exportExcel') }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-primary">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addsupplier" tabindex="-1" aria-labelledby="addsupplierLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('suppliers.store') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addsupplierLabel">Add Supplier</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="supplier"
                                                    placeholder="Enter Supplier" value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter Email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="number" name="contact" class="form-control" id="contact"
                                                    placeholder="Enter Contact" value="{{ old('contact') }}">
                                                @error('contact')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
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
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->contact }}</td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editsupplier-{{ $supplier->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editsupplier-{{ $supplier->id }}" tabindex="-1"
                                                aria-labelledby="addsupplierLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('suppliers.update', $supplier->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
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
                                                                        value="{{ $supplier->name }}">
                                                                </div>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control" id="email"
                                                                        placeholder="Enter Email"
                                                                        value="{{ $supplier->email }}">
                                                                </div>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="contact">Contact</label>
                                                                    <input type="number" name="contact"
                                                                        class="form-control" id="contact"
                                                                        placeholder="Enter Contact"
                                                                        value="{{ $supplier->contact }}">
                                                                </div>
                                                                @error('contact')
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
                                                data-bs-target="#deletesupplier-{{ $supplier->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deletesupplier-{{ $supplier->id }}"
                                                tabindex="-1" aria-labelledby="addsupplierLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="{{ route('suppliers.delete', $supplier->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
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
                                @endforeach
                                @if ($suppliers->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $suppliers->links('pagination::bootstrap-5') }}
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
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->contact }}</td>
                                        <td>
                                            <a href="{{ route('suppliers.exportPDF',$supplier->id ) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-danger">
                                                <i class="fa fa-download"></i> Export PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($suppliers->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $suppliers->links('pagination::bootstrap-5') }}
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
@endsection
