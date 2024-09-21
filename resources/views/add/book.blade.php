@extends('app', ['page' => 'buku'])

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Buku</h4>
                <form class="forms-sample" method="POST" action="/submitbook">
                    @csrf
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" placeholder="pengarang" required
                            name="pengarang">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" placeholder="judul" required
                            name="judul">
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" placeholder="kode" required
                            name="kode">
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select class="form-select form-select-lg" id="id_kategori" name="id_kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="button" class="btn btn-light" onclick="window.location.reload()">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body col-12">
        <h4 class="card-title">Daftar Buku</h4>
        <form id="bulkDeleteForm">
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
                        @foreach ($books as $book)
                            <tr id="book-row-{{ $book->id_buku }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->pengarang }}</td>
                                <td>{{ $book->judul }}</td>
                                <td>{{ $book->kode }}</td>
                                <td>{{ $book->id_kategori ? $book->kategori->nama_kategori : 'Kosong' }}</td>
                                <td>{{ $book->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($book->status)
                                        <button type="button" class="btn btn-danger btn-sm delete-book"
                                            data-id="{{ $book->id_buku }}">Delete</button>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>
                                    <input class="book-checkbox" type="checkbox" name="selected_books[]"
                                        value="{{ $book->id_buku }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-danger mt-3" id="bulkDeleteButton">Hapus Buku Terpilih</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.delete-book', function() {
            var bookId = $(this).data('id');

            if (confirm('Apakah kamu yakin ingin menghapus buku ini?')) {
                $.ajax({
                    url: '/books/' + bookId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response); // Debugging response
                        if (response.success) {
                            alert(response.message);
                            $('#book-row-' + bookId).remove(); // Hapus baris tabel
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menghapus buku.');
                    }
                });
            }
        });


        // Select All Checkbox
        document.getElementById('selectAll').addEventListener('click', function(event) {
            let checkboxes = document.querySelectorAll('.book-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = event.target.checked;
            });
        });

        // Hapus Massal Buku dengan AJAX
        $('#bulkDeleteButton').on('click', function() {
            var selectedBooks = [];
            $('.book-checkbox:checked').each(function() {
                selectedBooks.push($(this).val());
            });

            if (selectedBooks.length > 0) {
                if (confirm('Apakah kamu yakin ingin menghapus buku yang dipilih?')) {
                    $.ajax({
                        url: '{{ route('book.destroys') }}',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "selected_books": selectedBooks
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                selectedBooks.forEach(function(bookId) {
                                    $('#book-row-' + bookId).remove();
                                });
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan saat menghapus buku.');
                        }
                    });
                }
            } else {
                alert('Pilih setidaknya satu buku untuk dihapus.');
            }
        });
    </script>
@endsection
