@extends('endUser.layouts.master')
@section('title')
    Flipmart premium - Sign in
@endsection
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Reset Your Password</h4>
                        <form class="register-form outer-top-xs" role="form" method="POST"
                            action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email', $request->email) }}"
                                    class="form-control unicase-form-control text-input" id="exampleInputEmail2">
                                @error('email')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                                <input type="password" name="password" class="form-control unicase-form-control text-input"
                                    id="exampleInputEmail1">
                                @error('password')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input type="password" name="password_confirmation"
                                    class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                @error('password_confirmation')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item m-t-10">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif"
                                    alt="">
                            </a>
                        </div>
                        <!--/.item-->
                    </div><!-- /.owl-carousel #logo-slider -->
                </div><!-- /.logo-slider-inner -->

            </div><!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    @endsection
    @section('js')
        <!-- For demo purposes – can be removed on production -->

        <script src="switchstylesheet/switchstylesheet.js"></script>

        <script>
            $(document).ready(function() {
                $(".changecolor").switchstylesheet({
                    seperator: "color"
                });
                $('.show-theme-options').click(function() {
                    $(this).parent().toggleClass('open');
                    return false;
                });
            });

            $(window).bind("load", function() {
                $('.show-theme-options').delay(2000).trigger('click');
            });
        </script>
        <!-- For demo purposes – can be removed on production : End -->
    @endsection
