@extends('layouts.app')

@section('title', 'Concorra a Prémios Incríveis')

@section('content')
<div class="container py-5">

    {{-- SECÇÃO DE TÍTULO --}}
    <div class="hero-section text-center mb-5">
        <h1 class="display-5 fw-bold text-light">Concorra a Prémios <br><span class="text-primary">Incríveis</span></h1>
        <p class="lead text-muted mt-3">
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
    <div class="tab-content mt-4" id="rifasTabContent">
        {{-- ABA DE RIFAS ATIVAS --}}
        <div class="tab-pane fade show active" id="ativas-tab-pane" role="tabpanel" aria-labelledby="ativas-tab" tabindex="0">
            <div class="row g-4">
                {{-- A lógica @forelse verifica se há rifas. Se não houver, mostra a secção @empty --}}
                @forelse ($products->where('status', 'Ativo') as $product)
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

