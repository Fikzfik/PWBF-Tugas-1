@extends('app', ['page' => 'mailbox'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Mailbox</h4>
            <p class="card-description">Daftar semua email yang diterima</p>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Sender</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $massage)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $massage->subject }}</td>
                                <td>{{ $massage->massage_reference }}</td>
                                <td>{{ $massage->massage_status }}</td>
                                <td>
                                    <a href="/massageview/{{ $massage->massage_id }}" class="btn btn-info btn-sm">View</a>
                                    <form action="/massagedelete/{{ $massage->massage_id  }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus email ini?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
