<div class="mb-2">
    <a href="{{ route('profile.show', $comment->user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $comment->user->name }}</a>
    &nbsp;
    <span class="fw-light">{{ $comment->body }}</span>
    <br>
    <span class="text-muted xsmall">{{ date('D, M d Y', strtotime($comment->created_at)) }}</span>

    @if($comment->user_id == Auth::user()->id)
        <form action="{{ route('comment.destroy', $comment->id)}}" method="post" class="d-inline">
            @csrf 
            @method('DELETE')
            &middot;
            <button type="submit" class="btn xsmall text-danger shadow-none p-0">Delete</button>
        </form>
    @endif
</div>