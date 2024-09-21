@extends('app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Edit Menu</h4>
            <form action="{{ route('menu.update', $menu->menu_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="menu_name">Menu Name</label>
                    <input type="text" class="form-control" id="menu_name" name="menu_name" value="{{ $menu->menu_name }}" required>
                </div>
                <div class="form-group">
                    <label for="menu_link">Menu Link</label>
                    <input type="text" class="form-control" id="menu_link" name="menu_link" value="{{ $menu->menu_link }}">
                </div>
                <div class="form-group">
                    <label for="menu_icon">Menu Icon</label>
                    <input type="text" class="form-control" id="menu_icon" name="menu_icon" value="{{ $menu->menu_icon }}">
                </div>
                <div class="form-group">
                    <label for="parent_id">Parent ID</label>
                    <input type="text" class="form-control" id="parent_id" name="parent_id" value="{{ $menu->parent_id }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Menu</button>
            </form>
        </div>
    </div>
@endsection
