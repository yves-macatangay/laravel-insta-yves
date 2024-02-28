@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

<form action="{{ route('admin.categories.store')}}" method="post" class="row mb-4">
    @csrf 
    <div class="col-3">
        <input type="text" name="name" value="{{ old('name')}}" placeholder="Add a category..." class="form-control">
        @error('name')
        <p class="mb-0 text-danger small">{{ $message }}</p>
        @enderror
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
    </div>
</form>

<table class="table table-sm table-hover align-middle boder bg-white text-secondary text-center">
    <thead class="table-warning text-secondary text-uppercase small">
        <th>#</th>
        <th>Name</th>
        <th>Count</th>
        <th>Last Updated</th>
        <th></th>
    </thead>

    <tbody>
        @forelse($all_categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td class="text-dark">{{ $category->name }}</td>
            <td>{{ $category->categoryPosts->count() }}</td>
            <td>{{ $category->updated_at }}</td>
            <td>    
                <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#edit-category{{ $category->id }}">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category{{ $category->id }}">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
                @include('admin.categories.actions')
            </td>
        </tr>
        @empty 
        <tr>
            <td colspan="5">No categories found.</td>
        </tr>
        @endforelse
        <tr>
            <td>0</td>
            <td>Uncategorized</td>
            <td>{{ $uncategorized_count }}</td>
        </tr>
    </tbody>
</table>
@endsection