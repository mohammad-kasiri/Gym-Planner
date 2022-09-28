@extends('admin.layout.master' , ['title' => 'لیست عضله ها'])
@section('title' , 'لیست عضله ها')

@section('subheader')
    <x-dashboard.subheader :links='[]' :title="'لیست عضله ها'" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Notice-->
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                <div class="alert-text">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="نزدیک">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        @endif
        <!--end::Notice-->
        <div class="card card-custom my-5">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        افزودن عضله
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.muscle.store')}}" method="post">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-md-10">
                            <x-dashboard.form.row-input label="عنوان"  name="title" type="text"/>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary btn-block">افزودن عضله</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        لیست عضله ها
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table ">

                        <thead>
                        <tr class="text-muted">
                            <th class="text-center">#</th>
                            <th class="text-center">عنوان</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($muscles as $key=>$muscle)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="text-center align-middle text-nowrap"> {{$muscle->title}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
@endsection
