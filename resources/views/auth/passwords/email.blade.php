
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Reset Passworld</title>
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
                            <h5 class="font-14 text-muted mb-4">Responsive Bootstrap 4 Admin Dashboard</h5>
                            <p class="text-muted mb-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>

                            <h5 class="font-14 text-muted mb-4">Terms :</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>At solmen va esser necessi far uniform paroles.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Donec sapien ut libero venenatis faucibus.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Nemo enim ipsam voluptatem quia voluptas sit .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <div>
                                        <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset('images/logo_dark.png') }}" height="28" alt="logo"></a>
                                    </div>
                                    <h4 class="text-muted font-18 mt-4">{{ __('page.reset_password') }}</h4>
                                </div>
                                @include('includes.form_error')
                                @include('includes.message')
                                <div class="p-2">
                                    <form method="POST" id="reset_password_form" >
                                        @csrf
                                        {{ method_field('POST') }}
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="email" placeholder="{{ __('page.email') }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">{{ __('page.send_password_reset_link') }}  <i class="fas "></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form -->
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
