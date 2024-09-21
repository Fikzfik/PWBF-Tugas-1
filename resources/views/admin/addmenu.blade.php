@extends('app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Add Menu</h4>
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="menu_name">Menu Name</label>
                    <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Enter menu name" required>
                </div>
                <div class="form-group">
                    <label for="menu_link">Menu Link</label>
                    <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Enter menu link">
                </div>
                <div class="form-group">
                    <label for="menu_icon">Menu Icon</label>
                    <input type="text" class="form-control" id="menu_icon" name="menu_icon" placeholder="Enter menu icon">
                </div>
                <div class="form-group">
                    <label for="parent_id">Parent ID</label>
                    <input type="text" class="form-control" id="parent_id" name="parent_id" placeholder="Enter parent ID">
                </div>
                <button type="submit" class="btn btn-primary">Add Menu</button>
            </form>
        </div>
    </div>

    <!-- Displaying the list of menus -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">List of Menus</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Menu Name</th>
                            <th>Menu Link</th>
                            <th>Menu Icon</th>
                            <th>Parent ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->menu_name }}</td>
                                <td>{{ $menu->menu_link }}</td>
                                <td>{{ $menu->menu_icon }}</td>
                                <td>{{ $menu->parent_id }}</td>
                                <td>
                                    {{-- <a href="{{ route('menu.show', $menu->menu_id) }}" class="btn btn-info btn-sm">View</a> --}}
                                    <a href="{{ route('menu.edit', $menu->menu_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('menu.destroy', $menu->menu_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</button>
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
