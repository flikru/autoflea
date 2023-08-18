@extends('layouts.main')
@yield('title_browser')
@section('title_browser')
    {{$parse->name}} в г. {{$city->title }}
@endsection
@section('content')
<div class="detail-parse">
<div class="row grid-detail">
    <div class="parse-img-cnt">
    <div class="parse-img-detail"><img src="/public/img/content/parse/no-image.png" alt=""></div>
    </div>
    <div class="parse-title-cnt">
        <div class="main_h1">
            <h1>{{$parse->name}}</h1>
        </div>
    </div>
    <div class="description-detail">
        {{$parse->description}}
    </div>
    <div class="parse-info-cnt">
        <div class="bottom-block-detail">
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
<div class="row">
    <div class="col-12 col-md-4">
        <div class="shedule-cnt">
            <div class="main-head-text mb-4">График работы</div>
            <div>{{($parse->shedule) ? $parse->shedule : "ПН-ПТ с 9:00 до 18:00"}}</div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="address-cnt">
            <div class="address-cnt-detail">
                <div class="graph-h main-head-text ">Адрес</div>
                <div class="address-h">{{$parse->address}}</div>
            </div>
            <div class="maps">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3AVq0fDUDMkuUB6bzFA9-gA9HHZQdyYLm-&amp;width=100%25&amp;height=240&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="main-head-text mb-4">Обслуживаемые автомобили в {{$parse->name}}</div>
    <div class="brands-cnt">
        @foreach($parse->brands as $brand)
            <div class="brand-item">{{$brand->title}}</div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="main-head-text mb-4">Другие авторазборы в г. {{$city->title }}</div>
    @include('parses.blocklist')
</div>
</div>
@endsection
