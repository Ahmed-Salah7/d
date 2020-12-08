<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Login Page</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="baseUrl" data-url="{{ url('/') }}"  id="baseUrl"/>
        <!-- App Icons -->
        <link rel="shortcut icon" href=" {{ asset('images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->

        <div class="account-pages">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 offset-lg-1">
                        <div class="text-left">
                            <div>
                                <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset('images/logo_dark.png') }}" height="28" alt="logo"></a>
                            </div>
                            <h5 class="font-14 text-muted mb-4">برنامج أسس الاسقدام </h5>
                            <p class="text-muted mb-4"> برنامج اسس الاستقدام لمكاتب الاستقدام </p>

                            <h5 class="font-14 text-muted mb-4">Terms :</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>واجهه مميزة وخفيفة</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>سريع </p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>خدمات </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-2">
                                    <h4 class="text-muted float-right font-18 mt-4">{{ __('page.singup') }}</h4>
                                    <div>
                                        <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset('images/logo_dark.png') }}" height="28" alt="logo"></a>
                                    </div>
                                </div>

                                <div class="p-2">
                                    @include('includes.form_error')
                                    @include('includes.message')
                                    <form class="form-horizontal m-t-20" id="login_form" method="POST" autocomplete="off" >
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" placeholder="{{ __('page.username') }}"  required=""  name="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="password" placeholder="{{ __('page.password') }}"  required=""   name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">{{ __('page.remember_me') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light btn-login" type="submit"> {{ __('page.login') }} <i class="fas "></i></button>
                                            </div>
                                        </div>

                                        <div class="form-group m-t-10 mb-0 row">
                                            <div class="col-sm-7 m-t-20">
                                                @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">
                                                       <i class="mdi mdi-lock"></i> {{ __('page.forgot_password') }}
                                                    </a>
                                                @endif
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <!-- custom js -->
        <script src="{{ asset('js/erp-script.js') }}" ></script>
        <script src="{{ asset('js/erp-validation.js') }}" ></script>
        <script src="{{ asset('js/erp-message.js') }}" ></script>
    </body>
</html>