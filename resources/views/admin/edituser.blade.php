@extends('app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Edit Mahasiswa</h4>
            <p class="card-description">Ubah data mahasiswa dan role</p>

            <!-- Form untuk mengedit data mahasiswa -->
            <form action="{{ route('users.update', $user->user_id) }}" method="POST">
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

                <!-- Dropdown untuk mengganti role (jenis user) -->
                <div class="form-group">
                    <label for="id_jenis_user">Jenis User</label>
                    <select class="form-select" id="id_jenis_user" name="id_jenis_user" required>
                        <option value="1" {{ $user->id_jenis_user == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->id_jenis_user == 2 ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="3" {{ $user->id_jenis_user == 3 ? 'selected' : '' }}>Dosen</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
                <a href="/dashboardadmin" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
@endsection
