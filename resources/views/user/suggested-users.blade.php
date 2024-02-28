@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
    <div class="row justify-content-center">
        <div class="col-4">
            <form action="{{ route('suggested-users')}}" method="get" class="mb-3">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search names..." class="form-control form-control-sm" style="width:15rem">
            </form>

            <h3 class="h5 mb-3">Suggested</h3>

            @forelse($suggested_users as $user)
                <div class="row mb-3 align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id)}}">
                            @if($user->avatar)
                                <img src="{{ $user->avatar}}" alt="" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $user->name }}</a>
                        <span class="text-muted d-block">{{ $user->email }}</span>
                        <span class="text-muted d-block small">
                            @if($user->followsYou())
                            Follows you
                            @else
                                @if($user->followers->count() == 0)
                                    No followers yet
                                @else 
                                    {{ $user->followers->count() }} {{ $user->followers->count()==1 ? 'follower' : 'followers'}}
                                @endif
                            @endif
                        </span>
                    </div>
                    <div class="col-auto">
                        <form action="{{ route('follow.store', $user->id)}}" method="post">
                            @csrf 
                            <button type="submit" class="btn p-0 shadow-none text-primary">Follow</button>
                        </form>
                    </div>
                </div>
            @empty 
            <p class="text-center text-muted">No suggested users.</p>
            @endforelse
        </div>
    </div>

@endsection