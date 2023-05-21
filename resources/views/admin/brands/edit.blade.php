@extends('admin.layouts.master')
@section('title')
    Edit Brand Page
@endsection
@section('content')
    <section class="content">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Brand</h4>
                <div class="col-12 col-lg-12">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.brands.update', $brand->id) }}" novalidate
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @foreach(config('app.languages') as $language)
                                                <h5>Name In {{$language['name']}}<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name[{{$language['locale']}}]" class="form-control"
                                                        value="{{ old('name.'.$language["locale"], $brand->name->{$language['locale']} )  }}">
                                                    @error('name.*'.$language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endforeach
                                                <div class="form-control-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                @foreach(config('app.languages') as $language)
                                                <h5>Slug In  {{$language['name']}}<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="slug[{{$language['locale']}}]" class="form-control"
                                                        value="{{ old('slug.'.$language["locale"], $brand->slug->{$language['locale']} ) }}">
                                                    @error('slug.*'.$language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <h5>File<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input id="image" type="file" name="image"
                                                        class="form-control">
                                                    @error('image')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div><br>
                                                <img id="showImage" class="rounded-circle"
                                                    src="{{ !empty($brand->image) ? asset('storage/brands/' . $brand->image) : asset('backend/images/no_image.jpg') }}"
                                                    alt="User Avatar">
                                            </div>
                                            <div class="text-xs-right">
                                                <button type="submit" class="btn btn-info mb-5">Update</button>
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
