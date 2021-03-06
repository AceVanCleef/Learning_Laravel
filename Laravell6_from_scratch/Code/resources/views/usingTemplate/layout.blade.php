<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : SimpleWork 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140225

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="{{ asset('css/default.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('css/fonts.css') }}" rel="stylesheet" />
<!-- or: <link href='/css/default.css' rel='stylesheet' /> to base the refrence to the root folder -->

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
<link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/bulma" />
</head>
<body>
    <!-- header -->
    <div id="header-wrapper">
        <div id="header" class="container">
            <div id="logo">
                <h1><a href="/">SimpleWork</a></h1>
            </div>
            <div id="menu">
                <ul>	<!-- li class="current_page_item -->
                    <!-- Set an Active Menu Link -->
                    <li class="{{Request::path() === '/usingTemplate/' ? 'current_page_item' : ''}}"><a href="/usingTemplate" accesskey="1" title="">Homepage</a></li>
                    <li class="{{Request::path() === '/usingTemplate/clients' ? 'current_page_item' : ''}}"><a href="#" accesskey="2" title="">Our Clients</a></li>
                    <!-- dynamic class setting via regex -->
                    <li class="{{Request::is('about') ? 'current_page_item' : ''}}"><a href="/usingTemplate/about" accesskey="3" title="">About Us</a></li>
                    <li class="{{Request::path() === '/usingTemplate/articles' ? 'current_page_item' : ''}}"><a href="/usingTemplate/articles" accesskey="4" title="">Articles</a></li>
                    <li class="{{Request::path() === '/usingTemplate/contact' ? 'current_page_item' : ''}}"> <a href="#" accesskey="5" title="">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div id="header-featured">
            <div id="banner-wrapper">
                <div id="banner" class="container">
                    <h2>Maecenas luctus lectus</h2>
                    <p>This is <strong>SimpleWork</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
                    <a href="#" class="button">Etiam posuere</a> </div>
            </div>
        </div>
    </div>

    @yield ('templateContent')

    <!-- footer -->
    <div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
    </div>
</body>
</html>
