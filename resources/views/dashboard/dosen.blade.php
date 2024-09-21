@extends('app', ['page' => 'dashboard'])

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profil Dosen</h4>
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>No. HP:</strong> {{ Auth::user()->no_hp }}</p>
                <a href="{{ route('dosen.edit', Auth::user()->user_id) }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jadwal Mengajar</h4>
                <ul class="list-group">
                    {{-- @foreach($jadwalMengajar as $jadwal)
                        <li class="list-group-item">
                            <strong>Mata Kuliah:</strong> {{ $jadwal->mata_kuliah }}<br>
                            <strong>Hari:</strong> {{ $jadwal->hari }}<br>
                            <strong>Waktu:</strong> {{ $jadwal->waktu }}<br>
                            <strong>Ruang:</strong> {{ $jadwal->ruang }}
                        </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Mahasiswa</h4>
                <ul class="list-group">
                    {{-- @foreach($mahasiswa as $mhs)
                        <li class="list-group-item">
                            <strong>ID:</strong> {{ $mhs->id }}<br>
                            <strong>Nama:</strong> {{ $mhs->name }}<br>
                            <strong>Email:</strong> {{ $mhs->email }}<br>
                            <strong>No. HP:</strong> {{ $mhs->no_hp }}
                        </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengumuman</h4>
                <ul class="list-group">
                    {{-- @foreach($pengumuman as $pengumumanItem)
                        <li class="list-group-item">
                            {{ $pengumumanItem->isi }} - <small>{{ $pengumumanItem->created_at->format('d M Y') }}</small>
                        </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
    </div>
@endsection
