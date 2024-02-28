@extends('layouts.app')

@section('title', 'Following')

@section('content')
    @include('user.profile.header')

    @if($user->follows->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col-4">
                <h3 class="h4 text-muted mb-2">Following</h3>

                @foreach($user->follows as $follow)
                    <div class="row mb-2 align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $follow->followed->id) }}">
                                @if($follow->followed->avatar)
                                    <img src="{{ $follow->followed->avatar }}" alt="" class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif 
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="{{ route('profile.show', $follow->followed->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $follow->followed->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            @if($follow->followed->id != Auth::user()->id)
                                @if($follow->followed->isFollowed())
                                    {{-- unfollow --}}
                                    <form action="{{ route('follow.destroy', $follow->followed->id)}}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 shadow-none text-secondary">Following</button>
                                    </form>
                                @else
                                    {{-- follow --}}
                                    <form action="{{ route('follow.store', $follow->followed->id)}}" method="post">
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
        <p class="text-muted text-center h5">Not following anyone yet.</p>
    @endif
@endsection