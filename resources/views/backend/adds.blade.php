@extends('backend.layout.header&footer')
@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Add Adds
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
                            <li class="breadcrumb-item">Adds</li>
                            <li class="breadcrumb-item active">Add Adds</li>
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
                            <form action="{{ route('setAdd') }}" method="POST" class="needs-validation">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Add Adds in Tags(Head)</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="setHead">
@isset($Adds)
    {{$Adds->atHead}}
@endisset
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>In Top Page</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="setTop">
@isset($Adds)
    {{$Adds->atTop}}
@endisset
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Sied Right</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="setCenter">
@isset($Adds)
    {{ $Adds->atRight }}
@endisset
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4"><span>*</span>Other place</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="otherSite">
@isset($Adds)
    {{ $Adds->otherSite }}
@endisset
                                        </textarea>
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

