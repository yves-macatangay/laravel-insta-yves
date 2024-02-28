@extends('layouts.app')

@section('title', 'Admin: Users')

@section('content')
    <form action="{{ route('admin.users')}}" method="get" class="mb-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="search names" class="form-control form-control-sm ms-auto" style="width:10rem">
    </form>

    <table class="table table-hover align-middle text-secondary bg-white border">
        <thead class="table-primary text-uppercase small text-secondary">
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Status</th>
            <th></th>
        </thead>
        <tbody>
            @forelse($all_users as $user)
                <tr>
                    <td>
                        {{-- avatar/icon --}}
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-md d-block mx-auto">
                        @else 
                            <i class="fa-solid fa-circle-user icon-md text-secondary d-block text-center"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        {{-- status --}}
                        @if($user->trashed())
                            <i class="fa-regular fa-circle"></i> Inactive
                        @else
                            <i class="fa-solid fa-circle text-success"></i> Active
                        @endif
                    </td>
                    <td>
                        {{-- menu --}}
                        @if($user->id != Auth::user()->id)
                        <div class="dropdown">
                            <button class="btn shadow-none btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            @if(!$user->trashed())
                            {{-- deactivate --}}
                            <div class="dropdown-menu">
                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user{{ $user->id }}">
                                    <i class="fa-solid fa-user-slash"></i> Deactivate {{ $user->name }}
                                </button>
                            </div>
                            @else
                            <div class="dropdown-menu">
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#activate-user{{ $user->id }}">
                                    <i class="fa-solid fa-user-check"></i> Activate {{ $user->name }}
                                </button>
                            </div>
                            @endif
                            @include('admin.users.status')
                        </div>
                        
                        @endif
                    </td>
                </tr>
            @empty 
                <tr>
                    <td class="text-center" colspan="6">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $all_users->links() }}
@endsection