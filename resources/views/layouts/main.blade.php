<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quester</title>
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="content bg-background">
    @isset($message)
        <x-notification title={{$text}} content={{$content}}></x-notification>
    @endif
    @yield('content')
</div>
<script src="{{secure_asset('js/app.js')}}"></script>
</body>
</html>
