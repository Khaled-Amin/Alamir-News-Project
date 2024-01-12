<section id="newsSection">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="latest_newsarea"> <span>آخر أخبار</span>
                <ul id="ticker01" class="news_sticker">
                    @isset($getLatestNews)
                        @foreach ($getLatestNews->take(4) as $item)
                            <li><a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}"><img src="{{ url('../public/logo') }}/logo.png"
                                        alt="">{{ $item->title }}</a></li>
                        @endforeach
                    @endisset
                </ul>
            </div>
        </div>
    </div>
</section>
