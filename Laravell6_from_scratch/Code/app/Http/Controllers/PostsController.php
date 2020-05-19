<?php

namespace App\Http\Controllers;

//Eloquent Models
use App\Post;

// 3. Create controller...
class PostsController
{
    // 4. ...and its function
    public function show($post)
    {
        //Array simulating a database
        $posts = [
            'my-first-post' => 'Hello, my name is James Bond',
            'my-second-post' => 'Bonjour, je m apelle James Bond'
        ];
    
        //If post doesn't exist in DB
        if (! array_key_exists($post, $posts)) {
            abort(404, 'Post not found!');
        }
    
        //Return to view, which echoes the blog post.
        return view('post', [
            'post' => $posts[$post] //fetching a post from the DB / Array
        ]);
    }


    public function showFromDB($slug)
    {
        $postFromDB = \DB::table('posts')->where('slug', $slug)->first();

        //DD = Dump and Die -> to inspect a variable.
        //dd($postFromDB);

        //If post doesn't exist in DB
        if (! $postFromDB) {
            abort(404);
        }

        return view('postsFromDB', [
            'postFromDB' => $postFromDB
        ]);
    }


    // Eloquent Models
    public function showUsingEloquentModels($slug)
    {
        //Querying from DB via Eloquent Model.
        $post = Post::where('slug', $slug)->firstOrFail(); //replaces an abort(404);

        return view('postsEloquent', [
            'post' => $post
        ]);
    }
}
