# Views

## Layout Pages


In order to not having to repeat HTML code, script and css references in every single file, we can use layout pages.

### Content page
- contains the custom HTML for this specific page
- Extends the layout page: `@extends ('layout')`
- Defines the section yielded by the layout page: `@section ('content')` and `@endsection`

```
@extends ('layout')

@section ('content')
<div class="your page specific content">
	...
</div>
@endsection
```


### Layout Page
- contains the HTML structure shared among every page.
- Yields the content of a content page: `@yield ('content')`
- Can yield multiple @section(s). E.g: @yield('header'), @yield ('content') and @yield ('footer')

```
<!DOCTYPE html>
<!-- a layout page holds html that is used on every page -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	...
    </head>
    <body>
        <!-- custom content per page here -->
        @yield ('header')
        @yield ('content')
        @yield ('footer')
    </body>
</html>
```

### And Routing?
**Target** the **content page** with your routing. Blade engine handles the insertion of HTML code into the content page.


## Integrate a Site Template



[Download SimpleWork Template](https://templated.co/simplework)

Content:
- default.css
- fonts/
- fonts.css
- images/

and

- index.html
- license.txt

Steps...
1. Move first group into laravel's **public** directory (Note: renamed public_html).
2. Create a layout.blade.php file and paste the content of the index.html file into this layout file.
3. Simply extend the layout file: @extends ('layout')
4. Tip: relocate css files from public to public/css and adapt references within your layout page.
5. Refractoring: Move content from layout page to separate content page **welcome.php**
6. Adapt / check what parts of the template belong to layout page or content page. For example, oyu might want to introduce a seperate @section ('header')

The layout.blade.php:
```
</head>
<body>
    @yield ('header')
    @yield ('templateContent')
</body>
</html>
```

The usingTemplate/welcome.blade.php
```
@extends ('usingTemplate/layout')

@section ('header')
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">SimpleWork</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="#" accesskey="2" title="">Our Clients</a></li>
				<li><a href="#" accesskey="3" title="">About Us</a></li>
				<li><a href="#" accesskey="4" title="">Careers</a></li>
				<li><a href="#" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<div id="header-featured">
		...
	</div>
</div>
@endSection

@section ('templateContent')
<div id="wrapper">
	...
</div>
@endSection
```



## Set an Active Menu Link

To dynamically mark a navigation item as 'active', you can use:

- `<li class="{{Request::path() === '/' ? 'current_page_item' : ''}}">...`
- A regex: `<li><a {{Request::is('about') ? 'current_page_item' : ''}}...`

Navigation menu Code:
```
	<ul>
		<!-- Set an Active Menu Link -->
		<li class="{{Request::path() === '/usingTemplate' ? 'current_page_item' : ''}}"><a href="/usingTemplate" accesskey="1" title="">Homepage</a></li>
		<li>...</li>
		<!-- dynamic class setting via regex -->
		<li><a {{Request::is('about') ? 'current_page_item' : ''}} href="/usingTemplate/about" accesskey="3" title="">About Us</a></li>
		<li>...</li>
	</ul>
```


## Asset Compilation with Laravel Mix and webpack

There are two locations to put CSS and JS code:
1. public/css and public/js: For native JS, CSS
2. resources/css and resources/js: For when you have a built process using webpack, Sass, etc.

Files from (2) are going to be compiled down to (1). (1) will be served to the browser.

### Defining the Webpack Build Process

**webpack.mix.js**: Defines what built steps webpack will execute.

### Dependencies

**package.json": defines what dependencies will be installed once you execute the following terminal command: `npm install`.

### Automatically rebuilt dev-dependencies

...using `npm run watch`, which will keep an eye on your files. When they change, it compiles the code down. Otherwise, to manually compile, use `npm run dev`

### Summary: Your general workflow for new projects

1. npm install
2. Configure webpack in webpack.mix.js

Tip: Research laravel mix.



## Render Dynamic Data

1. Create a model: `php artisan make:model Article -m`
2. Create a migration: `php artisan migrate`
2. Define migration in **.._create_articles_table.php**

```
public function up()
{
	Schema::create('articles', function (Blueprint $table) {
		$table->id();
		$table->string('title');
		$table->text('exert');
		$table->text('body');
		$table->timestamps();
	});
}
```

4. Create article entries and store them into DB

Either by manually creating entries in PhpMySql or using `php artisan tinker`.

```
//using php artisan tinker
$article = new App\Article;

$article->title = 'Getting to know us'

$article->excert = 'Lorem ipsum excerpt...'

$article->body = 'Lorem ipsum dolor sit amet, eam at meis tamquam senserit, te duo enim nominati. Commodo vivendo ei eos. Cu tale elit zril vim. Eu singulis indoctum pri, sit in aperiri lucilius theophrastus. No vix solum inermis, vix laudem laoreet impedit no.'


then check: $article

persist object in DB:
$article->save();
```

5. Dynamically echoing articles into the **about.html** using blade:

```
<ul class="style1">
	@foreach ($articles as $article)
	<li>
		<h3>{{ $article->title }}</h3>
		<p><a href="#">{{ $article->exert }}</a></p>
	</li>
	@endforeach
</ul>
```


## Render Dynamic Data: Part 2


Files involved:
- ArticlesController.php
- Articles.php (Model)
- about.blade.php
- articles/show.blade.php
- web.php

### Creating a controller and a routing

php artisan make:controller ArticlesController

class ArticlesController extends Controller
{
    public function show($id)
    {
        return view('/usingTemplate/articles/show', ['article' => Article::find($id)]);
    }
}

Routing:
`Route::get('/usingTemplate/articles/{article}', 'ArticlesController@show');`

Note: **{article}** represents a wildcard.



### Ways to reference to external scripts and css files
...to maintain reference to our styling, images and interactivity.

1. Replace relative reference with an explicit one: `/css/default.css`, an explicit reference starting from the root folder by using `/` at the beginning.

2. laravel helper function to link to any asset: `href="{{ asset(path) }}"`or `href="{{ URL::asset('css/fonts.css') }}"`


Side note: Even the path of an image can be stored in a DB.



### Homework: Create Articles - page
1. Go to layout page and update href="#" target path.
2. Add new route
3. Define what controller and action to load
4. What should our page do in our action? E.g. Fetch all articles
5. Display fechted articles in a view.



# Issues Fixed

## Resources (CSS, JS, Images) not found [Get 404]

Use this to add assets like css, javascript, images.. into blade file.

### For CSS
`<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >`
or
`<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css" >`

### For JS
`<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>`
or
`<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>`

### For Images
`{{ asset('img/photo.jpg') }}`

Here is the [Doc](http://laravel.com/docs/4.2/helpers#urls)