@extends('layouts.app')

@section('title', 'Concorra a Prémios Incríveis')

@push('styles')
<style>
    /* Estilos para o novo layout */
    .hero-section {
        padding: 4rem 1rem;
        text-align: center;
    }
    .hero-section .display-5 {
        font-weight: 700;
        color: #fff;
    }
    .hero-section .display-5 span {
        color: #3b82f6; /* Azul para o destaque */
    }
    .hero-section .lead {
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        color: #a1a1aa; /* Cinza claro para o texto */
    }

    .nav-tabs {
        border-bottom: 1px solid #3f3f46; /* Borda da aba um pouco mais clara */
    }
    .nav-tabs .nav-link {
        border: none;
        color: #a1a1aa;
        padding: 0.8rem 1.2rem;
    }
    .nav-tabs .nav-link.active {
        background-color: transparent;
        border-bottom: 2px solid #3b82f6;
        color: #fff;
        font-weight: 500;
    }

    .tab-content {
        padding-top: 2rem;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        background-color: #27272a; /* Cor do card de "nenhuma rifa" */
        border-radius: 0.5rem;
        text-align: center;
        color: #a1a1aa;
    }
    .empty-state .icon {
        font-size: 3rem;
        color: #71717a;
        margin-bottom: 1rem;
    }
    .empty-state h5 {
        color: #fff;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    {{-- SECÇÃO DE TÍTULO --}}
    <div class="hero-section">
        <h1 class="display-5">Concorra a Prémios <br><span>Incríveis</span></h1>
        <p class="lead mt-3">
            Escolha a sua rifa favorita, selecione os seus números da sorte e participe. Boa sorte!
        </p>
    </div>

    {{-- SISTEMA DE ABAS --}}
    <ul class="nav nav-tabs justify-content-center" id="rifasTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ativas-tab" data-bs-toggle="tab" data-bs-target="#ativas-tab-pane" type="button" role="tab" aria-controls="ativas-tab-pane" aria-selected="true">
                Rifas Ativas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="finalizadas-tab" data-bs-toggle="tab" data-bs-target="#finalizadas-tab-pane" type="button" role="tab" aria-controls="finalizadas-tab-pane" aria-selected="false">
                Finalizadas
            </button>
        </li>
    </ul>

    {{-- CONTEÚDO DAS ABAS --}}
    <div class="tab-content" id="rifasTabContent">
        {{-- ABA DE RIFAS ATIVAS --}}
        <div class="tab-pane fade show active" id="ativas-tab-pane" role="tabpanel" aria-labelledby="ativas-tab" tabindex="0">
            <div class="row g-4">
                @forelse ($products->where('status', '!=', 'Finalizado') as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('partials.rifa-card-modern', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="icon"><i class="bi bi-gift-fill"></i></div>
                            <h5>Nenhuma Rifa Ativa</h5>
                            <p>Volte em breve para novas oportunidades!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ABA DE RIFAS FINALIZADAS --}}
        <div class="tab-pane fade" id="finalizadas-tab-pane" role="tabpanel" aria-labelledby="finalizadas-tab" tabindex="0">
            <div class="row g-4">
                @forelse ($products->where('status', 'Finalizado') as $product)
                     <div class="col-12 col-md-6 col-lg-4">
                        @include('partials.rifa-card-modern', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                         <div class="empty-state">
                            <div class="icon"><i class="bi bi-check-circle-fill"></i></div>
                            <h5>Nenhuma Rifa Finalizada</h5>
                            <p>Os resultados de sorteios anteriores aparecerão aqui.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

