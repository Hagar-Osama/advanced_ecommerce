<script src="{{asset('endUser/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/echo.min.js')}}"></script>
@yield('js')
<script src="{{asset('endUser/assets/js/jquery.easing-1.3.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/jquery.rateit.min.js')}}"></script>
<script type="text/javascript" src="{{asset('endUser/assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/wow.min.js')}}"></script>
<script src="{{asset('endUser/assets/js/scripts.js')}}"></script>
<!-- Toaster js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
       case 'info':
       toastr.info(" {{ Session::get('message') }} ");
       break;

       case 'success':
       toastr.success(" {{ Session::get('message') }} ");
       break;

       case 'warning':
       toastr.warning(" {{ Session::get('message') }} ");
       break;

       case 'error':
       toastr.error(" {{ Session::get('message') }} ");
       break;
    }
    @endif
   </script>

</body>
</html>
