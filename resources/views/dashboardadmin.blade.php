@extends('app', ['page' => 'users'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">User Registration</h4>
            <p class="card-description">Daftarkan pengguna baru</p>

            <!-- Form untuk mendaftarkan user baru -->
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama pengguna" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email pengguna" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
                </div>
                <div class="form-group">
                    <label for="id_jenis_user">Jenis User</label>
                    <select class="form-select" id="id_jenis_user" name="id_jenis_user" required>
                        <option value="">Pilih Jenis User</option>
                        @foreach($jenis_user as $jenis)
                            <option value="{{ $jenis->id_jenis_user }}">{{ $jenis->nama_jenis_user }}</option>
                        @endforeach
                    </select>
                </div>
                

                <button type="submit" class="btn btn-primary">Daftarkan User</button>
            </form>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">User Table</h4>
            <p class="card-description">Daftar semua pengguna terdaftar</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Jenis User</th>
                            <th>Update/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>{{ $user->jenisUser->nama_jenis_user }}
                                </td>
                                <td>
                                    <a href="/edituser/{{ $user->user_id }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener for dropdown change
            $('.form-select').change(function() {
                var userId = $(this).closest('form').attr('id').split('-')[2];
                // Submit the form associated with the changed dropdown
                $('#add-menu-' + userId).submit();
            });
        });
    </script>
@endsection
