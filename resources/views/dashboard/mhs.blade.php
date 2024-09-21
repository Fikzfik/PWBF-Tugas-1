@extends('app', ['page' => 'dashboard'])

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Profil Mahasiswa</h4>
            <p>Nama: {{ Auth::user()->name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <p>No. HP: {{ Auth::user()->no_hp }}</p>
            {{-- <a href="{{ route('mahasiswa.edit', Auth::user()->user_id) }}" class="btn btn-primary">Edit Profil</a> --}}
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Jadwal Kuliah</h4>
            <!-- Tampilkan jadwal kuliah di sini -->
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Tugas dan Pengumuman</h4>
            <!-- Tampilkan tugas dan pengumuman di sini -->
        </div>
    </div>
@endsection
