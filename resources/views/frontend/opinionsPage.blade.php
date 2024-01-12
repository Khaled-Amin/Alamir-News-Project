@extends('frontend.layout.NavandFooter')
@section('content')

    {{-- Section Line Breaking News  --}}
    @include('frontend.layout.latestNews')
    {{-- End Section Line Breaking News --}}
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="left_content">
                    <div class="single_page">
                        <!-- <ol class="breadcrumb">
                                  <li><a href="../index.html">Home</a></li>
                                  <li><a href="#">Technology</a></li>
                                  <li class="active">Mobile</li>
                                </ol> -->
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li class="text-danger">
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success" role="alert" style="text-align: right;">
                                {{ $message }}
                            </div>
                        @endif
                        <h1>آراء</h1>
                        <div class="post_commentbox">
                            <a href="{{route('opinions.page')}}"><i class="fa fa-tags"></i>اراء</a>
                        </div>
                        <ul class="spost_nav commentslist">
                            @isset($commentsAll)
                                @foreach ($commentsAll as $item)
                                    <li>
                                        <div class="media wow fadeInDown animated"
                                            style="visibility: visible; animation-name: fadeInDown;">
                                            <a href="{{route('open.opinions.page', $item->id)}}" class="media-left">
                                                <img alt="" src="{{url('../public/logo/default-avatar.jpg')}}">
                                            </a>
                                            <div class="media-body">
                                                <h6>{{$item->name}}</h6>
                                                <small>{{ \Carbon\Carbon::parse($item->created_at)->locale('ar')->translatedFormat('l j F Y - h:ia') }}</small>
                                                <a href="{{route('open.opinions.page', $item->id)}}" class="catg_title">
                                                    <h4>{{ $item->title }}</h4>
                                                    <p dir="rtl">{{ Str::limit($item->bio, 140, '...') }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                        @if(isset($commentsAll))
                            {{ $commentsAll->links() }}
                            @endif
                        <div class="related_post">
                            <h2>أخبار ذات صلة<i class="fa fa-thumbs-o-up"></i></h2>
                            <ul class="spost_nav wow fadeInDown animated">
                                @isset($getRandomArticle)
                                    @foreach ($getRandomArticle->take(3) as $items)
                                        <li>
                                            <div class="media"> <a class="media-left"
                                                    href="{{ route('pageArticle.page', [$items->category_id, $items->id]) }}">
                                                    <img src="{{ url('../public/articlePic/' . $items->image) }}" alt=""> </a>
                                                <div class="media-body"> <a class="catg_title"
                                                        href="{{ route('pageArticle.page', [$items->category_id, $items->id]) }}">{{ $items->title }}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endisset

                            </ul>
                        </div>
                    </div>
                    @include('frontend.layout.AddCommnetLayout')
                </div>
            </div>

            <!-- Aside -->
            <div class="col-lg-4 col-md-4 col-sm-4">
                <aside class="right_content">
                    {{-- Trending --}}
                    @include('frontend.layout.isTrending')
                    {{-- Taps --}}
                    @include('frontend.layout.TapsPage')

                </aside>
            </div>
        </div>
    </section>

@endsection
