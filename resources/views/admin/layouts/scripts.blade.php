<!-- Vendor JS -->
<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
<script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
<script src="{{ asset('backend/js/pages/validation.js')}}"></script>
<script src="{{ asset('backend/js/pages/form-validation.js')}}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
<script src="{{ asset('backend/js/pages/advanced-form-element.js')}}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{ asset('assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('backend/js/pages/editor.js')}}"></script>

<!-- Sunny Admin App -->
<script src="{{ asset('backend/js/template.js') }}"></script>
<script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


@yield('js')


<script>
    $(document).ready(function() {
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });

    });
});
</script>
<script>
    $(document).ready(function() {
        var $categorySelect = $('#category-select');
        var $subcategorySelect = $('#subcategory-select');
        var locale = $('body').data('locale');

        $categorySelect.on('change', function() {
            var categoryId = $categorySelect.val();

            if (categoryId) {
                $.get("{{ url('admin/categories/subcategory/ajax') }}/" + categoryId, function(data) {
                    $subcategorySelect.empty().append(
                        '<option selected disabled>Choose Your Sub Category</option>');
                    data = JSON.parse(data);
                    $.each(data, function(key, value) {
                        if (value.id && value.name && value.name[locale]) {
                            $subcategorySelect.append('<option value="' + value.id +
                                '">' + value.name[locale] + '</option>');
                        }
                    });
                    $subcategorySelect.show();
                });
            } else {
                $subcategorySelect.hide();
            }
        });

        $subcategorySelect.on('change', function(event) {
            event.preventDefault();
            var subcategoryId = $subcategorySelect.val();
            console.log(subcategoryId);
            return false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        var $subcategorySelect = $('#subcategory-select');
        var $subSubcategorySelect = $('#sub-subcategory-select');

        var locale = $('body').data('locale');

        $subcategorySelect.on('change', function() {
            var categoryId = $subcategorySelect.val();

            if (categoryId) {
                $.get("{{ url('admin/categories/subcategory/ajax') }}/" + categoryId, function(data) {
                    $subSubcategorySelect.empty().append(
                        '<option selected disabled>Choose Your Sub SubCategory</option>');
                    data = JSON.parse(data);
                    $.each(data, function(key, value) {
                        if (value.id && value.name && value.name[locale]) {
                            $subSubcategorySelect.append('<option value="' + value.id +
                                '">' + value.name[locale] + '</option>');
                        }
                    });
                    $subSubcategorySelect.show();
                });
            } else {
                $subSubcategorySelect.hide();
            }
        });

        $subSubcategorySelect.on('change', function(event) {
            event.preventDefault();
            var subcategoryId = $subSubcategorySelect.val();
            console.log(subcategoryId);
            return false;
        });
    });
</script>

</body>

</html>
