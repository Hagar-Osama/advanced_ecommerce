@extends('admin.layouts.master')
@section('title')
Brands
@endsection
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">All Brands</h3>
      <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
      <a href="{{route('admin.brands.create')}}" class="btn btn-primary mb-5 float-right">Create A Brand</a>
    </div>
    @if(Session::has('message'))
    <span class="alert alert-success">{{Session::get('message')}}</span>
    @endif
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$brand->name->{app()->getLocale()} }}</td>
                    <td>{{$brand->slug->{app()->getLocale()} }}</td>
                    <td>
                        <img class="rounded-circle" style="width:20%; height:20%" src="{{!empty($brand->image) ? asset('storage/brands/'. $brand->image) : asset('backend/images/no_image.jpg')}}">
                    </td>
                    <td><a href="{{route('admin.brands.edit', [$brand->id])}}" class="btn btn-warning btn-flat mb-5" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a id="delete" href="{{route('admin.brands.destroy', [$brand->id])}}" class="btn btn-danger btn-flat mb-5" title="Delete"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
                @endforeach

        </table>
        </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
@section('js')
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('backend/js/pages/data-table.js')}}"></script>
@endsection
