<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="/img/icon.png" rel="shortcut icon" type="image/x-icon" />
    {!! htmlScriptTagJsApi() !!}
</head>
<body>
    <div class="header">
        <a href="{{ route('index') }}">
            <img src="/img/logo.png" alt="index">
        </a>
        <div class="header-links">
            <div class="separator"></div>
            <a href="{{ route('voiting.list') }}">Голосование</a>
            <div class="separator"></div>
            <a href="{{ route('addmusician') }}">Предложить исполнителя</a>
            <div class="separator"></div>
            <a href="{{ route('about') }}">Певец Liceyskii</a>
            <div class="separator"></div>
            @if(!session('user'))
                <a href="{{ route('login') }}">Авторизация</a>
                <div class="separator"></div>
            @else
                <a href="{{ route('logout') }}">Выйти</a>
                <div class="separator"></div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="content">
            {{ $content }}
        </div>
        <div class="footer">
            <p>©Liceyskii 2024</p>
            <p>Проект учебный, некоммерческий, создан при помощи Laravel</p>
        </div>
    </div>
</body>
</html>