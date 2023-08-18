<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\ParserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/parser', [ParserController::class, 'parseAutoDetail'])->name('parser.get');

Route::get('/', [CityController::class, 'index'])->name('home.index');
Route::get('/{city}', [ParseController::class, 'index'])->name('parse.index');
Route::get('/{city}/{parse}', [ParseController::class, 'show'])->name('parse.show');

/*
Route::get('/', function () {
    return view('home.index');
});*/
