@extends('admin.layouts.master')
@section('title')
    Products
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">All Brands</h3>
            <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-5 float-right">Create A Product</a>
        </div>
        @if (Session::has('message'))
            <span class="alert alert-success">{{ Session::get('message') }}</span>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
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
                            <th>Short Description</th>
                            <th>Quantity</th>
                            <th>Product Status</th>
                            <th>Selling Price</th>
                            <th>Discount Percentage</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Category Name</th>
                            <th>Brand Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name->{app()->getLocale()} }}</td>
                                <td>{{ $product->slug->{app()->getLocale()} }}</td>
                                <td>
                                    @foreach ($product->images as $image)
                                        <img class="rounded-circle" style="width:35%; height:35%;"
                                            src="{{ !empty($image->name) ? asset('storage/products/images/' . $image->name) : asset('backend/images/no_image.jpg') }}">
                                    @endforeach
                                </td>
                                <td>{{ $product->short_description->{app()->getLocale()} }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>
                                    @if ($product->status == App\Http\Enums\ProductStatusEnum::ACTIVE)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif

                                </td>
                                <td>{{ $product->selling_price }}</td>
                                <td>
                                    @if (!$product->discount_price)
                                        <span class="badge badge-pill badge-danger">No Discount</span>
                                    @else
                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = round(($amount / $product->selling_price) * 100);
                                        @endphp
                                        <span class="badge badge-danger">{{ $discount }}%</span>
                                    @endif

                                </td>

                                <td>
                                    @foreach ($product->sizes as $size)
                                        <li>{{ $size->name->{app()->getLocale()} }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->colors as $color)
                                        <li>{{ $color->name->{app()->getLocale()} }}</li>
                                    @endforeach
                                </td>
                                <td>{{ $product->category->name->{app()->getLocale()} }}</td>
                                <td>{{ $product->brand->name->{app()->getLocale()} }}</td>
                                <td><a href="{{ route('admin.products.edit', [$product->id]) }}"
                                        class="btn btn-warning btn-flat mb-5" title="Edit"><i
                                            class="fa fa-pencil"></i></a>
                                    <a id="delete" href="{{ route('admin.products.destroy', [$product->id]) }}"
                                        class="btn btn-danger btn-flat mb-5" title="Delete"><i class="fa fa-trash"></i></a>

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
    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/js/pages/data-table.js') }}"></script>
@endsection
