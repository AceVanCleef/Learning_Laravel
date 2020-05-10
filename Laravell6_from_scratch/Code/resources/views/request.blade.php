<!DOCTYPE html>
<html>
<head>
<title>Test</title>
</head>
<body>

<h1>This is a Request Test</h1>
<p>This is a complete test..</p>

<!--<h2><?= $name; ?></h2>-->
<h2><?= htmlspecialchars($name, ENT_QUOTES); ?></h2>
<h2>{{ $name }}</h2>
<p>loc = {{$loc}}</p>
<p>{!! $command !!}</p>

</body>
</html>