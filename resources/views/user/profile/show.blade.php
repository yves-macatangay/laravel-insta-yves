@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    @include('user.profile.header')

    <div class="mt-5">
        <div class="row">
            @forelse($user->posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('post.show', $post->id)}}">
                        <img src="{{ $post->image }}" alt="" class="grid-img">
                    </a>
                </div>
            @empty 
                <p class="text-muted text-center h5">No posts yet.</p>
            @endforelse
        </div>
    </div>

@endsection