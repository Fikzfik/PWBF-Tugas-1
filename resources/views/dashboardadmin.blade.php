@extends('app' , ['page' => 'users'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">User Registration</h4>
            <p class="card-description">Daftarkan pengguna baru</p>

            <!-- Form untuk mendaftarkan user baru -->
            <form action="/usersubmit" method="POST">
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
                        <option value="1">Admin</option>
                        <option value="2">Mahasiswa</option>
                        <option value="3">Dosen</option>
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
                    <th>Menu Dimiliki</th>
                    <th>Tambah Menu</th>
                    <th>Update/Delete</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @dd($users); --}}
                  @foreach($users as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->no_hp }}</td>
                      <td>
                        @if($user->id_jenis_user == 2)
                            Mahasiswa
                        @elseif($user->id_jenis_user == 3)
                            Dosen
                        @else
                            Admin
                        @endif
                      </td>
                      <td>
                        <!-- Tampilkan menu yang sudah dimiliki oleh user -->
                        {{-- @dd() --}}
                        <ul>
                            @foreach($user->menus as $menu)
                                <li>{{ $menu->menu_name }}</li>
                            @endforeach
                        </ul>
                      </td>
                      <td>
                        <!-- Form untuk menambahkan menu baru ke user -->
                        <form action="{{ route('users.addMenus', $user->id) }}" method="POST" id="add-menu-{{ $user->id }}">
                          @csrf
                          <select name="menu_id" class="form-select" required>
                            @foreach($menus as $menu)
                                <!-- Cek apakah menu sudah dimiliki oleh user -->
                                @if(!$user->menus->contains($menu->id))
                                    <option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
                                @endif
                            @endforeach
                          </select>
                          <button type="submit" class="btn btn-sm btn-primary mt-2">Tambah Menu</button>
                        </form>
                      </td>
                      <td>
                        <!-- Edit Button -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
                var userId = $(this).data('user-id');
                // Submit the form associated with the changed dropdown
                $('#form-' + userId).submit();
            });
        });
    </script>
@endsection
