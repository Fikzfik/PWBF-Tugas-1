@extends('app' , ['page' => 'buku'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Buku</h4>
                <form class="forms-sample" method="POST" action="/submitbook">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Pengarang</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="pengarang" required name="pengarang">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Judul</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="judul" required name="judul">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Kode</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="kode" required name="kode">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Large select</label>
                        <select class="form-select form-select-lg" id="exampleFormControlSelect1" name="id_kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body col-12">
        <h4 class="card-title">Daftar Buku</h4>
        <form method="POST" action="/deleteall">
            @csrf
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengarang</th>
                            <th>Judul</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Hapus</th>
                            <th>Select All <input id="selectAll" style="margin-left: 10px" type="checkbox"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->kode }}</td>
                            <td>{{ $book->id_kategori ? $book->kategori->nama_kategori  : 'Kosong' }}</td>
                            <td>{{ $book->created_at->format('d M Y') }}</td>
                            <td>
                                @if($book->status)
                                    <form action="{{ route('book.destroy', $book->id_buku) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>
                                <input class="book-checkbox" type="checkbox" name="selected_books[]" value="{{ $book->id_buku }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Hapus Buku Terpilih</button>
        </form>
    </div>

    {{-- Tambahkan JavaScript di bagian bawah halaman --}}
    <script>
        document.getElementById('selectAll').addEventListener('click', function(event) {
            let checkboxes = document.querySelectorAll('.book-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });
    </script>
@endsection
