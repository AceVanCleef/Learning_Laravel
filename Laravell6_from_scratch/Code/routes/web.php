<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


//Return another view (see resources/views/*)
Route::get('/welcome', function () {
    return view('welcome');
});


//Return a string
Route::get('/astring', function () {
    return "a string :-)";
});


//Return a JSON -> ideal for when building APIs
Route::get('/json', function () {
    return ['foo' => 'bar'];
});


//With a new view
Route::get('test', function () {    //Note: 1st param can be '/test' or 'test'. Both work.
    return view('test');
});
