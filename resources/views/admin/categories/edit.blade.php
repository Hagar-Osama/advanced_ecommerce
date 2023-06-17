@extends('admin.layouts.master')
@section('title')
    Edit Category Page
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
                <h4 class="box-title">Edit Category</h4>
                <div class="col-12 col-lg-12">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.categories.update', $category->id) }}" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @foreach(config('app.languages') as $language)
                                                <h5>Name In {{$language['name']}}<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name[{{$language['locale']}}]" class="form-control"
                                                        value="{{ old('name.'.$language["locale"], $category->name->{$language['locale']} )  }}">
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
                                                        value="{{ old('slug.'.$language["locale"], $category->slug->{$language['locale']} ) }}">
                                                    @error('slug.*'.$language['locale'])
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <h5>Icon<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="icon" value="{{$category->icon}}"
                                                        class="form-control">
                                                    @error('icon')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="category-select" required class="form-control">
                                                        <option value="">Select Your Category</option>
                                                        @foreach ($categories as $cat)
                                                            <option
                                                                value="{{ $cat->id }}"{{$cat->id == $category->category_id ? 'selected' : ''}}>
                                                                {{ $cat->name->{app()->getLocale()} }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <h5>Sub Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="subcategory-select" required class="form-control">
                                                        <option value="">Select Your Sub Category</option>
                                                        @foreach ($subCategories as $subCategory)
                                                            <option
                                                                value="{{ $subCategory->id }}"{{$subCategory->id == $category->category_id ? 'selected' : ''}}>
                                                                {{ $subCategory->name->{app()->getLocale()} }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
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
    {{-- <script>
     $(document).ready(function() {
    $('#category-select').on('change', function(){
        var locale = $('body').data('locale');
        var category_id = $(this).val();
        var $subcategory_select = $('#subcategory-select');

        if(category_id) {
            $.ajax({
                url: "{{ url('admin/categories/subcategory/ajax') }}/" + category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    $subcategory_select.empty();
                    $subcategory_select.append('<option selected disabled>Choose Your Sub Category</option>');
                    $.each(data, function(key, value){
                        $subcategory_select.append('<option value="'+ value.id +'">' + value.name[locale] + '</option>');
                    });
                    $subcategory_select.show();
                },
            });
        } else {
            $subcategory_select.hide();
        }
    });

    $('#subcategory-select').on('change', function(event){
        event.preventDefault();
        var subcategory_id = $(this).val();
        console.log(subcategory_id);
        return false;
    });
});
    </script> --}}
@endsection

