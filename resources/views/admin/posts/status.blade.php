@if(!$post->trashed())
<div class="modal fade" id="hide-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="h4 text-danger modal-title"><i class="fa-solid fa-eye-slash"></i> Hide Post</h4>
            </div>
            <div class="modal-body text-dark">
                <p>Are you sure you want to hide this post?</p>
                <img src="{{ $post->image }}" alt="" class="image-lg d-block mb-2">
                <span class="text-muted">{{ $post->description }}</span>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hide', $post->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="modal fade" id="unhide-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h4 class="h4 modal-title text-primary"><i class="fa-solid fa-eye"></i> Unhide Post</h4>
            </div>
            <div class="modal-body text-dark">
                <p>Are you sure you want to unhide this post?</p>
                <img src="{{ $post->image }}" alt="" class="image-lg d-block mb-2">
                <span class="text-muted">{{ $post->description }}</span>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>  

@endif