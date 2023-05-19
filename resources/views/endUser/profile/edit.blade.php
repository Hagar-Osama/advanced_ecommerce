@extends('endUser.layouts.master')
@section('title')
    {{ auth()->guard('web')->user()->name }} - Profile
@endsection
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Update Profile</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        @if (session('status'))
                            <div style="color:rgb(6, 186, 6)">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('user.profile.update', $profile->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Name <span></span></label>
                                <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                                    class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                                @error('name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span></span></label>
                                <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                                    class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @error('email')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Profile Picture <span></span></label>
                                <input id="image" type="file" name="profile_photo_path"
                                    class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                                @error('profile_photo_path')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                                <img id="showImage" class="rounded-circle"
                                    src="{{ !empty($profile->profile_photo_path) ? asset('storage/user/profile/' . $profile->profile_photo_path) : asset('backend/images/no_image.jpg') }}"
                                    alt="User Avatar">
                            </div>

                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                        </form>
                    </div>
                    <!-- Sign-in -->
                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Update Your Password</h4>
                        <p class="text title-tag-line">Update Your Password.</p>
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('user.profile.updatePassword') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                                <input type="password" name="current_password""
                                    class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @error('current_password')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1">
                                @error('password')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input type="password" name="password_confirmation"
                                    class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @error('password_confirmation')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-warning checkout-page-button">Update Password</button>
                        </form>


                    </div>
                    <!-- create a new account -->

                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>
@endsection
