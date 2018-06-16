<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sufler Page</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>

@if(count($texts) > 0)
    @foreach($texts as $text)
        <div id="app">
            <sufler :text="'{{json_encode($text->text)}}'"
                    :speed="'{{json_encode($text->speed)}}'"></sufler>
        </div>
    @endforeach
@endif

<script type="text/javascript" src="js/app.js"></script>
</body>
</html>