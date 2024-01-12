<div class="single_sidebar">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab"
                data-toggle="tab">تصنيفات</a></li>
        <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">فيديو</a>
        </li>
        <li role="presentation"><a href="#comments" aria-controls="messages" role="tab"
                data-toggle="tab">تعليقات</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="category">
            <ul class="lsitCate">
                @isset($category)
                    @foreach ($category as $item)
                        <li class="cat-item"><a href="{{route('categoryPage.page', $item->slug)}}">{{ $item->name }}</a></li>
                    @endforeach
                @endisset

            </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="video">
            <div class="vide_area">
                <iframe width="100%" height="250"
                    src="http://www.youtube.com/embed/h5QWbURNEpA?feature=player_detailpage" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="comments">
            <ul class="spost_nav">
                @isset($commetns)
                    @foreach ($commetns as $comment)
                        <li>
                            <div class="media wow fadeInDown">
                                <a href="{{route('open.opinions.page', $comment->id)}}" class="media-left">
                                    <img alt="" src="{{ url('../public/logo/default-avatar.jpg') }}">
                                </a>
                                <div class="media-body">
                                    <a href="javascript:void(0);" class="catg_title">
                                        {{ $comment->title }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endisset


            </ul>
        </div>
    </div>
</div>
