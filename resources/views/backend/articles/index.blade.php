@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Articles
                                <small>dashboard</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Section</li>
                            <li class="breadcrumb-item active">Articles</li>
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
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">
                                {{-- <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Search..">
                            </div> --}}
                            </form>
                            <div class="container">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-warning alert-dismissible fade show" style="text-align: left;"
                                        role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>

                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li class="text-danger">
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            {{-- <a href="{{ route('create.articles.main') }}" class="btn add-row mt-md-0 mt-2">Add Articles</a> --}}
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-desi">
                                <table class="table all-package table-category " id="editableTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>title</th>
                                            <th>slug</th>
                                            <th>trending</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @isset($articles)
                                            @forelse ($articles as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->id }}
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td data-field="slug">{{ $item->title_slug }}</td>

                                                    <td class="order-cancle" data-field="trending">
                                                        <span>{{ $item->trending == 0 ? 'IsNotTrending' : 'IsTrending' }}</span>
                                                    </td>


                                                    <td>
                                                        @if (auth('admin')->user()->can('update', $item))
                                                        <a href="{{ route('edit.articles.main', $item->id) }}">
                                                            <i class="fa fa-edit" title="Edit"></i>
                                                        </a>

                                                        <a href="{{ route('toggole.articles.main', $item->id) }}">
                                                            <i class="fa fa-check" title="isTrending"></i>
                                                        </a>
                                                        @endif
                                                        @if (auth('admin')->user()->can('forceDelete', $item))
                                                        <a href="javascript:void(0);"
                                                            onclick="return confirmDelete('{{ route('destroy.articles.main', $item->id) }}');">
                                                            <i class="fa fa-trash" title="Delete"></i>
                                                        </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" style="text-align:center;">لايوجد بيانات لعرضها</td>
                                                </tr>
                                            @endforelse
                                        @endisset
                                        

                                    </tbody>
                                </table>
                            </div>
                            @if(isset($articles))
                                            {!! $articles->appends(['sort' => 'votes'])->links() !!}
                                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>




@endsection
@section('script')
    <script>
        function confirmDelete(deleteUrl) {
            if (confirm("Do you want to delete this item?")) {
                window.location.href = deleteUrl;
            }
            return false; // Prevent the default link behavior
        }
    </script>
@endsection
<style>
    .page-item.active .page-link{
        background-color:#E69520 !important;
        border-color: #E69520 !important;
    }
    .page-item .page-link {
        color:#E69520 !important;
    }
    .page-item.active .page-link{
        color:#FFF !important;
    }
</style>
