@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>اضافة تصنيف
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('categories.main')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">تصنيفات</li>
                            <li class="breadcrumb-item active">اضافة تصنيف</li>
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
                            <form action="{{ route('update.categories.main', $categoryId->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="category" class="col-xl-3 col-sm-4 mb-0">تصنيف :</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" id="category_id" name="category">
                                            <option value=" ">اختر التصنيف</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{$categoryId->parent_id == $item->id  ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="subcategory" class="col-xl-3 col-sm-4 mb-0">تصنيف فرعي :</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" name="subcategory" id="subcategory">
                                            @foreach ($categories as $val)
                                                @foreach($val->supcategories as $key => $row)
                                                    <option value="{{$row->id}}" {{$categoryId->id == $row->id  ? 'selected' : ''}}>{{ $row->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">اسم<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="name"
                                            value="{{$categoryId->name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">وصف<span>*</span></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="myTextarea"  name="descr">{!! $categoryId->descr !!}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">Status</label>
                                    <div class="col-xl-9 col-md-8">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox-primary-2" type="checkbox" data-original-title=""
                                                title="" name="status">
                                            <label for="checkbox-primary-2">اظهار التصنيف </label>
                                        </div>
                                    </div>
                                </div> --}}
                                <button type="submit" class="btn d-block">حفظ</button>
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
