@extends('frontend.layout.NavandFooter')
@section('content')

{{-- Section Line Breaking News  --}}
@include('frontend.layout.latestNews')
{{-- End Section Line Breaking News --}}

<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_post_content">
                    <h2><span>{{$categoryGetIds->name}}</span></h2>
                    @isset($getArticlesByCate)
                        @foreach ($getArticlesByCate as $item)
                                <div class="single_post_content_left modify-cate-page">
                                    <ul class="business_catgnav  wow fadeInDown">
                                        <li>
                                            <figure class="bsbig_fig"> <a href="{{route('pageArticle.page', [$item->category_id, $item->id])}}"
                                                    class="featured_img"> <img alt="" src="{{asset('../public/articlePic/'. $item->image)}}"> <span
                                                        class="overlay"></span> </a>
                                                <figcaption> <a href="{{route('pageArticle.page', [$item->category_id, $item->id])}}">{{$item->title}}</a>
                                                </figcaption>
                                                <p>{!! Str::limit(strip_tags($item->content), 100) !!}</p>
                                            </figure>
                                        </li>
                                    </ul>
                                </div>
                        @endforeach
                    @endisset



                </div>
                @if(isset($getArticlesByCate))
                    {{ $getArticlesByCate->links() }}
                @endif

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
<style>
    .modyfie{
        border: 1px solid #D79C3D;
    }
    .modyfie li {
        text-align:center !important;
    }
</style>


