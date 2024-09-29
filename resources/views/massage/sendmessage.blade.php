@extends('app', ['page' => 'sendmessage'])

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body" style="max-width: 800px; margin: 0 auto;">
            <h4 class="card-title">Kirim Pesan</h4>

            <!-- Notifikasi pesan sukses atau error -->
            <div id="messageAlert" class="alert" style="display:none;"></div>

            <form id="sendMessageForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input Kepada -->
                <div class="form-group">
                    <label for="to" class="form-label">Kepada</label>
                    <input type="text" class="form-control" id="to" name="to" placeholder="Masukkan penerima"
                        value="{{ $to }}" required>
                </div>

                <!-- Input Kategori -->
                <div class="form-group">
                    <label for="category" class="form-label">Kategori Pesan</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->no_mk }}"
                                {{ old('category') == $category->no_mk ? 'selected' : '' }}>
                                {{ $category->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Subjek -->
                <div class="form-group">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" class="form-control" id="subject" name="subject"
                        placeholder="Masukkan subjek pesan" value="" required>
                </div>

                <!-- Input Pesan -->
                <div class="form-group">
                    <label for="message_text" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message_text" name="message_text" rows="8" required>{{ old('message_text') }}</textarea>
                </div>

                <!-- Input File Lampiran -->
                <div class="form-group">
                    <label for="file" class="form-label">Lampirkan File</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>

                <!-- Tombol Kirim -->
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sendMessageForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah refresh halaman
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('message.store') }}', // Pastikan route ini benar
                    type: 'POST',
                    data: formData,
                    processData: false, // Untuk menangani form data (termasuk file)
                    contentType: false, // Agar tidak mengubah tipe konten
                    success: function(response) {
                        if (response.success) {
                            // Menampilkan pesan sukses
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: response.message,
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                willClose: () => {
                                    // Redirect setelah timer selesai
                                    window.location.href = response.redirect; // Redirect
                                }
                            });
                        } else {
                            // Menampilkan pesan error jika ada
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'An error occurred.';
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: errorMessage,
                        });
                    }
                });
            });
        });

        // Setup CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
