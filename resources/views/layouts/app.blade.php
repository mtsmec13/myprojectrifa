<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Language" content="pt-br">

    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta name="color-scheme" content="light only">

    {{-- Título da Página Dinâmico --}}
    <title>{{ $data['social']->name ?? config('app.name', 'Laravel') }} - @yield('title')</title>

    @yield('ogContent')

    {{-- Pixel do Facebook (se existir) --}}
    @if(isset($data['social']->pixel) && $data['social']->pixel)
        {!! $data['social']->pixel !!}
    @endif
    <meta name="facebook-domain-verification" content="{{ $data['social']->verify_domain_fb ?? '' }}" />

    <!-- Google Fonts (Exemplo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- ========================================================================= --}}
    {{-- CORREÇÃO PRINCIPAL: Carregamento de CSS e JS com Vite --}}
    {{-- O Vite irá gerir o Bootstrap, o seu CSS customizado e o JavaScript. --}}
    {{-- Isto resolve o problema da "tela branca". --}}
    {{-- ========================================================================= --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Estilos específicos que podem permanecer aqui */
        body {
            background: #000 !important;
            font-family: 'Roboto', sans-serif;
        }
        
        #loadingSystem {
            background: rgba(206, 206, 206, 0.5) url("{{ asset('images/loading.gif') }}") no-repeat scroll center center;
            background-size: 150px 150px;
            height: 100%;
            left: 0;
            overflow: visible;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999999;
        }
    </style>
</head>
<body class="bg-dark text-white">

    <div id="loadingSystem" class="d-none"></div>

    <nav class="navbar navbar-expand-lg fixed-top px-0 py-3 bg-black">
        <div class="container" style="justify-content:space-evenly;align-items: center;">
            <div class="col-md-6 col-12 d-flex justify-content-between align-items-center">
                <div>
                    <a class="navbar-brand" href="{{ route('inicio') }}" style="color: #ffffff!important;">
                        @if (isset($data['social']->logo))
                            <img src="{{ asset('products/' . $data['social']->logo) }}" alt="Logo" style="max-width: 120px; max-height: 50px;">
                        @else
                            HD Produtora
                        @endif
                    </a>
                </div>
                <div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#consultar-reservas" class="text-white text-decoration-none me-2">
                        <i class="bi bi-cart-check fs-2" style="vertical-align: middle;"></i>
                    </a>
                    <button type="button" aria-label="Menu" class="btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#mobileMenu">
                        <i class="bi bi-filter-right fs-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Menu Modal -->
    <div id="mobileMenu" class="modal fade" tabindex="-1" aria-labelledby="mobileMenuLabel" aria-hidden="true" style="z-index:99999">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: #000 !important">
                <header class="d-flex justify-content-between align-items-center p-3">
                    <a href="/">
                        @if (isset($data['social']->logo))
                            <img src="{{ asset('products/' . $data['social']->logo) }}" alt="Logo" class="img-fluid" style="max-width: 120px;">
                        @else
                            <span class="navbar-brand text-white">HD Produtora</span>
                        @endif
                    </a>
                    <button type="button" class="btn btn-link text-white" data-bs-dismiss="modal" aria-label="Fechar">
                        <i class="bi bi-x-circle fs-2"></i>
                    </button>
                </header>
                <div class="modal-body">
                    <div class="container">
                        <nav class="nav flex-column">
                            <a class="nav-link text-white fs-5" href="/"><i class="bi bi-house me-2"></i>Início</a>
                            @if (env('AFILIADOS'))
                                <a class="nav-link text-white fs-5" href="{{ route('afiliado.home') }}"><i class="bi bi-people-fill me-2"></i>Área de Afiliados</a>
                            @endif
                            <a class="nav-link text-white fs-5" href="/sorteios"><i class="bi bi-card-list me-2"></i>Sorteios</a>
                            <a class="nav-link text-white fs-5" href="#" data-bs-toggle="modal" data-bs-target="#consultar-reservas"><i class="bi bi-search me-2"></i>Meus números</a>
                            <a class="nav-link text-white fs-5" href="{{ route('ganhadores') }}"><i class="bi bi-trophy-fill me-2"></i>Ganhadores</a>
                            <a class="nav-link text-white fs-5" href="{{ route('politica') }}"><i class="bi bi-shield-check me-2"></i>Política de Privacidade</a>
                            <a href="/login" class="btn btn-primary w-100 rounded-pill mt-4"><i class="bi bi-box-arrow-in-right me-2"></i>Entrar</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Consultar Reservas Modal -->
    <div class="modal fade" id="consultar-reservas" tabindex="-1" aria-labelledby="consultarReservasLabel" aria-hidden="true" style="z-index: 9999999;">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultarReservasLabel">Consultar Reservas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('minhasReservas') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="telephone" class="form-label">O seu número de telemóvel (com DDD)</label>
                            <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="(XX) XXXXX-XXXX" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Script para máscara de telefone --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.getElementById('telephone');
            if(phoneInput) {
                phoneInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    e.target.value = value.slice(0, 15);
                });
            }
        });
    </script>
</body>
</html>

