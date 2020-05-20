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

