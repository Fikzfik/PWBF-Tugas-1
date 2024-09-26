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

    <div class="card" style="width: 18rem;">
        <img src="/" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Kelas</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Tugas dan Pengumuman</h4>
            <!-- Tampilkan tugas dan pengumuman di sini -->
        </div>
    </div>
@endsection
