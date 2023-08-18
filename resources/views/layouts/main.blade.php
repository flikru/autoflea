<?php
use App\Models\City;
if(request()->route()->parameter('city') !== null){
    $city = request()->route()->parameter('city');
    $city = City::where('city_url',$city)->first();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title_browser')</title>

    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/mobile.css')}}">
</head>
<body>
    <header>
        <div class="header">
            <div class="container header-container">
                <div class="logo"><a href="/"><img src="/public/img/site/logo.svg" alt=""></a></div>
                <div class="header-text">Актуальный справочник авторазборов по всей России</div>
            </div>
        </div>
        <div class="container">
            @if(request()->path() != "/")
                <nav class="breadcrumbs">
                    <ul class="">
                        <li><a href="/">Главная</a><span>/</span></li>
                        <li><a href="/{{$city->city_url}}">Авторазборы в г. {{$city->title}}</a></li>
                    </ul>
                </nav>
            @endif
        </div>
    </header>
    <section>
        <div class="container">
            @yield('content')
        </div>
    </section>
    <footer>
        <script src="{{asset('public/assets/js/jquery-3.7.0.min.js')}}"></script>
        <script src="{{asset('public/assets/js/jquery.inputmask.js')}}"></script>
        <script src="{{asset('public/assets/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/assets/js/mainscripts.js')}}"></script>
    </footer>
</body>
</html>
