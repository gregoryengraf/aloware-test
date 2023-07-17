<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.png') }}" />
    <title>Aloware test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#121214] bg-galaxy bg-fixed bg-cover bg-no-repeat">
    <div id="app">
        <example-component></example-component>
    </div>
</body>
</html>
