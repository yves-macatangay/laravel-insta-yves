<div class="modal fade" id="comments">
    <div class="modal-dialog">
        <div class="modal-content text-muted">
            <div class="modal-header">
                <h5 class="h5 modal-title">Recent Comments</h5>
            </div>
            <div class="modal-body">
                @forelse($user->comments->take(5) as $comment)
                    <div class="border border-primary rounded-2 py-2 px-3 mb-2">
                        <p>{{ $comment->body }}</p>
                        <hr class="mb-2">
                        <span class="small">Replied to <a href="{{ route('post.show', $comment->post->id)}}" class="text-decoration-none">{{ $comment->post->user->name }}'s post</a></span>
                    </div>
                @empty 
                    <p class="text-center">No comments yet.</p>
                @endforelse
            </div>
            <div class="modal-footer border-0">
                <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">Close</button>
            </div>
        </div>
    </div>
</div>