@extends('app')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card-body">
        <h4 class="card-title">Tambah Menu untuk {{ $user->name }}</h4>
        <p class="card-description">Pilih menu yang ingin ditambahkan untuk user ini.</p>

        <!-- Form untuk menambahkan menu ke user -->
        <form action="{{ route('user.updateMenu', $user->id) }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="menu">Pilih Menu</label>
                <select class="form-control" id="menu" name="menu_ids[]" multiple required>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $user->menus->contains($menu->id) ? 'selected' : '' }}>
                            {{ $menu->menu_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <br>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
