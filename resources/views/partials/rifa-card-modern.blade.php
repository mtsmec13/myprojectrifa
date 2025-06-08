<a href="{{ route('product', ['slug' => $product->slug]) }}" class="text-decoration-none">
    <div class="card bg-dark text-white border-secondary shadow-sm h-100 card-rifa-modern">
        <img src="{{ asset('products/' . ($product->imagem?->name ?? 'default.png')) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title text-white">{{ $product->name }}</h5>
            <p class="card-text text-muted mb-2">{{ $product->subname }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <span>{!! $product->status() !!}</span>
                @if ($product->draw_date)
                    <small class="text-muted"><i class="bi bi-calendar-event"></i> {{ date('d/m/Y', strtotime($product->draw_date)) }}</small>
                @endif
            </div>
        </div>
        <div class="card-footer border-secondary text-center">
            Ver Sorteio
        </div>
    </div>
</a>

<style>
    .card-rifa-modern {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card-rifa-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }
    .card-rifa-modern .card-footer {
        background-color: #3b82f6;
        color: #fff;
        font-weight: 500;
        border-bottom-left-radius: var(--bs-card-inner-border-radius);
        border-bottom-right-radius: var(--bs-card-inner-border-radius);
    }
</style>

