<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://4iz278.podlahyvnoucek.cz/js/app.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://4iz278.podlahyvnoucek.cz/css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="container">
        

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
    @include('inc.footer') 
</body>
</html>
