@extends('app', ['page' => 'mailbox'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Mailbox</h4>
                <p class="card-description">Daftar semua email yang diterima</p>
                <div class="mb-3">
                    <input type="text" id="searchEmail" class="form-control" placeholder="Search emails..."
                        aria-label="Search">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Compose</button>
                    <button class="btn btn-light">Refresh</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <input type="checkbox" aria-label="Select all">
                                </th>
                                <th>Subject</th>
                                <th>Sender</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $massage)
                                <tr>
                                    <td>
                                        <input type="checkbox" aria-label="Select message">
                                    </td>
                                    <td>{{ $massage->subject }}</td>
                                    <td>{{ $massage->massage_reference }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $massage->massage_status == 'Dibaca' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $massage->massage_status }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($massage->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <a href="/massageview/{{ $massage->massage_id }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <form action="/massagedelete/{{ $massage->massage_id }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus email ini?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.9rem;
        }

        .thead-light {
            background-color: #f8f9fa;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchEmail').on('keyup', function() {
                var query = $(this).val();

                $.ajax({
                    url: "{{ route('messages.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        var tbody = $('tbody');
                        tbody.empty(); // Hapus konten tabel sebelumnya

                        // Jika tidak ada hasil pencarian
                        if (response.messages.length === 0) {
                            tbody.append(
                                '<tr><td colspan="6" class="text-center">No emails found</td></tr>'
                                );
                        } else {
                            // Loop data pesan yang dikembalikan
                            $.each(response.messages, function(index, message) {
                                tbody.append(`
                                    <tr>
                                        <td><input type="checkbox" aria-label="Select message"></td>
                                        <td>${message.subject}</td>
                                        <td>${message.massage_reference}</td>
                                        <td>
                                            <span class="badge ${message.massage_status == 'Dibaca' ? 'badge-success' : 'badge-danger'}">
                                                ${message.massage_status}
                                            </span>
                                        </td>
                                        <td>${new Date(message.created_at).toLocaleDateString()}</td>
                                        <td>
                                            <a href="/massageview/${message.massage_id}" class="btn btn-info btn-sm">View</a>
                                            <form action="/massagedelete/${message.massage_id}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus email ini?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                `);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
