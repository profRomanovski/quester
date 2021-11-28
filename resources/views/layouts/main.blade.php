<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quester</title>
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <script src="{{secure_asset('js/app.js')}}"></script>
    <style>
        #particles-js {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-background">
<div class="content z-10">
    @isset($message)
        <x-notification title={{$text}} content={{$content}}></x-notification>
    @endif
    @yield('content')
</div>

<div id="particles-js"></div>

</body>
</html>
