@extends('admin.layouts.master')
@section('title')
    Create Brand Page
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
                <h4 class="box-title">Create Brand</h4>
                <div class="col-12 col-lg-12">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.brands.store') }}" novalidate
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @foreach(config('app.languages') as $language)
                                                <h5>Name In {{$language['name']}}<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name[{{$language['locale']}}]" class="form-control"
                                                        value="{{ old('name')[$language['locale']] ?? ''}}">
                                                    @error('name.*'.$language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endforeach
                                                <div class="form-control-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                @foreach(config('app.languages') as $language)

                                                <h5>Slug In {{$language['name']}}<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="slug[{{$language['locale']}}]" class="form-control"
                                                        value="{{ old('slug')[$language['locale']] ?? '' }}">
                                                    @error('slug.*'.$language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <h5>File<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input  type="file" name="image"
                                                        class="form-control">
                                                    @error('image')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-xs-right">
                                                <button type="submit" class="btn btn-app btn-danger"><i class="fa fa-save"></i>Save</button></i>
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

