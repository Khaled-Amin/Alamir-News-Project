@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>اضافة مستخدم جديد
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
                            <li class="breadcrumb-item">المستخدمون</li>
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
                            <form action="{{ route('store.user.main') }}" method="POST" class="needs-validation">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">اسم<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">بريد الالكتروني<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">كلمة المرور<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">تأكيد كلمة المرور<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-xl-3 col-sm-4 mb-0">الصلاحيات<span>*</span> :</label>
                                    <div class="col-xl-8 col-sm-7">
                                        <select class="form-control digits" id="role" name="role">
                                            <option value="">اختر الصلاحية...</option>
                                            @foreach ($roles as $role)
                                                {{-- <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option> --}}
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
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


