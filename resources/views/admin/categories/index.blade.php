@extends('admin.layouts.master')
@section('title')
Categories
@endsection
@section('content')
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">All Categories</h3>
      <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
      <a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-5 float-right">Create A Category</a>
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
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Icon</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$category->name->{app()->getLocale()} }}</td>
                    <td>{{$category->slug->{app()->getLocale()} }}</td>
                    <td>@if($category->icon)
                        <i class="{{$category->icon }}"></i>
                        @else
                        <span class="text-danger">No Icon Found</span>
                        @endif
                    </td>
                    <td>@if($category->category_id)
                        {{$category->parent->name->{app()->getLocale()} }}</td>
                        @else
                        <span class="text-danger">No Category Found</span>
                        @endif
                    <td><a href="{{route('admin.categories.edit', [$category->id])}}" class="btn btn-warning btn-flat mb-5" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a id="delete" href="{{route('admin.categories.destroy', [$category->id])}}" class="btn btn-danger btn-flat mb-5" title="Delete"><i class="fa fa-trash"></i></a>

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
