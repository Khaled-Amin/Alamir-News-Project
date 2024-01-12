@php
    use App\Models\Setting;

    $setting = Setting::first();
@endphp
<div class="page-sidebar">
    {{-- <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{url('/')}}" style="width:90px;height:70px;">
                <img class="d-none d-lg-block blur-up lazyloaded"
                    src="{{asset('../logo/logo.jpg')}}" alt="" style="width:100%;height:100%;">
            </a>
        </div>
    </div> --}}
    <div class="sidebar custom-scrollbar" style="height:100%;">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times"
                aria-hidden="true"></i></a>
        <div class="sidebar-user">
            <a href="{{url('/')}}"><img class="img-60" src="{{url('../public/logo/logo.png')}}" alt="#"></a>
            <div>
                <h6 class="f-14 h6_color">AL-AmirNews</h6>
                <p>Dashboard</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="sidebar-header" href="{{route('admin.dashboard')}}">
                    <i data-feather="home"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>

            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="box"></i>
                    <span>الأقسام</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">

                    <li>
                        <a href="{{route('categories.main')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض الكل</span>
                        </a>
                    </li>
                    @php
                        use App\Models\Category;

                        $cate = Category::first();
                    @endphp
                    @if (auth('admin')->user()->can('update', $cate))
                    <li>
                        <a href="{{route('create.categories.main')}}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة القسم</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>

            <li>
                <a class="sidebar-header" href="javascript:void(0)">
                    <i data-feather="archive"></i>
                    <span>المقالات</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>

                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{route('articles.main')}}">
                            <i class="fa fa-circle"></i>
                            <span>عرض المقالات</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('create.articles.main') }}">
                            <i class="fa fa-circle"></i>
                            <span>اضافة مقالة</span>
                        </a>
                    </li>
                </ul>
            </li>



            @can('view', $setting)
            {{-- <li>
                <a class="sidebar-header" href="{{route('admins.main')}}">
                    <i data-feather="users"></i>
                    <span>المدراء</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-circle"></i>عملاء
                        </a>
                    </li>
                </ul>
            </li> --}}

            <li>
                <a class="sidebar-header" href="{{route('user.main')}}">
                    <i data-feather="users"></i>
                    <span>المستخدمين</span>
                    {{-- <i class="fa fa-angle-right pull-right"></i> --}}
                </a>
                {{-- <ul class="sidebar-submenu">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-circle"></i>عملاء
                        </a>
                    </li>
                </ul> --}}
            </li>

            <li>
                <a class="sidebar-header" href="{{route('roles.main')}}">
                    <i data-feather="users"></i>
                    <span>صلاحيات</span>
                    {{-- <i class="fa fa-angle-right pull-right"></i> --}}
                </a>
                {{-- <ul class="sidebar-submenu">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-circle"></i>عملاء
                        </a>
                    </li>
                </ul> --}}
            </li>
            <li>
                <a class="sidebar-header" href="{{route('comments.main')}}">
                    <i data-feather="users"></i>
                    <span>طلبات التعليقات</span>
                </a>
            </li>



            <li>
                <a class="sidebar-header" href="{{route('pinned.main')}}">
                    <i data-feather="archive"></i><span>الصفحات الثابتة</span></a>
            </li>
            <li>
                <a class="sidebar-header" href="{{route('show.sittings')}}"><i
                        data-feather="settings"></i><span>الاعدادات</span></a>
            </li>
            <li>
                <a class="sidebar-header" href="{{route('AddControl')}}"><i
                        data-feather="adds"></i><span>منطقة اعلانات</span></a>
            </li>
            @endcan

        </ul>
    </div>
</div>

