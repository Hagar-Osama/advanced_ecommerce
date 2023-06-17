@extends('admin.layouts.master')
@section('title')
    Colors
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">All Colors</h3>
            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
            <button type="button" style="float:right" class="btn btn-rounded btn-info"
            data-toggle="modal" data-target="#addColor">
            Add Color
        </button>
        </div>
        @if (Session::has('message'))
            <span class="alert alert-success">{{ Session::get('message') }}</span>
        @endif
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $color->name->{app()->getLocale()} }}</td>
                                <td>{{ $color->code }}</td>
                                <td> <button type="button" class="btn btn-warning btn-flat mb-5"title="Edit"
                                        data-toggle="modal" data-target="#editColor{{$color->id}}"><i class="fa fa-pencil"></i>
                                    </button>
                                    <a id="delete" href="{{ route('admin.colors.destroy', [$color->id]) }}"
                                        class="btn btn-danger btn-flat mb-5" title="Delete"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @include('admin.colors.edit')
                        @endforeach

                </table>
            </div>
        </div>
        <!-- /.box-body -->
        @include('admin.colors.create')

    </div>
    <!-- /.box -->
@endsection
@section('js')
    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/pages/data-table.js') }}"></script> --}}
@endsection
