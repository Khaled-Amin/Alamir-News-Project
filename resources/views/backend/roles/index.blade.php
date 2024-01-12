@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>صلاحيات
                                <small>لوحة التحكم</small>
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
                            <li class="breadcrumb-item">قسم</li>
                            <li class="breadcrumb-item active">صلاحيات</li>
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
                        <div class="card-header" style="justify-content: flex-end">
                            <a href="{{route('create.roles.main')}}" class="btn text-white">Create New Roles</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-desi">
                                <table class="table all-package table-category " id="editableTable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Role</th>
                                            <th>Slug</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @isset($roles)
                                            @foreach ($roles as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->id }}
                                                    </td>
                                                    <td data-field="slug">{{ $item->name }}</td>
                                                    <td data-field="slug">{{ $item->slug }}</td>
                                                    <td>
                                                        <a href="{{ route('edit.roles.main', $item->id) }}">
                                                            <i class="fa fa-edit" title="Edit"></i>
                                                        </a>
                                                        <a href="{{ route('show.roles.main', $item->id) }}">
                                                            <i class="fa fa-eye" title="eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal" data-roleid="{{$item->id}}">
                                                            <i class="fa fa-trash" title="Delete"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset


                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">هل أنت متأكد أنك تريد حذف هذه الصلاحية ?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            حدد "حذف" إذا كنت تريد حذف هذا الدور حقًا.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">تراجع</button>
                                            <form action="" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                {{-- <input type="hidden" id="role_id" name="role_id" value=""> --}}
                                                <button type="button" class="btn btn-primary" onclick="$(this).closest('form').submit();">حذف</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>




@endsection
@section('script')
    {{-- <script>
        function confirmDelete(deleteUrl) {
            if (confirm("Do you want to delete this user")) {
                window.location.href = deleteUrl;
            }
            return false; // Prevent the default link behavior
        }
    </script> --}}
    <script>
        $('#deleteModal').on('show.bs.modal', function(e){
            var button = $(e.relatedTarget)
            var role_id = button.data('roleid')

            var modal = $(this)
            // modal.find('.modal-footer #role_id').val(role_id)
            modal.find('form').attr('action', 'roles/destroy'+ '/' + role_id);
        });
    </script>
@endsection
