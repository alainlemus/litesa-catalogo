<div>
    @php
        use App\Support\Media;
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;
        $breadcrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Iluminación', 'item' => route('ilumination')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Aplicaciones', 'item' => route('ilumination.applications')],
        ]];
    @endphp

    @section('title', 'Iluminación por aplicación: hogar, hotel y más')
    @section('meta_description', 'Encuentra la iluminación LED ideal según el espacio: residencia, escuela, hotel, restaurante, centro comercial y alumbrado público.')
    @push('head')<script type="application/ld+json">{!! json_encode($breadcrumb, $jsonFlags) !!}</script>@endpush

    <x-page-header eyebrow="Iluminación" title="Iluminación por aplicación" subtitle="Elige el espacio y descubre los productos pensados para él." :crumbs="['Iluminación' => route('ilumination'), 'Aplicaciones' => null]" />

    <section class="py-20 bg-gray-100 dark:bg-gray-950">
        <div class="container grid gap-6 px-6 mx-auto sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($uses as $use)
                @php $photo = $use->image ? (object) ['path' => $use->image] : $use->products->first()?->photos->first(); @endphp
                <a href="{{ route('ilumination.application', $use->slug) }}" style="--i: {{ $loop->index % 3 }}" class="reveal spotlight card-lift group relative flex items-center gap-5 p-6 overflow-hidden bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10 focus-visible:ring-2 focus-visible:ring-brand">
                    <div class="flex items-center justify-center overflow-hidden size-24 shrink-0 rounded-2xl bg-gray-50 dark:bg-white">
                        @if ($photo)
                            <img src="{{ Media::url($photo->path) }}" alt="" aria-hidden="true" class="object-contain w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy" decoding="async" width="96" height="96">
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-ink-900 dark:text-white">{{ $use->name }}</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $use->products_count }} {{ $use->products_count === 1 ? 'producto' : 'productos' }}</p>
                        <span class="inline-block mt-3 text-sm font-semibold transition-all text-brand dark:text-lumen group-hover:translate-x-1">Ver productos &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <x-cta-band title="¿No encuentras lo que buscas?" text="Cuéntanos tu proyecto y te ayudamos a elegir la iluminación correcta." />
</div>
