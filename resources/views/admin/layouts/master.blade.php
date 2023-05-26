@include('admin.layouts.styles')

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed" data-locale="{{ app()->getLocale() }}">
    >



<div class="wrapper">

  @include('admin.layouts.header')
  <!-- Left side column. contains the logo and sidebar -->
@include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		@yield('content')
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
@include('admin.layouts.footer')

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


	@include('admin.layouts.scripts')
