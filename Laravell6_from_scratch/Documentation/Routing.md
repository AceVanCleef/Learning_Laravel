# Routing

## Basic Routing and Views

**Routing**: www.yourdomain.com/**customview**

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