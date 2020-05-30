@extends ('usingTemplate/layout')


@section ('templateContent')
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>{{$article->title}}</h2>
			<p><img src="{{ asset('images/banner.jpg') }}" alt="" class="image image-full" /> </p>
            
            {{ $article->body }}
        
            </div>
		</div>
	</div>
</div>
@endSection