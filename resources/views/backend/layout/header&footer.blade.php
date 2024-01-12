<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{url('../public/logo/logo.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{url('../public/logo/logo.png')}}" type="image/x-icon">
    <title>لوحة التحكم - الأمير</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{url('../public/assets/css/vendors/font-awesome.css')}}">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{url('../public/assets/css/vendors/flag-icon.css')}}">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{url('../public/assets/css/vendors/icofont.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css"> --}}
    <!-- Prism css-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}"> --}}

    <!-- Chartist css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}"> --}}

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{url('../public/assets/css/vendors/bootstrap.css')}}">


    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{url('../public/assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="rtl">


    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left d-lg-none w-auto">
                    <div class="logo-wrapper">
                        <a href="{{url('/')}}">
                            <img class="blur-up lazyloaded d-block d-lg-none"
                                src="{{url('../public/logo/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="mobile-sidebar w-auto">
                    <div class="media-body text-end switch-sm">
                        <label class="switch">
                            <a href="javascript:void(0)" style="color:#E69520 !important;">
                                <i id="sidebar-toggle" data-feather="align-left"></i>
                            </a>
                        </label>
                    </div>
                </div>
                <div class="nav-right col">
                    <ul class="nav-menus">
                        {{-- <li>
                            <form class="form-inline search-form">
                                <div class="form-group">
                                    <input class="form-control-plaintext" type="search" placeholder="بحث..">
                                    <span class="d-sm-none mobile-search">
                                        <i data-feather="search"></i>
                                    </span>
                                </div>
                            </form>
                        </li> --}}
                        <li>
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i data-feather="maximize-2"></i>
                            </a>
                        </li>
                        <li class="onhover-dropdown">
                            <!-- <a class="txt-dark" href="javascript:void(0)">
                                <h6>EN</h6>
                            </a> -->
                            <ul class="language-dropdown onhover-show-div p-20">
                                <li>
                                    <a href="javascript:void(0)" data-lng="en">
                                        <i class="flag-icon flag-icon-is"></i>English</a>
                                </li>
                            </ul>
                        </li>

                        <li class="onhover-dropdown">
                            <div class="media align-items-center">
                                <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                    src="{{url('../public/logo/logo.png')}}" alt="header-user">
                                <div class="dotted-animation">
                                    <span class="animate-circle"></span>
                                    <span class="main-circle"></span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="user"></i>
                                        @auth('admin')
                                        {{ auth('admin')->user()->name }}
                                        @endauth

                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="javascript:void(0)">
                                        <i data-feather="settings"></i>Settings
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{route('admin.logout')}}">
                                        <i data-feather="log-out"></i>تسجيل خروج
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right">
                        <i data-feather="more-horizontal"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header Ends -->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
                @include('backend.layout.sidebar')
            <!-- Page Sidebar Ends-->

                @yield('content')



              <!-- footer start-->
              {{-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright text-start">
                            <p class="mb-0">All rights reserved 2023 ©.</p>
                        </div>
                        <!-- <div class="col-md-6 pull-right text-end">
                            <p class=" mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
                        </div> -->
                    </div>
                </div>
            </footer> --}}
            <!-- footer end-->
        </div>

    </div>





    <!-- latest jquery-->
    <script src="{{url('../public/assets/js/jquery-3.3.1.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{url('../public/assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{url('../public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{url('../public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>

    <!-- Sidebar jquery-->
    <script src="{{url('../public/assets/js/sidebar-menu.js')}}"></script>

    <!--chartist js-->
    {{-- <script src="{{url('../public/assets/js/chart/chartist/chartist.js')}}"></script> --}}

    <!--chartjs js-->
    {{-- <script src="{{url('../public/assets/js/chart/chartjs/chart.min.js')}}"></script> --}}

    <!-- lazyload js-->
    <script src="{{url('../public/assets/js/lazysizes.min.js')}}"></script>

    <!--copycode js-->
    {{-- <script src="{{asset('assets/js/prism/prism.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script> --}}

    <!--counter js-->
    <script src="{{url('../public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('../public/assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{url('../public/assets/js/counter/counter-custom.js')}}"></script>

    <!--peity chart js-->
    <script src="{{url('../public/assets/js/chart/peity-chart/peity.jquery.js')}}"></script>

    <!-- Apex Chart Js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

    <!--sparkline chart js-->
    <script src="{{asset('assets/js/chart/sparkline/sparkline.js')}}"></script>

    <!--Customizer admin-->
    <script src="{{url('../public/assets/js/admin-customizer.js')}}"></script>

    <!--dashboard custom js-->
    <script src="{{url('../public/assets/js/dashboard/default.js')}}"></script>

    <!--right sidebar js-->
    <script src="{{url('../public/assets/js/chat-menu.js')}}"></script>

    <!--height equal js-->
    <script src="{{url('../public/assets/js/height-equal.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{url('../public/assets/js/lazysizes.min.js')}}"></script>

    <!--script admin-->
    <script src="{{url('../public/assets/js/admin-script.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <!-- Ckeditor -->
    <script src="{{url("../public/ckeditor/ckeditor.js")}}"></script>
    <script>
        CKEDITOR.replace( 'editor',{
            filebrowserUploadUrl:"{{route('ck.upload', ['_token' => csrf_token()])}}",
            filebrowserUploadMethod:"form"
        });
    </script>
    <!-- TinyMCE CDN -->
    <!-- Place the first <script> tag in your HTML's <head> -->
    <!--    <script src="https://cdn.tiny.cloud/1/lvpsal5rq1cyvmrgwhej0e0935qj7bvz3h81gn0c8tvci45f/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>-->
    <!--    <script>-->
    <!--        tinymce.init({-->
    <!--            selector: '#myTextarea',-->
                <!--height: 300, // set the height of the editor-->
    <!--            plugins: 'autoresize autolink lists link image charmap print preview anchor',-->
    <!--            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',-->
    <!--            autoresize_bottom_margin: 16,-->
    <!--            menubar: false-->
    <!--        });-->
    <!--    </script>-->

    @yield('script')
</body>

</html>
@yield('style')
<style>
    :root{
        --theme-color: #E69520;
    }
    body .card .card-header a{
        background-color: #E69520 !important;
        border-color: #E69520 !important;
    }

    body svg line {
        color: #E69520 !important;
    }
    .needs-validation .btn{
        color: #FFF;
        background-color: #E69520 !important;
        border-color: #E69520 !important;
    }
    /* .needs-validation button:hover{
        background-color: transparent !important;
        color: #FFF !important;
    } */
    .h6_color{
        color:#E69520 !important;
    }
    .sidebar-submenu{
        padding: 0 !important;
    }
    .page-main-header .main-header-right .nav-right ul li .media .dotted-animation .main-circle{
        background-color: #E69520 !important;
    }
    .page-main-header .main-header-right svg line,
    .page-main-header .main-header-right svg polyline,
    .page-main-header .main-header-right svg,
    .page-main-header .main-header-right .nav-right ul li svg path,
    .page-main-header .main-header-right .nav-right>ul>li h6,
    .page-wrapper .page-main-header .main-header-right .nav-right>.mobile-toggle svg circle{
        color: #E69520 !important;
    }
    .badge-primary,
    .page-main-header .main-header-right .nav-right ul li .dot{
        background-color: #E69520 !important;
    }
    .altr{
        width:100%;
        background-color: #4CAF50;
        color: #FFF;
    }
    .sidebar-back i{
        color: #FFF;
    }
    .dark .card .card-header{
        display:block;
        text-align: right
    }
    .sidebar-back i{
        color: #000;
    }
</style>
