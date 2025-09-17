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
                            <h4>List of Waitresses Drinks</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <a href="{{ route('ladiesdrinks.exportPDFAll') }}" target="_blank" class="btn btn-danger" rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('ladiesdrinks.exportExcel')}}" target="_blank" class="btn btn-primary" rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Table -->
                        <table id="waitressTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Waitress ID</th>
                                    <th>Name</th>
                                    <th>Drinks Today</th>
                                    <th>Record Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($waitressStats as $stat)
                                    <tr>
                                        <td>{{ $stat->waitress->id ?? 'N/A' }}</td>
                                        <td>{{ $stat->waitress->name ?? 'Unknown' }}</td>
                                        <td>{{ $stat->total_drinks }}</td>
                                        <td>{{ $stat->record_date }}</td>
                                        <td>
                                            <a href="{{ route('ladiesdrinks.exportPDF',$stat->waitress->id) }}" target="_blank" class="btn btn-danger"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-download"></i> Export PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($waitressStats->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No records found</td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $waitressStats->links('pagination::bootstrap-5') }}
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
