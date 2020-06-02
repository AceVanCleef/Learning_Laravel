# Forms

##The Seven Restful Controller Actions (CRUD)

### Controller side:
1. index: Renders a list of a resource
2. show (specific): Show a single resource
3. create: Shows a view to create a resource
4. store: Persists the new resource
5. edit: Show a view to edit an existing resource
6. update: Persist the edited resource (e.g. hitting 'submit' button)
7. destroy: Delete the resource

...resource(s) via a controller.

Commands:
- `php artisan make:controller ProjectsController -r`: Create controller with all CRUD actions
- `php artisan make:controller ProjectsController -r -m Project`: Same as above but includes a (Project $project) - parameter.



## Restful Routing (CRUD)

Get, Put, Post, Delete

Read (GET)
`Routes::get('/articles', 'ArticlesController@index')`
`Routes::get('/articles/{article}', 'ArticlesController@show')`

Calling Create page: `Routes::get('/articles', 'ArticlesController@create')`

Create (POST)
`Routes::post('/articles', 'ArticlesController@create')`


Update (PUT)
`Routes::put('/articles/{article}', 'ArticlesController@update')`

Delete (DELETE)
`Routes::delete('/articles/{article}', 'ArticlesController@destroy')`


Note: Everything has to be a noun in the url structure
E.g. subscriptions: Post video/subscription or Post /subscription


## Form Handling

Note: The order in which routes are listed in web.php matters. Precedence is from top to bottom.

### Creating a new article:

1. Created routes in **web.php**

```
//Create new resource (POST) -> user hits "submit"
Route::post('/usingTemplate/articles', 'ArticlesController@store');

//Create page
Route::get('/usingTemplate/articles/create', 'ArticlesController@create');
```

2. Created **create.blade.php** - view. Noteworthy: @csrf
```
 <form action="POST" action="/usingTemplate/articles">
 @csrf   <!--//CORS: protects against fake requests from foreign users (from other sites).-->
...
```

3. Added `create()` and `store()` to **ArticlesController.php**
```

    public function create()
    {
        return view('/usingTemplate/articles/create');
    }

    public function store()
    {
        //validation


        //die("Posted :)");
        //persist the new article

        //..the long way
        $article = new Article();
        $article->title = request('title');
        $article->excert = request('excert');
        $article->body = request('body');

        $article->save(); //persists to DB

        return redirect('/usingTemplate/articles'); //redirects to given view.
    }
```


# Fixes and Troubleshoots

## Null error on blade template property calls

Error: `Facade\Ignition\Exceptions\ViewException Trying to get property 'name' of non-object in index.blade.php`

Fix: Use {{ $employee->department->name ?? "" }} to eradicate this error.

See [PHP conditional assignment operators](https://www.w3schools.com/php/php_operators.asp)

Source: [Stackoverflow](https://stackoverflow.com/questions/60178498/facade-ignition-exceptions-viewexception-trying-to-get-property-name-of-non-ob)