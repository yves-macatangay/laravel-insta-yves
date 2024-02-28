@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="{{ route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')

        <p class="fw-bold mb-2">Category <span class="fw-light">(up to 3)</span></p>
        <div>
            @forelse($all_categories as $category)
            <div class="form-check form-check-inline">
                {{-- if category id is in the array of selected categories --}}
                @if(in_array($category->id, $selected_categories))
                    <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                @else
                    <input type="checkbox" name="categories[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input">
                @endif
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
            @empty 
                <span class="font-italic text-secondary">No categories found. Contact admin to add categories.</span>
            @endforelse
        </div>
        @error('categories')
            <span class="d-block text-danger small">{{ $message }}</span>
        @enderror

        <label for="description" class="form-label fw-bold mt-3">Description</label>
        <textarea name="description" id="description" cols="30" rows="3" class="form-control" placeholder="What's on your mind">{{ old('description', $post->description) }}</textarea>
        @error('description')
            <span class="d-block text-danger small">{{ $message }}</span>
        @enderror

        <div class="w-50">
            <label for="image" class="form-label fw-bold mt-3">Image</label>
            <img src="{{ $post->image }}" alt="" class="img-thumbnail mb-1 w-100">
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <p class="form-text" id="image-info">
                Acceptable formats: jpeg, jpg, png, gif only <br>
                Max size is 1048 KB
            </p>
            @error('image')
                <span class="d-block text-danger small">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-warning mt-4 px-4">Save</button>
    </form>

@endsection