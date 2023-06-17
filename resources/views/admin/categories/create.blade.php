@extends('admin.layouts.master')
@section('title')
    Create Category Page
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                <h4 class="box-title">Create Category</h4>
                <div class="col-12 col-lg-12">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="post" action="{{ route('admin.categories.store') }}" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Name In {{ $language['name'] }}<span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="name[{{ $language['locale'] }}]"
                                                            class="form-control"
                                                            value="{{ old('name')[$language['locale']] ?? '' }}">
                                                        @error('name.*' . $language['locale'])
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                                <div class="form-control-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                @foreach (config('app.languages') as $language)
                                                    <h5>Slug In {{ $language['name'] }}<span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="slug[{{ $language['locale'] }}]"
                                                            class="form-control"
                                                            value="{{ old('slug')[$language['locale']] ?? '' }}">
                                                        @error('slug.*' . $language['locale'])
                                                            <span class="alert text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group">
                                                <h5>Icon<span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <input type="text" name="icon" class="form-control">
                                                    @error('icon')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category <span class="text-danger"></span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="category-select"
                                                        class="form-control">
                                                        <option value="">Select Your Category</option>
                                                        @foreach ($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name->{app()->getLocale()} }}
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
                                                    <select name="category_id" id="subcategory-select"
                                                        class="form-control">

                                                    </select>
                                                    @error('category_id')
                                                        <span class="alert text-danger"> {{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-xs-right">
                                                <button type="submit" class="btn btn-app btn-danger"><i
                                                        class="fa fa-save"></i>Save</button></i>
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
{{--

1. `$('#category-select').on('change', function() { ... });`: This line sets up an event listener for the 'change event on the `#category-select` element. When the category selection changes, the function inside the event listener will be executed.

2. `var locale = $('body').data('locale');`: This line retrieves the value of the `data-locale` attribute from the `body` element, which was set in the Blade template. This value represents the current locale.

3. `var category_id = $(this).val();`: This line retrieves the selected category ID from the `#category-select` dropdown.

4. `var $subcategory_select = $('#subcategory-select');`: This line stores a reference to the `#subcategory-select` element in a variable for later use.

5. `if (category_id) { ... }`: This conditional statement checks if a valid category ID is selected. If it is, the code inside the block will be executed.

6. Inside the `if` block, an AJAX request is made using the following code:

   - `url: "{{ url('admin/categories/subcategory/ajax') }}/" + category_id`: This sets the URL for the AJAX request. The URL is generated using the Blade `{{ url() }}` function, and the selected category ID is appended to the URL.

   - `type: "GET"`: This sets the HTTP request method to GET.

   - `dataType: "json"`: This specifies that the expected response data type is JSON.

   - `success: function(data) { ... }`: This is the callback function that will be executed when the AJAX request is successful. The `data` parameter contains the JSON data returned from the server.

7. Inside the `success` callback function:

   - `$subcategory_select.empty();`: This line empties the subcategory dropdown, removing any existing options.

   - `$subcategory_select.append('<option selected disabled>Choose Your Sub Category</option>');`: This line appends a default option to the subcategory dropdown, prompting the user to choose a subcategory.

   - `$.each(data, function(key, value) { ... });`: This line iterates through the returned subcategories (the `data` parameter). For each subcategory, the function inside the loop will be executed.

   - Inside the loop:

     - `$subcategory_select.append('<option value="'+ value.id +'">' + value.name[locale] + '</option>');`: This line appends an option to the subcategory dropdown for each subcategory. The option's value is set to the subcategory ID, and the displayed text is set to the subcategory name in the current locale.

   - `$subcategory_select.show();`: This line makes the subcategory dropdown visible.

8. If no valid category ID is selected, the `else` block is executed:

   - `$subcategory_select.hide();`: This line hides the subcategory dropdown.

9. Finally, there's an event listener for the 'change' event on the `#subcategory-select` element:

   - `$('#subcategory-select').on('change', function(event) { ... });`: This sets up an event listener for the 'change' event on the `#subcategory-select` element. When the subcategory selection changes, the function inside the event listener will be executed.

   - Inside the event listener function:

     - `event.preventDefault();`: This line prevents the default action of the event (e.g., form submission) from occurring.

     - `var subcategory_id = $(this).val();`: This line retrieves the selected subcategory ID from the `#subcategory-select` dropdown.

     - `console.log(subcategory_id);`: This line logs the selected subcategory ID to the browser console.

     - `return false;`: This line stops the event propagation, preventing any parent event handlers from being executed.

I hope this explanation helps you understand the AJAX code better. If you have any questions or need further clarification, please let me know! --}}
