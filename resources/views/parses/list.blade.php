@extends('layouts.main')
@section('title_browser')
    Авторазборы в г.{{$city->title}}
@endsection
@section('content')
    <div class="">
        <div class="main_h1">
            <h1>Авторазборы в г.{{$city->title}}</h1>
        </div>
        <h2 class="text_h2">Все авторазборки в г.{{$city->title}}. <br>Адреса, телефоны и рейтинг компаний, занимающихся разбором автомобилей.</h2>
        @foreach($parses as $parse)
        <div class="parse-items col-12">
            <div class="row parse-item">
                <div class="col-6 col-md-3">
                    <div class="parse-img"><img src="/public/img/content/parse/no-image.png" alt=""></div>
                </div>
                <div class="parse-info col-6 col-md-6">
                    <div class="parse-name"><a href="{{route('parse.show',[$city->city_url,$parse->url])}}"><h3>{{$parse->name}}</h3></a></div>
                    <div class="parse-adress">{{$parse->address}}</div>

                    <div class="parse-graph-head">График работы</div>
                    <div class="parse-graph">
                        <div class="parse-day">{!! ($parse->schedule) ? $parse->schedule : "ПН-ПТ с 9:00 до 18:00" !!}</div>
                    </div>
                </div>
                <div class="parse-call col-12 col-md-3">
                    <div class="parse-phone">
                        <button class="parse-open-phone">показать телефон</button>
                        <div style="display: none"><a href="tel:{{$parse->phone}}">{{$parse->phone}}</a></div>
                    </div>
                    <div class="parse-rating">
                        <span class="parse-int-rating">4.5</span>
                        <div class="stars">
                            <span class="star star-full"></span><span class="star star-full"></span><span class="star star-full"></span><span class="star star-full"></span><span class="star"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
