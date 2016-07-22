<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Category;
use App\Video;

Route::get('/', function () {
	$categories = Category::all();
    return view('index', ['categories' => $categories]);
});


Route::get('/category/{slug}', function ($slug) {
    return "TEST - $slug";
});
