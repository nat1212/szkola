<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wersja_robocza') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
    @yield('styles')
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    

    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Wersja_robocza') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                        @if(Auth::check())
                <div style="font-size:16px;" class="nav-link">{{ __('Witaj,') }} {{ Auth::user()->first_name }}</div>
                        @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href = "{{ route('home') }}">Profil</a>
                                    
                                    @if(Request::is('home*'))
                                    <div class="H2p">
                                    <a  onclick="toggleExpand()" class="dropdown-item"  href="#">
                                    {{ __('Edycja profilu') }}
                                    </a>
                                    <a onclick="rating(1)" class="dropdown-item"  href="#">
                                    {{ __(' Lista twoich wydarzeń') }}
                                    </a>
                                    <a onclick="rating(2)" class="dropdown-item"  href="#">
                                    {{ __(' Wygasłe wydarzenia') }}
                                    </a>
                                    <a onclick="rating(3)" class="dropdown-item"  href="#">
                                    {{ __(' Twoje zapisy') }}
                                    </a>
                                    <a onclick="rating(6)" class="dropdown-item"  href="#">
                                    {{ __(' Twoje zapisy zakończone') }}
                                    </a>
                                    <a onclick="rating(4)" class="dropdown-item"  href="#">
                                    {{ __(' Zapis grupowy') }}
                                    </a>
                                    <a onclick="rating(5)" class="dropdown-item"  href="#">
                                    {{ __(' Zapis grupowy zakończony') }}
                                    </a>
                                    <a class="dropdown-item" href = "{{ route('event.list') }}">Wydarzenia</a>
                                    </div>
                                    
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src ="{{ asset('js/app.js')}}"></script>
    <script type="text/javascript">
    @yield('javascript')
    </script>
</body>
</html>
