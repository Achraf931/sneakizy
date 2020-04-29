<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="node_modules/@splidejs/splide/dist/css/splide.min.css">
        <meta property="og:site_name" content = "SNKEAKiZY"/>
        <meta property="og:title" content="SNKEAKiZY"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://sneakizy.herokuapp.com/"/>
        <meta property="og:image" content="https://res.cloudinary.com/hrd7cpazc/image/upload/v1588094080/Sneakizy/Logo/qjmhoqpinrane4jcd7y9.jpg"/>
        <meta property="og:description" content="Boutique en ligne de sneakers."/>
        <title>Sneakizy</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
