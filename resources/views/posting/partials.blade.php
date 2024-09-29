<div class="mt-3" id="comment-{{ $comment->komen_id }}">
    <strong>{{ $comment->user->name }}:</strong> {{ $comment->komentar_text }}
    @if ($comment->user_id == auth()->user()->user_id)
        <button class="btn btn-danger btn-sm delete-comment" data-comment-id="{{ $comment->komen_id }}">Hapus</button>
    @endif
</div>
