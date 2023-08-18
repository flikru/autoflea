@extends('layouts.main')

@section('title_browser')
    AUTOFLEA
@endsection
@section('content')
    <div class="main_h1">
        <h1>AUTOFLEA.RU</h1>
    </div>
        <h2 class="text_h2">Актуальный справочник авторазборов по всей России</h2>
        <div class="">
            <div class="home-select">
                <div class="col-12 col-md-10 p-0 pr-md-4">
                    <select id="change-city">
                        <option value="none">Выберите свой город, чтобы увидеть актуальный список авторазборок</option>
                        @foreach($cities as $city)
                            <option value="{{$city->city_url}}">{{$city->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2 p-0">
                    <a href="" class="link_city">выбрать</a>
                </div>
            </div>
        </div>
@endsection
