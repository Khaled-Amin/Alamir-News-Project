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
                            {{$message}}
                        </div>
                          @endif
                        <h1>{{ $articles->title }}</h1>
                        <div class="post_commentbox"><span><i class="fa fa-calendar"></i>6:49 AM</span> <span><i class="fa fa-eye"></i>@isset($viewsArt){{$viewsArt->views}}@endisset</span> <a
                                href="javascript:void(0);"><i class="fa fa-tags"></i>{{ $categoryWithSlug->name }}</a>
                        </div>
                        <div class="single_page_content"> <img class="img-center"
                                src="{{ asset('../public/articlePic/' . $articles->image) }}" alt="">
                            <div class="cont_edit">{!! $articles->content !!}</div>
                            
                            @isset($getterTage->name)
                                <div class="tagsPost">
                                    @if ($getterTage->name != null)
                                        @foreach ($get_sites_de->tags as $index => $tags)
                                            <a href="#">{{$tags->name}} <i class="fa fa-tags"></i></a>
                                        @endforeach
                                    @endif
                                </div>
                            @endisset
                        </div>
                        <div class="social_link">
                            <ul class="sociallink_nav">
                                <li><a href="https://www.facebook.com/sharer.php?u={{urlencode(url('/article-page/'.$articles->category_id.'/'.$articles->id))}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/share?url={{urlencode(url('/article-page/'.$articles->category_id.'/'.$articles->id))}}&text={{urlencode($articles->title)}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                {{-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li> --}}
                            </ul>
                        </div>
                        <div class="related_post">
                            <h2>أخبار ذات صلة<i class="fa fa-thumbs-o-up"></i></h2>
                            <ul class="spost_nav wow fadeInDown animated">
                                @isset($getRandomArticle)
                                    @foreach ($getRandomArticle->take(3) as $item)
                                        <li>
                                            <div class="media"> <a class="media-left"
                                                    href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}">
                                                    <img src="{{ url('../public/articlePic/' . $item->image) }}" alt=""> </a>
                                                <div class="media-body"> <a class="catg_title"
                                                        href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}">{{ $item->title }}</a>
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

<style>
    .cont_edit{
        width:100%;
    }
    .cont_edit img{
    width:100% !important;
    height:100%;
}
</style>
