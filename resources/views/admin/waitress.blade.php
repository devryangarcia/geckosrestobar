@extends('layouts.layout')
@section('title')
    Waitress
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
                            <h4>List of Waitresses</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addwaitress">
                                <i class="fa-solid fa-plus"></i> Add waitress
                            </button>
                            <a href="{{ route('waitress.exportPDFAll') }}" target="_blank" class="btn btn-danger"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('waitress.exportExcel') }}" target="_blank" class="btn btn-primary"
                                rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addwaitress" tabindex="-1" aria-labelledby="addwaitressLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('waitress.store') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addwaitressLabel">Add Waitress</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="waitress"
                                                    placeholder="Enter waitress" value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
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
                        <table id="waitressTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($waitresses as $waitress)
                                    <tr>
                                        <td>{{ $waitress->id }}</td>
                                        <td>{{ $waitress->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editwaitress-{{ $waitress->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editwaitress-{{ $waitress->id }}" tabindex="-1"
                                                aria-labelledby="addwaitressLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('waitress.update',$waitress->id) }}" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editwaitressLabel">Edit
                                                                    waitress
                                                                </h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="editwaitress">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="editwaitress"
                                                                        placeholder="Enter waitress"
                                                                        value="{{ $waitress->name }}">
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
                                                data-bs-target="#deletewaitress-{{ $waitress->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deletewaitress-{{ $waitress->id }}"
                                                tabindex="-1" aria-labelledby="addwaitressLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="{{ route('waitress.delete',$waitress->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="editwaitressLabel">Delete
                                                                    waitress
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
                                @endforeach
                                @if ($waitresses->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $waitresses->links('pagination::bootstrap-5') }}
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
        $('#waitressTable').DataTable({
            paging: false, // disable DataTables pagination
            info: false, // hide "Showing x to y of z entries"
            searching: false,
            ordering: true,
        });
    </script>
    
@endsection
