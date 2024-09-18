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
@endsection
