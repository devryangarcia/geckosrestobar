@extends('layouts.layout')

@section('title')
    Incoming Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if (Session::get('success'))
                    <div class="alert bg-success text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (Session::get('deleted'))
                    <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        {{ Session::get('deleted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                            <a href="{{ route('incomingproducts.exportPDFAll') }}" target="_blank" class="btn btn-danger"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('incomingproducts.exportExcel') }}" target="_blank" class="btn btn-primary"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>
                        </div>

                        <div class="modal fade" id="addincoming" tabindex="-1" aria-labelledby="addincoming"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="" method="post">
                                        @csrf
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
                                                    @foreach ($products as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('product_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="supplier_id">Supplier</label>
                                                <select name="supplier_id" class="form-control" id="supplier_id">
                                                    @foreach ($suppliers as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('supplier_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="qty">Quantity</label>
                                                <input type="number" name="qty" class="form-control" id="qty">
                                            </div>
                                            @error('qty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    required>
                                            </div>
                                            @error('date')
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
                                @foreach ($incomingproducts as $incomingprod)
                                    <tr>
                                        <td>{{ $incomingprod->id }}</td>
                                        <td>{{ $incomingprod->product->name }}</td>
                                        <td>{{ $incomingprod->supplier->name }}</td>
                                        <td>{{ $incomingprod->qty }}</td>
                                        <td>{{ $incomingprod->date }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editincomingproduct-{{ $incomingprod->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <div class="modal fade" id="editincomingproduct-{{ $incomingprod->id }}"
                                                tabindex="-1"
                                                aria-labelledby="editincomingproduct-{{ $incomingprod->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('incomingproducts.update', $incomingprod->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
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
                                                                        @foreach ($products as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                @selected($incomingprod->product_id == $id)>
                                                                                {{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('product_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="supplier_id">Supplier</label>
                                                                    <select name="supplier_id" class="form-control"
                                                                        id="supplier_id">
                                                                        @foreach ($suppliers as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                @selected($incomingprod->supplier_id == $id)>
                                                                                {{ $name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('supplier_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="qty">Quantity</label>
                                                                    <input type="number" name="qty"
                                                                        class="form-control" id="qty"
                                                                        value="{{ $incomingprod->qty }}">
                                                                </div>
                                                                @error('qty')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="date">Date</label>
                                                                    <input type="date" name="date"
                                                                        class="form-control" id="date"
                                                                        value="{{ $incomingprod->date }}" required>
                                                                </div>
                                                                @error('date')
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
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteincomingproduct-{{ $incomingprod->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteincomingproduct-{{ $incomingprod->id }}"
                                                tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('incomingproducts.delete', $incomingprod->id) }}"
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
                                @if ($incomingproducts->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $incomingproducts->links('pagination::bootstrap-5') }}
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
                                @foreach ($incomingproducts as $incomingprod)
                                    <tr>
                                        <td>{{ $incomingprod->id }}</td>
                                        <td>{{ $incomingprod->product->name }}</td>
                                        <td>{{ $incomingprod->supplier->name }}</td>
                                        <td>{{ $incomingprod->qty }}</td>
                                        <td>{{ $incomingprod->date }}</td>
                                        <td>
                                            <a href="{{ route('incomingproducts.exportPDF',$incomingprod->id)}}" class="btn btn-danger" target="_blank" rel="noopener noreferrer">
                                                <i class="fa fa-download"></i> Export Invoice
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($incomingproducts->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $incomingproducts->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if there are validation errors and show the modal
            @if ($errors->any())
                $('#addincomingproductModal').modal('show');
            @endif

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
@endpush
