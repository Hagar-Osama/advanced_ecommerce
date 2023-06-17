@extends('admin.layouts.master')
@section('title')
    Edit Product Page
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
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>
                <div class="col-12 col-lg-12">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.products.update', $product->id) }}" novalidate
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Name In {{ $language['name'] }}<span class="text-danger"></span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="name[{{ $language['locale'] }}]"
                                                            class="form-control"
                                                            value="{{ old('name.' . $language['locale'], $product->name->{$language['locale']}) }}">
                                                        @error('name.*' . $language['locale'])
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                                <div class="form-control-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Slug In {{ $language['name'] }}<span class="text-danger"></span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="slug[{{ $language['locale'] }}]"
                                                            class="form-control"
                                                            value="{{ old('slug.' . $language['locale'], $product->slug->{$language['locale']}) }}">
                                                        @error('slug.*' . $language['locale'])
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Long Description In {{ $language['name'] }} <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="long_description[{{ $language['locale'] }}]" id="textarea" class="form-control" required
                                                            placeholder="Textarea text">{{ old('long_description.' . $language['locale'], $product->long_description->{$language['locale']}) }}</textarea>
                                                    </div>
                                                    @error('long_description.*' . $language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                @endforeach
                                            </div>
                                            {{-- <div class="form-group">
                                                <h5>File<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    @foreach ($product->images as $image)
                                                    <input id="image" type="file" name="images[{{$image->id}}]" accept="images/*" multiple
                                                    @endforeach
                                                        id="multiImg" class="form-control">
                                                    @error('images')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                    <br>
                                                    <div class="row" id="preview_img"></div>
                                                    @foreach ($product->images as $image)
                                                    <img id="showImage" style="width: 10%; height: 10%;"
                                                    src="{{ !empty($image->name) ? asset('storage/products/images/' . $image->name) : asset('backend/images/no_image.jpg') }}"
                                                    alt="User Avatar">
                                                    @endforeach
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <h5>Thumbnail<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input id="image" type="file" name="thumbnail"
                                                        class="form-control" onChange="mainThamUrl(this)">
                                                    @error('thumbnail')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                    <img id="showImage" style="width: 10%; height: 10%;"
                                                        src="{{ !empty($product->thumbnail) ? asset('storage/products/thumbnails/' . $product->thumbnail) : asset('backend/images/no_image.jpg') }}"
                                                        alt="User Avatar">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Product Quantity (No Characters, Only Numbers) <span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="qty"
                                                        value="{{ old('qty', $product->qty) }}" class="form-control"
                                                        required data-validation-containsnumber-regex="(\d)+"
                                                        data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
                                                    @error('qty')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Selling Price (Only Numbers) <span class="text-danger">*</span></h5>
                                                <div class="input-group"> <span class="input-group-addon">$</span>
                                                    <input type="number" name="selling_price"
                                                        value="{{ old('selling_price', $product->selling_price) }}"
                                                        class="form-control" required
                                                        data-validation-required-message="This field is required"> <span
                                                        class="input-group-addon">.00</span>
                                                    @error('selling_price')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Discount Price (Only Numbers) <span class="text-danger">*</span></h5>
                                                <div class="input-group"> <span class="input-group-addon">$</span>
                                                    <input type="number" name="discount_price"
                                                        value="{{ old('discount_price', $product->discount_price) }}"
                                                        class="form-control" required
                                                        data-validation-required-message="This field is required"> <span
                                                        class="input-group-addon">.00</span>
                                                    @error('discount_price')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Code In {{ $language['name'] }}<span class="text-danger"></span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="code[{{ $language['locale'] }}]"
                                                            class="form-control"
                                                            value="{{ old('code.' . $language['locale'], $product->code->{$language['locale']}) }}">
                                                        @error('code.*' . $language['locale'])
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Short Description In {{ $language['name'] }} <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_description[{{ $language['locale'] }}]" id="textarea" class="form-control" required
                                                            placeholder="Textarea text">{{ old('short_description.' . $language['locale'], $product->short_description->{$language['locale']}) }}</textarea>
                                                    </div>
                                                    @error('short_description.*' . $language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                @endforeach
                                            </div>
                                            <div class="form-group">

                                                <h5>Product Tags<span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    @foreach ($product->tags as $index => $tag)
                                                        <input type="text" name="tags[]"
                                                            value="{{ old('tags.' . $index, $tag) }}" @endforeach
                                                        data-role="tagsinput" placeholder="add tags"> <span
                                                            class="input-group-addon">Tags</span>
                                                        @error('tags')
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category" id="category-select" required
                                                        class="form-control">
                                                        <option value="">Select Your Category</option>
                                                        @foreach ($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}"{{ $category->id == $category->category_id ? 'selected' : '' }}>
                                                                {{ $category->name->{app()->getLocale()} }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group  ">
                                                <h5>Sub Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category" id="subcategory-select" required
                                                        class="form-control">

                                                    </select>
                                                    @error('category')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Sub Sub Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category" id="sub-subcategory-select" required
                                                        class="form-control">

                                                    </select>
                                                    @error('category')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Brands <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="brand" required class="form-control">
                                                        <option value="">Select Your Brand</option>
                                                        @foreach ($brands as $brand)
                                                            <option
                                                                value="{{ $brand->id }}"{{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                                {{ $brand->name->{app()->getLocale()} }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="my-10">Colors</h5>
                                                <select name="colors[]" class="selectpicker" multiple>
                                                    @foreach ($colors as $color)
                                                        <option
                                                            value="{{ $color->id }}"{{ $product->colors->contains($color->id) ? 'selected' : '' }}>
                                                            {{ $color->name->{app()->getLocale()} }}</option>
                                                    @endforeach
                                                </select>
                                                @error('colors')
                                                    <span class="alert text-danger"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <h5 class="my-10">Sizes</h5>
                                                <select name="sizes[]" class="selectpicker" multiple>
                                                    @foreach ($sizes as $size)
                                                        <option
                                                            value="{{ $size->id }}"{{ $product->sizes->contains($size->id) ? 'selected' : '' }}>
                                                            {{ $size->name->{app()->getLocale()} }}</option>
                                                    @endforeach
                                                </select>
                                                @error('sizes')
                                                    <span class="alert text-danger"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="box-body">

                                                <div class="demo-checkbox">
                                                    <input type="checkbox" name="special_deals" value="active"
                                                        {{ $product->special_deals == 'active' ? 'checked' : '' }}
                                                        id="md_checkbox_3" class="filled-in chk-col-success" />
                                                    <label for="md_checkbox_3">Special Deals</label>

                                                    @php
                                                        use App\Http\Enums\ProductStatusEnum;
                                                    @endphp
                                                    <input type="checkbox" name="status"
                                                        value="{{ ProductStatusEnum::ACTIVE }}"
                                                        {{ old('status', $product->status) === App\Http\Enums\ProductStatusEnum::ACTIVE ? 'checked' : '' }}
                                                        id="md_checkbox_4" class="filled-in chk-col-info" />
                                                    <label for="md_checkbox_4">Staus</label>


                                                    <input type="checkbox" name="special_offers" value="active"
                                                        {{ $product->special_ofers == 'active' ? 'checked' : '' }}
                                                        id="md_checkbox_6" class="filled-in chk-col-warning" />
                                                    <label for="md_checkbox_6">Special Offers</label>



                                                    <input type="checkbox" name="hot_deals" value="active"
                                                        {{ $product->hot_deals == 'active' ? 'checked' : '' }}
                                                        id="md_checkbox_7" class="filled-in chk-col-danger" />
                                                    <label for="md_checkbox_7">Hot Deals</label>
                                                </div>

                                            </div><br>

                                            <div class="text-xs-right mt-5">
                                                <button type="submit" class="btn btn-app btn-danger"><i
                                                        class="fa fa-save"></i>Save</button></i>
                                                        <button type="button" class="btn btn-info btn-app mb-5"
                                                        data-toggle="modal" data-target="#editImage">Edit Image
                                                    </button>
                                            </div>

                                </form>
                                @include('admin.products.editImages')

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

    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(80)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
