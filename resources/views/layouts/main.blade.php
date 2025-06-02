<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Assessment</title>
        @vite(['resources/css/app.css'])
    </head>
    <body class="min-h-screen bg-gray-100">
        <main class="flex flex-col">
            @yield('content')
        </main>
        @vite(['resources/js/app.js'])
    </body>
</html>
