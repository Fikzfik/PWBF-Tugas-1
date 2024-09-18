@extends('app', ['page' => 'roles'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Role Details</h4>
            <p class="card-description">Details for role: {{ $role->nama_jenis_user }}</p>

            <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" class="form-control" id="role_name" value="{{ $role->nama_jenis_user }}" disabled>
            </div>

            @if($menus->isNotEmpty())
                <h5 class="mt-4">Associated Menus</h5>
                <ul>
                    @foreach($menus as $menu)
                        <li>{{ $menu->menu_name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No associated menus for this role.</p>
            @endif

            <a href="{{ route('admin.addrole') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
