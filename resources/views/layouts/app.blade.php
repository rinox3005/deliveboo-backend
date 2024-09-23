<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/7711c3f1fc.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md shadow-sm bg-custom-primary sticky-top">
            <div class="container-fluid nav-spaces">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        <img class="logo" src="{{ Vite::asset('resources/img/deliveboo_logo_light.png') }}"
                            alt="">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white fs-6 fw-semibold"
                                href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.restaurants.index') }}">{{ __('Ristoranti') }}</a>
                        </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white fs-6 fw-semibold"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white fs-6 fw-semibold"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if ($restaurant)
                                <li class="nav-item d-block d-md-none">
                                    <a class="nav-link text-white fs-6 fw-semibold" href="{{ route('user.dashboard') }}">
                                        {{ __('Dashboard') }} </a>
                                </li>
                                <li class="nav-item d-block d-md-none">
                                    <a class="nav-link text-white fs-6 fw-semibold"
                                        href="{{ route('user.restaurants.show', $restaurant) }}">
                                        {{ __('Ristorante') }} </a>
                                </li>
                                <li class="nav-item d-block d-md-none">
                                    <a class="nav-link text-white fs-6 fw-semibold"
                                        href="{{ route('user.dishes.index') }}">
                                        {{ __('Menú') }} </a>
                                </li>
                                <li class="nav-item d-block d-md-none">
                                    <a class="nav-link text-white fs-6 fw-semibold"
                                        href="{{ route('user.orders.index') }}">
                                        {{ __('Ordini') }} </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white fs-6 fw-semibold"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <div id="theme-dropdown-menu" class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="navbarDropdown">
                                    {{-- <a id="theme-toggle" class="dropdown-item" href="#">
                                        <i id="theme-icon" class="fas fa-moon"></i> Dark Mode
                                    </a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
