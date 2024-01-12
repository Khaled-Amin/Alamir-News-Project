@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>تعديل المستخدم
                                <small>لوحة التحكم</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.main') }}">
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
                            <form action="{{ route('update.user.main', $user->id) }}" method="POST"
                                class="needs-validation">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">اسم<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">بريد الالكتروني<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">كلمة المرور<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="password" name="password" minlength="8"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">تأكيد كلمة المرور<span>*</span></label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="password" name="password_confirmation"
                                            minlength="8" autocomplete="off">
                                    </div>
                                </div>
                                @foreach ($user->roles as $item)
                                        @if ($item->name === 'Admin')
                                        @else
                                        <div class="form-group">
                                            <label for="role">الصلاحيات<span>*</span></label>
                                            <select class="role form-control" name="role" id="role">
                                                <option value="">اختر الصلاحية...</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @endif
                                @endforeach



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
    #category,
    #subcategory {
        color: #2b2b2b;
    }

    .dark option {
        background-color: #FFF !important;
    }
</style>
