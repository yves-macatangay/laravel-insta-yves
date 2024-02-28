@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.update')}}" method="post" class="rounded-3 shadow bg-white p-5" enctype="multipart/form-data">
                @csrf 
                @method('PATCH')

                <h2 class="h3 text-muted fw-light mb-3">Update Profile</h2>

                <div class="row mb-3">
                    <div class="col-4">
                        {{-- icon/avatar --}}
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle image-lg d-block mx-auto">
                        @else
                        <i class="fa-solid fa-circle-user text-secondary icon-lg d-block text-center"></i>
                        @endif
                    </div>
                    <div class="col-5 align-self-end">
                        <input type="file" name="avatar" class="form-control" aria-describedby="avatar-info">
                        <p class="mb-0 form-text" id="avatar-info">
                            Acceptable formats: jpeg, jpg, png, gif <br>
                            Max file size is 1048 KB
                        </p>
                        @error('avatar')
                            <span class="text-danger small d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
                @error('name')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror

                <label for="email" class="form-label fw-bold mt-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
                @error('email')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror

                <label for="introduction" class="form-label fw-bold mt-2">Introduction</label>
                <textarea name="introduction" id="introduction" rows="3" class="form-control">{{ old('introduction',Auth::user()->introduction) }}</textarea>
                @error('introduction')
                    <span class="text-danger small d-block">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn btn-warning mt-4 px-5">Save</button>
            </form>

            <form action="{{ route('profile.updatePassword')}}" method="post" class="rounded-3 shadow bg-white p-5 mt-5">
                @csrf 
                @method('PATCH')

                @if(session('update_success'))
                <p class="text-success fw-bold">{{ session('update_success') }}</p>
                @endif

                <h2 class="h3 text-muted fw-light mb-3">Update Password</h2>

                <label for="old-password" class="form-label fw-bold">Old Password</label>
                <input type="password" name="old_password" id="old-password" class="form-control">
                @if(session('incorrect_old_password'))
                <span class="d-block small text-danger">{{ session('incorrect_old_password') }}</span>
                @endif

                <label for="new-password" class="form-label fw-bold mt-3">New Password</label>
                <input type="password" name="new_password" id="new-password" class="form-control">
                @if(session('same_password_error'))
                <span class="d-block small text-danger">{{ session('same_password_error') }}</span>
                @endif
                @error('new_password')
                <span class="d-block small text-danger">{{ $message }}</span>
                @enderror

                <label for="new-password-confirm" class="form-label mt-3">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new-password-confirm" class="form-control">

                <input type="submit" value="Update Password" class="btn btn-warning mt-4 px-5">
            </form>
        </div>
    </div>
@endsection