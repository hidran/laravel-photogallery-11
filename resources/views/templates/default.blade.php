<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author"
          content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>@yield('title', 'Home')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        main.container {
            padding: 70px 15px 0;
        }
    </style>

</head>
<body class="d-flex flex-column h-100">
@include('templates.theme-switcher')
@include('templates.header')

<main role="main" class="container">
    @yield('content')
</main><!-- /.container -->
@section('footer')
    @include('templates.footer')
@show
</body>
</html>
