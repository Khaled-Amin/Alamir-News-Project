@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>اضافة صفحة ثابتة 
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{route('user.main')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">الصفحات الثابتة</li>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="display: flex;
                            flex-direction: column;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('store.pinned.main') }}" method="POST" class="needs-validation">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">اسم الصفحة<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('page_name') is-invalid @enderror" type="text" name="page_name" value="{{ old('page_name') }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">slug<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('href') is-invalid @enderror" type="text" name="href" value="{{ old('href') }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">محتوى<span>*</span></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="editor"  name="content">{{ old('content') }}</textarea>
                                    </div>
                                </div>

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



<style>
    #category, #subcategory{
        color: #2b2b2b;
    }
    .dark option{
        background-color: #FFF !important;
    }
</style>


