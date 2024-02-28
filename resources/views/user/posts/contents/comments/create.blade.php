<div class="mt-3">
    <form action="{{ route('comment.store', $post->id)}}" method="post">
        @csrf 
        <div class="input-group">
            <textarea name="comment_body{{ $post->id }}"  rows="1" class="form-control form-control-sm" placeholder="Write a comment...">{{ old('comment_body'.$post->id) }}</textarea>
            <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
        </div>
        @error('comment_body'.$post->id)
            <span class="d-block text-danger small">{{ $message }}</span>
        @enderror
    </form>
</div>