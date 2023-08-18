<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parse;
use App\Models\City;
use Illuminate\Support\Facades\Cache;

class ParseController extends Controller
{

    public function index($cityKey){

        if(Cache::has('active_city_'.$cityKey)==null or isset($_GET['cache'])){
            $city = City::where('city_url',$cityKey)->first();
            echo "kesh no";
            Cache::add('active_city_'.$cityKey, $city, 60*60);
        }else{
            $city = Cache::get('active_city_'.$cityKey);
            echo "kesh vkl";
        }

        $parses = $city->parses;

        return view('parses.list', compact('city','parses'));
    }
    public function show($cityKey,$parseUrl){

        if(Cache::has('active_city_'.$cityKey)==null or isset($_GET['cache'])){
            $city = City::where('city_url',$cityKey)->first();
            Cache::add('active_city_'.$cityKey, $city, 60*60);
        }else{
            $city = Cache::get('active_city_'.$cityKey);
        }

        if(Cache::has('datail_parse_'.$parseUrl)==null or isset($_GET['cache'])){
            $parse = Parse::where('url',$parseUrl)->first();
            Cache::add('datail_parse_'.$parseUrl, $parse, 60*60);
        }else{
            $parse = Cache::get('datail_parse_'.$parseUrl);
        }
        $parses = $city->parses;
        return view('parses.show', compact('city','parse','parses'));
    }
    //
}
