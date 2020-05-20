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


// ****************** Pass Request Data to Views ****************

//Fetching data from a URL such as: http://localhost:8080/request?name=jeff
Route::get('/request', function () {
    $name = request('name');
    //return $name;

    return view('request', [
        'name' => $name,
        'loc' => request('loc'), //you can also fetch directly
        'command' => request('command')
    ]);
});


// ****************** Route Wildcards ****************
// 1. Define the Wildcard: {post}, which can be anything (a string, numbers, my-new-post, etc).
// 2. Make it available via 'function ($post)' to pull data from Database.
Route::get('/posts/{post}', function ($post) {
    //return $post;   //simply output to the browser as string

    //3. Array simulating a data base -> 404 page
    $posts = [
        'my-first-post' => 'Hello, my name is James Bond',
        'my-second-post' => 'Bonjour, je m apelle James Bond'
    ];

    //4. If post doesn't exist in DB
    if (! array_key_exists($post, $posts)) {
        abort(404, 'Post not found!');
    }

    //5. Return to view, which echoes the blog post.
    return view('post', [
        'post' => $posts[$post] //fetching a post from the DB / Array
    ]);
});



// ****************** Routing to Controllers ****************
// Ideal for larger sized projects: Routing to a controller

// 1. Define the Wildcard: {post}, which can be anything (a string, numbers, my-new-post, etc).
// 2. Define the Controller as parameter, including a function with which it should reacte, i.e. show.
Route::get('/postsViaController/{post}', 'PostsController@show');



// ****************** Database Access ****************
Route::get('/postsFromDB/{slug}', 'PostsController@showFromDB');


// ****************** Database Access: W/ Elqoeunt Models ****************
Route::get('/postsEloquent/{slug}', 'PostsController@showUsingEloquentModels');


/********************* Layout Pages ******************* */
Route::get('/contact', function () {
    return view('contact');
});


/********************* Integrate a Site Template ******************* */
Route::get('/usingTemplate/', function () {
    return view('usingTemplate/welcome');
});
