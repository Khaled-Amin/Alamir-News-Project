@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Add Settings
                                <small>dashboard</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('show.sittings')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Add Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li class="text-danger">
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('setSittings') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>اسم الموقع</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="nameWebsite"
                                            value="@isset($getShowSettings) {{ $getShowSettings->nameWebsite }} @endisset">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>رابط الموقع</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="linkWebsite"
                                            value="@isset($getShowSettings) {{ $getShowSettings->linkWebsite }} @endisset">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>وصف</label>
                                    <div class="col-md-8">
                                        <textarea class="ckeditor form-control" id="myTextarea" name="content">{!! optional($getShowSettings)->Description !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>من نحن</label>
                                    <div class="col-md-8">
                                        <textarea class="ckeditor form-control" id="myTextarea" name="About_us">{!! optional($getShowSettings)->About_us !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>كلمات المفتاحية</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="key_words">{{$getShowSettings->Keywords ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>favicon</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="favicon">
                                        @isset($getShowSettings)
                                            <img src="{{url('../public/uploading/' . $getShowSettings->favicon)}}" alt="">
                                        @endisset
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>meta_image</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="meta_image">
                                        @isset($getShowSettings)
                                            <img src="{{url('../public/uploading/' . $getShowSettings->meta_image)}}" alt="">
                                        @endisset
                                    </div>
                                </div>
                                <hr>
                                <h4>روابط تواصل الاجتماعي</h4>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Facebook</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="socialMidiaFacebook"
                                            value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaFacebook }} @endisset">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>LinkedIn</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="socialMidiaLinkedin"
                                            value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaLinkedin }} @endisset">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Twitter</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="socialMidiaTwitter"
                                            value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaTwitter	 }} @endisset">
                                    </div>
                                </div>
                                <button type="submit" class="btn d-block">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>


@endsection

