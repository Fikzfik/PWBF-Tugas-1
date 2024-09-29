@extends('app', ['page' => 'dashboard'])

@section('content')
    <div class="container">
        <h1>Social Feed</h1>

        <!-- Form untuk membuat posting -->
        <form action="{{ route('social-feed.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea name="message_text" class="form-control" placeholder="Apa yang ingin kamu bagikan?" required></textarea>
            <input type="file" name="message_gambar" class="form-control mt-2">
            <button type="submit" class="btn btn-primary mt-2">Post</button>
        </form>
        
        <!-- Menampilkan postingan -->
        @foreach ($postings as $posting)
            <div class="card mt-4">
                <div class="card-body">
                    <h5>{{ $posting->user->name }}</h5>
                    <p>{{ $posting->message_text }}</p>
                    @if ($posting->message_gambar)
                        <img src="{{ asset('storage/' . $posting->message_gambar) }}" alt="Message Image" class="img-fluid">
                    @endif
                    <small>Posted on {{ $posting->CREATE_DATE }}</small>

                    <div>
                        <!-- Like -->
                        <form action="{{ route('social-feed.like', $posting->posting_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link">Like ({{ $posting->likes->count() }})</button>
                        </form>

                        <!-- Komentar -->
                        <form action="{{ route('social-feed.comment', $posting->posting_id) }}" method="POST">
                            @csrf
                            <textarea name="komentar_text" class="form-control" placeholder="Tambahkan komentar"></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Comment</button>
                        </form>

                        <!-- Menampilkan komentar -->
                        @foreach ($posting->comments as $comment)
                            <div class="mt-3">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->komentar_text }}

                                @if ($comment->user_id == auth()->user()->user_id)
                                    <!-- Tombol Hapus komentar (hanya ditampilkan jika ini komentar user yang sedang login) -->
                                    <form action="{{ route('social-feed.comment.delete', $comment->komen_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
