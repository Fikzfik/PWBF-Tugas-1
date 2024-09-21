@extends('app', ['page' => 'kategori'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Kategori</h4>
                <form class="forms-sample" method="POST" action="/submitkategori">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Kategori</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Kategori" name="kategori">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body col-12">
        <h4 class="card-title">Daftar Kategori</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Dibuat Sejak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>{{ $k->created_at->format('d M Y') }}</td>
                        <td>
                            @if($k->status)
                                Aktif
                            @else
                                Non-aktif
                            @endif
                        </td>
                        <td>
                            @if($k->status)
                                <!-- Form untuk hapus kategori -->
                                <form action="/kategori/{{ $k->id_kategori }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?');">Delete</button>
                                </form>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
