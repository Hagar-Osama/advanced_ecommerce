@extends('endUser.layouts.master')
@section('title')
    {{ ucFirst(auth()->guard('web')->user()->name) }}'s Dashboard
@endsection
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br>
                    <img class="card-image-top" style="border-radius:50%"
                        src="{{ !empty(auth()->guard('web')->user()->profile_photo_path) ? asset('storage/user/profile/' . auth()->guard('web')->user()->profile_photo_path) : asset('backend/images/no_image.jpg') }}"
                        alt="User Avatar" height="100%" width="100%"><br><br>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile.edit', ['locale' => app()->getLocale(), 'userId' => auth()->guard('web')->user()->id]) }}"
                            class="btn btn-primary btn-sm btn-block">Update Profile</a>
                        <a href="{{ route('user.logout', ['locale' => app()->getLocale()]) }}" class="btn btn-danger btn-sm btn-block">Logout</a>

                    </ul>
                </div>
                <div class="col-md-2">

                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Hi...</span><strong>{{ ucFirst(auth()->guard('web')->user()->name) }}
                            </strong>{{trans('homePage.Welcome To Online Shopping')}}</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
