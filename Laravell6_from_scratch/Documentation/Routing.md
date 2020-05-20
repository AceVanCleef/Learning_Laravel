# Routing

## Basic Routing and Views

**Routing**: www.yourdomain.com/<customview>

When a user types yourdomain.com/shop, you can define in **routes/web.php** what html view will be loaded.

In Laravel project...
- **views** are located in `resources/views/*`  
- **routes** are located in `routes`

### routing/web.php

Following code shows that you can...
1. define a default view: yourdomain.com/
2. define a custom view: yourdomain.com/customview
3. return a string via routing
4. return a JSON, which is ideal for creating an API
5. either write '/test' or 'test' to define the first level routing.


```
//1) Default routing
Route::get('/', function () {
    return view('welcome');
});


//2) Return another view (see resources/views/*)
Route::get('/welcome', function () {
    return view('welcome');
});


//3) Return a string
Route::get('/astring', function () {
    return "a string :-)";
});


//4) Return a JSON -> ideal for when building APIs
Route::get('/json', function () {
    return ['foo' => 'bar'];
});


//5) With a new view
Route::get('test', function () {    //Note: 1st param can be '/test' or 'test'. Both work.
    return view('test');
});

```


## Pass Request Data to View

- You can fetch request parameters from urls such as http://localhost:8080/request?name=jeff.
- You can fetch data from formed data (JSON)

```
Route::get('/request', function () {
    $name = request('name');    //fetch parameter value
    
    return view('request', [    //send $name to view.
        'name' => $name
    ]);
});
```

### How to escape HTML Characters and prevent Code Insertion

`<h2><?php echo $name ?></h2>` in request.blade.php is a bad idea. Any user can abuse that with inserting code such as http://localhost:8080/request?**name=<script>alter('hi');</script>**.

### Escaping Code Insertion

- Using classic PHP: ` <h2><?= htmlspecialchars($name, ENT_QUOTES); ?></h2> `
- Using Laravel's Blade Template Engine: ` <h2>{{ $name }}</h2>`

### Allowing Code insertion when desired

For example: 
- http://localhost:8080/request?command=%3Cscript%3Ealert(%27hi%27);%3C/script%3E
- Fetching HTML from Database

` <p>{!! $command !!}</p> ` within the view, using Blade Template Engine.

### Blade Template Engine

Files compiled down to php are stored in **storage/framework/views**. These files will ultimatively be served by the browser.




## Route Wildcards

```
// 1. Define the Wildcard: {post}, which can be anything (a string, numbers, my-new-post, etc).
// 2. Make it available via 'function ($post)' to pull data from Database.
Route::get('/posts/{post}', function ($post) {

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

```

and echoing in the **post.blade.php" view:
` <p>{{ $post }}</p> `




## Routing to Controllers
Ideal for larger sized projects: Routing to a controller

### In routes/**web.php**:
```
// 1. Define the Wildcard: {post}, which can be anything (a string, numbers, my-new-post, etc).
// 2. Define the Controller as parameter, including a function with which it should reacte, i.e. show.
Route::get('/postsViaController/{post}', 'PostsController@show');
```

### Create router
Two options:
- Via command line ` php artisan make:controller PostsController `
- Manually by creating a new file in app/Http/**Controllers**

The Controller:

```
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

```



## Extra Learnings

### Oragnizing and routing to views in view/yoursubfolder

It is possible to store views in subfolders of /view. E.g. view/**usingTemplate/**yourview.blade.php.

web.php: For routing, include the folder name in the path declaration to the view.

```
Route::get('/usingTemplate/', function () {
    return view('usingTemplate/welcome');   //include the folder name
});
```