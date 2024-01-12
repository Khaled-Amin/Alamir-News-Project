@extends('frontend.layout.NavandFooter')
@section('content')
    {{-- Section Line Breaking News  --}}
    @include('frontend.layout.latestNews')
    {{-- End Section Line Breaking News --}}

    {{-- Section Slider and aside Latest News --}}
    <section id="sliderSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="slick_slider">
                    @isset($articles)
                        @foreach ($articles as $item)
                            <div class="single_iteam"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}"> <img src="{{ asset('../public/articlePic/' . $item->image) }}"
                                        alt=""></a>
                                <div class="slider_article">
                                    <h2><a class="slider_tittle" href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}">{{ $item->title }}</a></h2>
                                    {{-- <div class="paragraph_content"><span>{!! Str::limit($item->content, 180) !!}</span></div> --}}
                                </div>
                            </div>
                        @endforeach
                    @endisset

                </div>
            </div>
            {{-- Latest Articles --}}
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="latest_post">
                    <h2><span>اخر مقالات</span></h2>
                    <div class="latest_post_container">
                        <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                        <ul class="latest_postnav">
                            @isset($getLatestNews)
                                @foreach ($getLatestNews->take(5) as $item)
                                    <li>
                                        <div class="media"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}" class="media-left"> <img alt=""
                                                    src="{{ asset('../public/articlePic/' . $item->image) }}"> </a>
                                            <div class="media-body"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}"
                                                    class="catg_title">{{ $item->title }}</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endisset

                        </ul>
                        <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Section Slider and aside Latest News --}}

    {{-- Section Categories --}}
    <section id="contentSection">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8" dir="rtl">
                <div class="left_content">
                    <div class="fashion_technology_area">
                        @isset($category)
                            @foreach ($category->take(4) as $item)
                            @if($item->article->count() > 0)
                                <div class="boxNews">
                                    <div class="single_post_content">
                                        <h2><a href="{{route('categoryPage.page',  $item->slug)}}" style="color:#FFF;"><span>{{ $item->name }}</span></a></h2>
                                        <ul class="business_catgnav wow fadeInDown">
                                            @foreach ($item->article->take(1) as $key => $val)
                                                <li>
                                                    <figure class="bsbig_fig"> <a href="{{ route('pageArticle.page', [$item->id, $val->id]) }}" class="featured_img">
                                                            <img alt="" src="{{ asset('../public/articlePic/' . $val->image) }}">
                                                            <span class="overlay"></span> </a>
                                                        <figcaption> <a href="{{ route('pageArticle.page', [$item->id, $val->id]) }}">{{ $val->title }}</a>
                                                        </figcaption>
                                                        {{-- <p>{!! Str::limit($val->content, 120) !!}</p> --}}
                                                    </figure>
                                                </li>
                                            @endforeach

                                        </ul>
                                        <ul class="spost_nav">
                                            @foreach ($item->article->skip(1)->take(4) as $key => $val)
                                                <li>
                                                    <div class="media wow fadeInDown"> <a href="{{ route('pageArticle.page', [$val->category_id, $val->id]) }}" class="media-left">
                                                            <img alt="" src="{{ asset('../public/articlePic/' . $val->image) }}">
                                                        </a>
                                                        <div class="media-body"> <a href="{{ route('pageArticle.page', [$val->category_id, $val->id]) }}"
                                                                class="catg_title">{{$val->title}}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endisset

                        
                    </div>
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
    {{-- End Section Categories --}}
@endsection
