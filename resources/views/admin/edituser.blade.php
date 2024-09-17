@extends('app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Edit Mahasiswa</h4>
            <p class="card-description">Ubah data mahasiswa</p>

            <!-- Form untuk mengedit data mahasiswa -->
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Nama mahasiswa" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email mahasiswa" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" placeholder="Nomor HP mahasiswa" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
                <a href="/dashboardadmin" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
