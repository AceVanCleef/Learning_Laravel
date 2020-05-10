<?php

namespace App\Http\Controllers;

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
}
