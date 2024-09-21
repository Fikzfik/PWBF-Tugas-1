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
                    <label for="role_name">Role Name</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->nama_jenis_user }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
        </div>
    </div>
@endsection
