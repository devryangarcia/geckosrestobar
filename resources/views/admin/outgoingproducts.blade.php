@extends('layouts.layout')

@section('title')
    Outgoing Products
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
                            <h4>List of Outgoing Products</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addoutgoing">
                                <i class="fa-solid fa-plus"></i> Add Outgoing Product
                            </button>
                            <a href="{{ route('outgoingproducts.exportPDFAll') }}" target="_blank"
                                rel="noopener noreferrer"class="btn btn-danger">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('outgoingproducts.exportExcel') }}" target="_blank" rel="noopener noreferrer"class="btn btn-primary">
                                <i class="fa fa-download"></i> Export Excel
                            </a>
                        </div>

                        <div class="modal fade" id="addoutgoing" tabindex="-1" aria-labelledby="addoutgoing"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('outgoingproducts.store') }}" method="post">
                                        @csrf
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
                                                    @foreach ($products as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('product_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="bartender_id">Bartender</label>
                                                <select name="bartender_id" class="form-control" id="bartender_id">
                                                    @foreach ($bartenders as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('bartender_id')
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
                                @foreach ($outgoingproducts as $outgoingprod)
                                    <tr>
                                        <td>{{ $outgoingprod->id }}</td>
                                        <td>{{ $outgoingprod->product->name }}</td>
                                        <td>{{ $outgoingprod->bartender->name }}</td>
                                        <td>{{ $outgoingprod->qty }}</td>
                                        <td>{{ $outgoingprod->date }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editOutgoingProduct-{{ $outgoingprod->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>

                                            <div class="modal fade" id="editOutgoingProduct-{{ $outgoingprod->id }}"
                                                tabindex="-1" aria-labelledby="editoutgoing" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('outgoingproducts.update', $outgoingprod->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
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
                                                                        @foreach ($products as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                @selected($outgoingprod->product_id == $id)>
                                                                                {{ $name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('product_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                                <div class="form-group">
                                                                    <label for="bartender_id">Bartender</label>
                                                                    <select name="bartender_id" class="form-control"
                                                                        id="bartender_id">
                                                                        @foreach ($bartenders as $id => $name)
                                                                            <option value="{{ $id }}"
                                                                                @selected($outgoingprod->bartender_id == $id)>
                                                                                {{ $name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('bartender_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                                <div class="form-group">
                                                                    <label for="qty">Quantity</label>
                                                                    <input type="number" name="qty"
                                                                        class="form-control" id="qty"
                                                                        value="{{ $outgoingprod->qty }}">
                                                                </div>
                                                                @error('qty')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                                <div class="form-group">
                                                                    <label for="date">Date</label>
                                                                    <input type="date" name="date"
                                                                        class="form-control" id="date"
                                                                        value="{{ $outgoingprod->date }}" required>
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
                                                data-bs-target="#deleteOutgoingProduct-{{ $outgoingprod->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteOutgoingProduct-{{ $outgoingprod->id }}"
                                                tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('outgoingproducts.delete', $outgoingprod->id) }}"
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
                                @if ($outgoingproducts->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $outgoingproducts->links('pagination::bootstrap-5') }}
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
                                @foreach ($outgoingproducts as $outgoingprod)
                                    <tr>
                                        <td>{{ $outgoingprod->id }}</td>
                                        <td>{{ $outgoingprod->product->name }}</td>
                                        <td>{{ $outgoingprod->bartender->name }}</td>
                                        <td>{{ $outgoingprod->qty }}</td>
                                        <td>{{ $outgoingprod->date }}</td>
                                        <td>
                                            <a href="{{ route('outgoingproducts.exportPDF',$outgoingprod->id) }}" target="_blank"
                                                rel="noopener noreferrer"class="btn btn-danger">
                                                <i class="fa fa-download"></i> Export PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($outgoingproducts->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No outgoing products available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $outgoingproducts->links('pagination::bootstrap-5') }}
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
                $('#addOutgoingProductModal').modal('show');
            @endif

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
@endpush
