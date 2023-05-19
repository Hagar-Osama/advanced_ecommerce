@extends('admin.layouts.master')
@section('title')
    {{ $profile->name }} - Edit Profile Page
@endsection
@section('content')
    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Admin Profile</h4>
                <div class="col-12 col-lg-12">
                    <div class="box-body">
                        <button type="button" style="float:right" class="btn btn-rounded btn-warning" data-toggle="modal"
                            data-target="#modal-center">
                            Change Password
                        </button>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.profile.update', $profile->id) }}" novalidate
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Name<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ old('name', $profile->name) }}">
                                                    @error('name')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-control-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Email<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ old('email', $profile->email) }}">
                                                    @error('email')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>File<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input id="image" type="file" name="profile_photo_path"
                                                        class="form-control">
                                                    @error('profile_photo_path')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div><br>
                                                <img id="showImage" class="rounded-circle"
                                                    src="{{ !empty($profile->profile_photo_path) ? asset('storage/admin/profile/' . $profile->profile_photo_path) : asset('backend/images/no_image.jpg') }}"
                                                    alt="User Avatar">
                                            </div>
                                            <div class="text-xs-right">
                                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                                            </div>
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.Update Passowrd Modal -->
                <!-- Modal -->
                <div class="modal center-modal fade" id="modal-center" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.profile.updatePassword') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <h5>Current Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="current_password" class="form-control">
                                            @error('current_password')
                                                <span class="alert text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>New Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control">
                                            @error('password')
                                                <span class="alert text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Confirm Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <span class="alert text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer modal-footer-uniform">
                                        <button type="button" class="btn btn-rounded btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-rounded btn-primary float-right">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->


    </section>
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
    @if (count($errors) > 0)
        <script>
            $(document).ready(function() {
                $('#modal-center').modal({
                    show: true
                });
            });
        </script>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
