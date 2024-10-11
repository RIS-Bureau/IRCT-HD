<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config ('app.name')}} - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Main CSS-->
        <link rel="stylesheet" href="{{asset('assets/main.css')}}">
    </head>
    <body>
        {{--Menu Principale--}}
        @include('mainavbar/mainavbar')
        {{--Contenus à afficher--}}
        @yield('content')
        {{--Main Script Javascript--}}
        @include('mainscript')
    </body>
</html>
