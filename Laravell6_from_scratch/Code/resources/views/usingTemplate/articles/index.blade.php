@extends ('usingTemplate/layout')


@section ('templateContent')
<div id="wrapper">
	<div id="page" class="container">
        
		<div id="content">
            
            <p>test</p>
            @foreach ($articles as $article)
            <div class="title">
				<h2>{{$article->title}}</h2>            
                <p>{{ $article->body }}</p>
        
            </div>
            @endforeach
		</div>
	</div>
</div>
@endSection