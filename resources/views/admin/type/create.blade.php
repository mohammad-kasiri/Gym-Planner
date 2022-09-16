@extends('admin.layout.master')
@section('title' , " افزودن تایپ " )
@section('headline', " افزودن تایپ ")

@section('subheader')
    @php
        $buttons = [
            [
                'title' => 'بازگشت به لیست تایپ ها' ,
                'icon'   =>  '<i class="fas fa-undo icon-nm"></i>' ,
                'route' => route('admin.type.index') ],
        ];
    @endphp
    <x-dashboard.subheader :links='$buttons??[]' :title="'افزودن تایپ جدید'" />
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        افزودن تایپ
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.type.store')}}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <x-dashboard.form.row-input label="عنوان" name="title" type="text"/>
                        </div>
                    </div>


                    <h4 class="card-label mt-10">
                        شاخص ها
                    </h4>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="row">
                                @foreach($indices as $index)
                                    <div class="col-md-3 my-5">
                                        <x-dashboard.form.checkbox
                                            name="indices[{{$index->id}}]"
                                            value="{{ $index->id }}"
                                            checked="{{old('indices.'.$index->id) ? '1' : 0}}"
                                        >
                                            {{ $index->title }}
                                        </x-dashboard.form.checkbox>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary float-right" type="submit"> ذخیره ی تایپ </button>
                </form>
            </div>
        </div>
    </div>
@endsection
