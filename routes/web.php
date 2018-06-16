<?php

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
    return view('home');
});

//Route::get('/sufler', function () {
//    return view('sufler',
//        [
//            'text' => "Page 2 - A little about the Author"
//        ]
//    );
//});

Route::get('sufler', 'MessagesController@getTexts');

Route::post('/home/submit', 'MessagesController@submit');