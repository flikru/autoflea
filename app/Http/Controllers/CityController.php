<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    public function index(){

        if(Cache::has('cities')==null or isset($_GET['cache'])){
            $cities = City::orderBy('title', 'ASC')->get();
            Cache::add('cities', $cities, 60*60*24);
        }else{
            $cities = Cache::get('cities');
        }

        return view('home.index', compact('cities'));
    }
}
