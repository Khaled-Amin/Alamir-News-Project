@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>اضافة مقالة
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('articles.main')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">مقالات</li>
                            <li class="breadcrumb-item active">اضافة مقالة</li>
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
                            <form action="{{ route('store.articles.main') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="category" class="col-xl-3 col-sm-4 mb-0">تصنيف :</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" id="category_id" name="category">
                                            <option value=" ">اختر التصنيف الرئيسي</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subcategory" class="col-xl-3 col-sm-4 mb-0">تصنيف الفرعي :</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" name="subcategory" id="subcategory">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">العنوان<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="title"
                                            required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">Meta Description<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="meta_description"
                                            >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">كلمات مفتاحية<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="key_words"
                                            >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">تاغات(يجب فصل بينها بفاصلة)<span>*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" id="tags" class="form-control" name="tags" placeholder="tags" data-role="tagsinput">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">محتوى<span>*</span></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="editor"  name="content"></textarea>
                                    </div>
                                </div>
                                <h2>قسم رفع الصور</h2>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">صورة الخبر<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">البوم صور<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="albums[]" multiple>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">Status<span>*</span></label>
                                    <div class="col-xl-9 col-md-8">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox-primary-2" type="checkbox" data-original-title=""
                                                name="trending">
                                            <label for="checkbox-primary-2">شائع</label>
                                        </div>
                                    </div>
                                </div> --}}
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

@section('script')


<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#category_id").on("change", function() {
                var cat_id = $(this).val();
                console.log(cat_id);
                $.ajax({
                    url: "{{ route('ajax.subcate.main') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id
                    },
                    dataType : 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        // $('#subcategory').append('<option value=""> أختر التصنيف الفرعي </option>');
                        $('#subcategory').append('<option value = ""> -- بدون اب --</option>');
                        $.each(data, function(index,
                        subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.name + '</option>');
                        })
                        console.log(data);
                    }
                })
            });
        });
</script>


@endsection
@section('style')

<style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #ffffff;
        background: #2196f3;
        padding: 3px 7px;
        border-radius: 3px;
    }
    .bootstrap-tagsinput {
        width: 100%;
    }
    .bootstrap-tagsinput input{
        padding: 10px;
    }
</style>

@endsection
