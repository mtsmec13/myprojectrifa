<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Vite - Carrega e compila os assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stack para estilos específicos da página -->
    @stack('styles')
</head>
<body class="bg-dark-custom text-light">
    <div id="app">
        <header class="app-header sticky-top">
            <nav class="container d-flex justify-content-between align-items-center py-3">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                    <svg class="text-primary" width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="fw-bold fs-5">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="d-flex align-items-center gap-2">
                    @guest
                        @if (Route::has('login'))
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('login') }}">Entrar</a>
                        @endif
                        @if (Route::has('register'))
                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Registar</a>
                        @endif
                    @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">Dashboard</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="app-footer mt-5 py-4">
            <div class="container text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos os direitos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>

