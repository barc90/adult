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
	$videos = Video::orderBy('id', 'desc')->get();

    return view('index', ['categories' => $categories, 'videos' => $videos]);
});


Route::get('/category/{slug}', function ($slug) {

	$categories = Category::all();
	$category = Category::where('slug', $slug)->first();	

	$videos = Video::where('category_id', $category->id)->orderBy('id', 'desc')->get();	

    return view('category', ['categories' => $categories, 'videos' => $videos]);
});
