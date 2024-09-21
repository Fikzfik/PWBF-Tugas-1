@extends('app', ['page' => 'roles'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Add Role</h4>
            <p class="card-description">Add a new role to the system</p>

            <!-- Form untuk menambahkan role baru -->
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_jenis_user">Role Name</label>
                    <input type="text" class="form-control" id="nama_jenis_user" name="nama_jenis_user" placeholder="Enter role name" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Roles</h4>
            <p class="card-description">List of all roles in the system</p>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->nama_jenis_user }}</td>
                                <td>
                                    <a href="{{ route('roles.show', $role->id_jenis_user) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('roles.edit', $role->id_jenis_user) }}" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <!-- Tombol Tambahkan Menu Role -->
                                    <a href="{{ route('roles.addmenu', $role->id_jenis_user) }}" class="btn btn-primary btn-sm">Tambahkan Menu Role</a>

                                    <form action="{{ route('roles.destroy', $role->id_jenis_user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
                                    </form>
                                </td>                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
