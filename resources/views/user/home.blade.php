@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row gx-5">
        <div class="col-8">
            @if($search)
                <h3 class="h5 text-muted mb-3">Search results for '<strong>{{ $search }}</strong>'</h3>
            @endif
            @forelse($all_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('user.posts.contents.title')
                    {{-- body --}}
                    <div class="container p-0">
                        <a href="{{ route('post.show', $post->id)}}">
                            <img src="{{ $post->image }}" alt="" class="w-100">
                        </a>
                    </div>
                    <div class="card-body">
                        @include('user.posts.contents.body')
                        {{-- COMMENTS --}}
                        @if($post->comments->isNotEmpty())
                            <hr class="mt-3">

                            {{-- list of comments --}}
                            @foreach($post->comments->take(3) as $comment)
                                @include('user.posts.contents.comments.list-item')
                            @endforeach
                            @if($post->comments->count() > 3)
                                <a href="{{ route('post.show', $post->id)}}" class="text-decoration-none small mb-3">
                                    View all {{ $post->comments->count() }} comments
                                </a>
                            @endif
                        @endif
                        @include('user.posts.contents.comments.create')
                    </div>
                </div>
            @empty 
                <h2>Share Photos</h2>
                <p class="text-muted">When you share photos, they appear on your profile.</p>
                <a href="{{ route('post.create')}}" class="text-decoration-none">Share your first photo</a>
            @endforelse
        </div>
        <div class="col-4">
            {{-- USER INFO / SUGGESTIONS --}}
            <div class="row mb-5 bg-white align-items-center py-3 shadow-sm rounded-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id)}}">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user icon-md text-secondary"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id)}}" class="text-decoration-none fw-bold text-dark">{{ Auth::user()->name }}</a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>

            {{-- SUGGESTED USERS --}}
            @if(count($suggested_users) > 0)
            <div class="row mb-2">
                <div class="col">
                    <p class="text-muted fw-bold">Suggestions For You</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('suggested-users')}}" class="text-decoration-none fw-bold text-dark">See all</a>
                </div>
            </div>
            @foreach($suggested_users as $user)
                <div class="row mb-2 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id)}}">
                            @if($user->avatar)
                                <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $user->name }}</a>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id)}}" method="post">
                            @csrf 
                            <button type="submit" class="btn shadow-none p-0 text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>

@endsection