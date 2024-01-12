<!DOCTYPE html>
<html lang="ar">

<head>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6315175645187802"
     crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Description --}}
@if (isset($getTitleArtcileMeta))
    <meta name="description"
        content="@isset($getTitleArtcileMeta->meta_description){{ $getTitleArtcileMeta->meta_description }}@endisset">
@elseif (isset($getMetaDescr))
    <meta name="description" content="@isset($getMetaDescr){{ $getMetaDescr->description }}@endisset">
@else
    <meta name="description" content="@isset($settings){{ $settings->Description }}@endisset">
@endif
    {{-- Graph:Description --}}
@if (isset($getTitleArtcileMeta->meta_description))
    <meta property="og:description" content="@isset($getTitleArtcileMeta){{ $getTitleArtcileMeta->meta_description }}@endisset">
@elseif (isset($getMetaDescr))
    <meta property="og:description" content="@isset($getMetaDescr){{ $getMetaDescr->description }}@endisset">
@else
    <meta property="og:description" content="@isset($settings){{ $settings->Description }}@endisset">
@endif
    {{-- Keywords --}}
    <meta property="og:url" content="@isset($settings){{ $settings->linkWebsite }}@endisset">
@if (isset($getTitleArtcileMeta->key_words))
<meta name="keywords" content="@isset($getTitleArtcileMeta->key_words){{ $getTitleArtcileMeta->key_words }}@endisset">
@else
    <meta name="keywords" content="@isset($settings){{ $settings->Keywords }}@endisset">
@endif
@isset($settings->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('../public/uploading/' . $settings->favicon) }}">
@endisset
@if(isset($articles->image))
    <meta name="image" property="og:image" content="{{ url('../public/articlePic/'.$articles->image) }}">
    <meta name="twitter:image" content="{{ url('../public/articlePic/'.$articles->image) }}">
@else
    <meta property="og:image" content="{{ asset('../public/uploading/' . $settings->favicon) }}">
@endif

    <title>
@if (isset($getTitleArtcileMeta))
    {{ $getTitleArtcileMeta->title }}
@elseif (isset($getNameCategorySetTitleMeta))
    {{ $getNameCategorySetTitleMeta->name }}
@elseif (isset($getNameSubCategorySetTitleMeta))
    {{ $getNameSubCategorySetTitleMeta->name }}
@else
    الرئيسية | الأمير
@endif
    </title>
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/font.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/theme.css">
    <link rel="stylesheet" type="text/css" href="{{ url('../public/frontasset/assets') }}/css/style.css">
    {{-- <link rel="stylesheet" href="{{url('../public/frontasset/assets')}}/css/style.css"> --}}
    @isset($Adds)
        {!! $Adds->atHead !!}
    @endisset
</head>

<body>
    <!--<div id="preloader">-->
    <!--    <div id="status">&nbsp;</div>-->
    <!--</div>-->
    <a class="scrollToTop" href="javascript:void(0);" style="display: flex;
    justify-content: center;
    align-items: center;"><i class="fa fa-angle-up"></i></a>
    <div class="container">
        {{-- Header Top --}}
        <header id="header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_top">
                        <div class="header_top_left">
                            <ul class="top_nav">
                                <li><a href="{{url('/')}}">الرئيسية</a></li>
                                <li><a href="{{url('about/')}}">من نحن</a></li>
                                <li><a href="{{ route('opinions.page') }}">آراء</a></li>
                                @foreach($pinned as $row)
                                <li><a href="{{ route('aboutPinned.page', $row->href) }}">{{$row->page_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="header_top_right">
                            <p>{{ \Carbon\Carbon::parse(now())->locale('ar')->translatedFormat('l j F Y ') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="header_bottom">
                        <div class="logo_area"><a href="{{url('/')}}" class="logo"><img
                                    src="{{ url('../public/frontasset') }}/images/logo.png" alt=""></a></div>
                        <div class="add_banner">@isset($Adds){!! $Adds->atRight !!}@endisset</div>
                    </div>
                </div>
            </div>
        </header>
        {{-- Header With Navbar --}}
        <section id="navArea">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav main_nav">
                        <li class="active"><a href="{{url('/')}}"><span class="fa fa-home desktop-home"></span><span
                            class="mobile-show">الرئيسية</span></a></li>
                        @foreach ($category->take(6) as $item)
                            <li><a href="{{route('categoryPage.page',  $item->slug)}}">{{$item->name}}</a></li>
                        @endforeach
                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                data-toggle="dropdown" role="button" aria-expanded="false">المزيد</a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($category->skip(6) as $item)
                                    <li><a href="{{route('categoryPage.page', $item->slug)}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>



        @yield('content')
        <p style="text-align: center;">
            @isset($Adds){!! $Adds->otherSite !!}@endisset
        </p>

        {{-- Footer --}}
        <footer id="footer">
            <div class="footer_bottom">
                <p class="copyright">جميع الحقوق محفوظة لشبكة الأمير &copy; <span id="currentYear"></span> <a
                        href="javascript:void(0);">الأمير</a></p>
                {{-- <p class="developer">Developed By Khaled Amir Ameen (khaledamiramin@gmail.com)</p> --}}
            </div>
        </footer>
    </div>
    <script>
        const currentYear = new Date().getFullYear();
        const currentYearElement = document.getElementById('currentYear');
        currentYearElement.textContent = currentYear;
    </script>
    <script src="{{ url('../public/frontasset/assets') }}/js/jquery.min.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/wow.min.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/slick.min.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/jquery.li-scroller.1.0.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/jquery.newsTicker.min.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/jquery.fancybox.pack.js"></script>
    <script src="{{ url('../public/frontasset/assets') }}/js/custom.js"></script>
</body>

</html>

<style>
    .pagination>.active>a,
    .pagination>.active>span,
    .pagination>.active>a:hover,
    .pagination>.active>span:hover,
    .pagination>.active>a:focus,
    .pagination>.active>span:focus{
        background-color: #D79C3D;
        border-color: #D79C3D;
    }
</style>

