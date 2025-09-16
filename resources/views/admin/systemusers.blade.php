@extends('layouts.layout')
@section('title')
    Users
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
                            <h4>List of User</h4>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">


                        <!-- Action Buttons -->
                        <div class="mb-3 mt-2">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adduser">
                                <i class="fa-solid fa-plus"></i> Add User
                            </button>
                            <a href="{{ route('users.exportPDFAll') }}" target="_blank" class="btn btn-danger" rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export PDF
                            </a>
                            <a href="{{ route('users.exportExcel') }}" target="_blank" class="btn btn-primary" rel="noopener noreferrer">
                                <i class="fa fa-download"></i> Export Excel
                            </a>

                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduserLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('users.store') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="adduserLabel">Add User</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="user"
                                                    placeholder="Enter User" value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter Email" value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="" disabled selected>-- Select Role --</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="staff">Staff</option>
                                                </select>
                                            </div>
                                            @error('role')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="role">Password</label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Enter Password" value="{{ old('password') }}">
                                            </div>
                                            @error('password')
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
                        <table id="usersTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucwords($user->role) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#edituser-{{ $user->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edituser-{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="adduserLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('users.update',$user->id) }}" method="post">
                                                            @csrf @method('put')
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="adduserLabel">Edit User</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" id="user"
                                                                        placeholder="Enter User"
                                                                        value="{{ $user->name }}">
                                                                </div>
                                                                @error('name')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="email">Email Address</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control" id="email"
                                                                        placeholder="Enter Email"
                                                                        value="{{ $user->email }}">
                                                                </div>
                                                                @error('email')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="role">Role</label>
                                                                    @if ($user->id == 1)
                                                                        <span class="text-danger">*Main Admin Role – Cannot be changed</span>
                                                                    @endif
                                                                    <select name="role" id="role"
                                                                        class="form-control" @disabled($user->id == "1")>
                                                                        <option value="" disabled>-- Select
                                                                            Role --</option>
                                                                        <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                                                        <option value="staff" @selected($user->role == 'staff')>Staff</option>
                                                                    </select>
                                                                </div>
                                                                @error('role')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
                                                                @enderror
                                                                <div class="form-group">
                                                                    <label for="role">Password <span>(optional)</span></label>
                                                                    <input type="password" name="password"
                                                                        class="form-control" id="password"
                                                                        placeholder="Enter Password"
                                                                        value="{{ old('password') }}">
                                                                </div>
                                                                @error('password')
                                                                    <div class="invalid-feedback d-block">{{ $message }}
                                                                    </div>
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
                                                data-bs-target="#deleteuser-{{ $user->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteuser-{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="addsupplierLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="{{ route('users.delete', $user->id) }}"
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
                                                                <h4 class="text-danger">Are you sure to delete the user?
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
                                @if ($users->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No product available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                        <!-- Laravel-style pagination -->
                        <div class="mt-3">
                            {{ $users->links('pagination::bootstrap-5') }}
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
        $('#usersTable').DataTable({
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
