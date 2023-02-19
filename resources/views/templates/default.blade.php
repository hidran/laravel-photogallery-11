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
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
        body {
            padding: 70px 15px 0;
        }

    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Photo Gallery</a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="{{route('dashboard')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('albums.index')}}">Albums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('albums.create')}}">New
                            Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('photos.create')}}">New
                            Image</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search"
                           placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li>
                            <a class="nav-link"
                               href="{{route('login')}}">Login</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                    @endguest
                    @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle  nav-link"
                               data-bs-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span
                                    class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>

                                    <form id="logout-form"
                                          action="{{ route('logout')}}"
                                          method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-default">Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<main role="main" class="container-fluid">
    @yield('content')
</main><!-- /.container -->
@section('footer')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
@show
</body>
</html>
