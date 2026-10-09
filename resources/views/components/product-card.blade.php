@props(['product', 'index' => 0])

<a href="{{ route('product.show', $product->slug) }}" style="--i: {{ $index % 3 }}"
    class="pop-in spotlight card-lift group relative flex flex-col items-center w-full p-6 overflow-hidden bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10 focus-visible:ring-2 focus-visible:ring-brand">
    <div style="view-transition-name: product-{{ $product->id }}; view-transition-class: vt-shared"
        class="tilt flex items-center justify-center mb-4 overflow-hidden w-44 h-44 bg-gray-50 dark:bg-white rounded-2xl">
        @if ($product->photos->isNotEmpty())
            <img src="{{ \App\Support\Media::url($product->photos->first()->path) }}" alt="{{ $product->name }}" loading="lazy" decoding="async" width="176" height="176"
                class="object-contain w-full h-full transition-transform duration-500 group-hover:scale-110">
        @else
            <span class="text-sm text-gray-500">Sin imagen</span>
        @endif
    </div>
    <h3 class="mb-2 text-lg font-extrabold tracking-wide text-center uppercase text-ink-900 dark:text-white">{{ $product->name }}</h3>
    <div class="flex flex-wrap justify-center gap-2 pt-1 text-sm">
        @foreach (array_filter([$product->certification, $product->base]) as $badge)
            <span class="px-2 py-0.5 text-gray-700 border border-gray-300 rounded dark:text-gray-200 dark:border-gray-600">{{ $badge }}</span>
        @endforeach
        @if ($product->warranty)
            <span class="px-2 py-0.5 font-medium text-yellow-900 bg-yellow-300 rounded-full">Garantía {{ $product->warranty }}</span>
        @endif
    </div>
</a>
