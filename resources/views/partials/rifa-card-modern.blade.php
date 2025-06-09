<div class="card bg-card-dark border-secondary h-100 card-rifa-modern">
    <a href="{{ route('product', ['slug' => $product->slug]) }}" class="text-decoration-none">
        <div class="card-img-container">
            <img src="{{ asset('products/' . ($product->imagem()->name ?? 'default.png')) }}" class="card-img-top" alt="{{ $product->name }}">
            <span class="badge bg-primary status-badge">{{ $product->status }}</span>
        </div>
        <div class="card-body text-light">
            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
            <p class="card-text text-muted small mb-3">{{ $product->subname }}</p>
            
            {{-- Barra de Progresso --}}
            @if($product->totalNumbers() > 0)
                <div class="progress-info d-flex justify-content-between mb-1 small">
                    <span class="fw-bold">{{ number_format($product->percent(), 0) }}% vendido</span>
                    <span class="text-muted">{{ $product->soldNumbers() }}/{{ $product->totalNumbers() }}</span>
                </div>
                <div class="progress" role="progressbar" aria-valuenow="{{ $product->percent() }}" aria-valuemin="0" aria-valuemax="100" style="height: 8px;">
                    <div class="progress-bar" style="width: {{ $product->percent() }}%"></div>
                </div>
            @endif
        </div>
        <div class="card-footer bg-transparent border-secondary p-3">
             <div class="d-grid">
                @if($product->status == 'Finalizado')
                    <button class="btn btn-outline-secondary" disabled>Ver Resultado</button>
                @else
                    <button class="btn btn-primary">Participar por R$ {{ number_format($product->price, 2, ',', '.') }}</button>
                @endif
             </div>
        </div>
    </a>
</div>

