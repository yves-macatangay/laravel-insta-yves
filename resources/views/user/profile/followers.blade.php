@extends('layouts.app')

@section('title', 'Followers')

@section('content')
    @include('user.profile.header')

    @if($user->followers->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="h4 text-muted mb-2">Followers</h3>

                @foreach($user->followers as $follower)
                    <div class="row mb-2 align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $follower->follower->id) }}">
                                @if($follower->follower->avatar)
                                    <img src="{{ $follower->follower->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif 
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show', $follower->follower->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $follower->follower->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            @if($follower->follower->id != Auth::user()->id)
                                @if($follower->follower->isFollowed())
                                    {{-- unfollow --}}
                                    <form action="{{ route('follow.destroy', $follower->follower->id)}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 shadow-none text-secondary">Following</button>
                                    </form>
                                @else
                                    {{-- follow --}}
                                    <form action="{{ route('follow.store', $follower->follower->id)}}" method="post">
                                        @csrf 
                                        <button type="submit" class="btn p-0 shadow-none text-primary">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else 
        <p class="text-muted text-center h5">No followers yet.</p>
    @endif
@endsection