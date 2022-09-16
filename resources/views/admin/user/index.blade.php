@extends('admin.layout.master' , ['title' => 'لیست کاربران'])
@section('title' , 'لیست کاربران')

@section('subheader')
    <x-dashboard.subheader :links='[]' :title="'لیست کاربران'" />
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
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            لیست کاربران
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table ">
                            <thead>
                            <tr class="text-muted">
                                <th class="text-center">#</th>
                                <th class="text-center">تصویر</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">تلفن همراه</th>
                                @can('doctors.show')
                                    <th class="text-center">عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key=>$user)
                                    <tr>
                                        <td class="text-center align-middle"> {{\App\Functions\PaginationCounter::item($users , $key)}} </td>
                                        <td class="text-center align-middle"> <img src="{{ $user->avatar() }}" width="40px"></td>
                                        <td class="text-center align-middle text-nowrap"> {{ $user->name }}</td>
                                        <td class="text-center align-middle"> <a href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a> </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <div class="text-center mt-5">
                {{$users->render()}}
            </div>
        </div>
        <!--end::Container-->

@endsection
