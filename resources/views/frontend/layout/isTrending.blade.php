<div class="single_sidebar">
    <h2><span>أخبار شائعة</span></h2>
    <ul class="spost_nav">
        @isset($is_Trending)
            @foreach ($is_Trending->take(5) as $item)
                <li>
                    <div class="media wow fadeInDown"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}" class="media-left">
                            <img alt="" src="{{ asset('../public/articlePic/' . $item->image) }}"> </a>
                        <div class="media-body"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}"
                                class="catg_title">{{ $item->title }}</a> </div>
                    </div>
                </li>
            @endforeach
        @endisset
    </ul>
</div>
<div class="single_sidebar">
    <h2><span>الأكثر قراءة</span></h2>
    <ul class="spost_nav">
        @isset($getMoreReadArticle)
            @foreach ($getMoreReadArticle->take(5) as $item)
                <li>
                    <div class="media wow fadeInDown"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}" class="media-left">
                            <img alt="" src="{{ asset('../public/articlePic/' . $item->image) }}"> </a>
                        <div class="media-body"> <a href="{{ route('pageArticle.page', [$item->category_id, $item->id]) }}"
                                class="catg_title">{{ $item->title }}</a> </div>
                    </div>
                </li>
            @endforeach
        @endisset
    </ul>
</div>
