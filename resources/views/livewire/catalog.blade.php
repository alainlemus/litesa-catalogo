<div class="bg-transparent dark:bg-gray-900">
    @php
        use App\Support\Media;

        $catalogDescription = 'Catálogo de iluminación LED de Grupo Litesa: lámparas y luminarias de alta calidad para hogar, comercio e industria. Consulta especificaciones y variantes.';
        $itemList = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Catálogo de iluminación',
            'url' => route('ilumination.catalog'),
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $products->values()->map(fn ($product, $i) => [
                    '@type' => 'ListItem',
                    'position' => $products->firstItem() + $i,
                    'url' => route('product.show', $product->slug),
                    'name' => $product->name,
                ])->all(),
            ],
        ];
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Iluminación', 'item' => route('ilumination')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Catálogo', 'item' => route('ilumination.catalog')],
            ],
        ];
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;
    @endphp

    @section('title', 'Catálogo de iluminación LED - Grupo Litesa' . ($products->currentPage() > 1 ? ' (página ' . $products->currentPage() . ')' : ''))
    @section('meta_description', $catalogDescription)
    @section('og_image', Media::url('uploads/iluminacion.webp'))

    @push('head')
        <script type="application/ld+json">{!! json_encode($itemList, $jsonFlags) !!}</script>
        <script type="application/ld+json">{!! json_encode($breadcrumb, $jsonFlags) !!}</script>
    @endpush

    <header data-glow class="relative overflow-hidden text-white bg-ink-950">
        <div class="absolute rounded-full -top-32 -right-20 size-[28rem] bg-brand/40 blur-3xl" aria-hidden="true"></div>
        <div class="absolute rounded-full -bottom-40 left-10 size-[24rem] bg-lumen/15 blur-3xl" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="container relative px-6 py-16 mx-auto lg:py-20 seq">
            <p class="eyebrow eyebrow-light">Catálogo</p>
            <h1 data-split class="mt-5 text-4xl display lg:text-6xl">Catálogo de productos</h1>
            <p class="max-w-2xl mt-4 text-lg text-white/75">
                Descubre nuestra amplia gama de productos de iluminación LED
                <span class="sr-only" role="status" aria-live="polite">{{ $products->total() }} productos encontrados</span>
            </p>
        </div>
    </header>

    {{-- Barra de búsqueda y filtros --}}
    <div class="sticky z-10 w-full bg-white/95 backdrop-blur shadow top-[var(--header-h)] dark:bg-gray-800/95">
        <div class="container flex flex-col gap-3 px-4 py-3 mx-auto">

            <form role="search" wire:submit.prevent class="flex flex-col w-full gap-2 md:flex-row">
                <div class="relative w-full md:w-2/3">
                    <label for="catalog-search" class="sr-only">Buscar producto</label>
                    <input id="catalog-search" wire:model.live.debounce.300ms="search" type="search" placeholder="Buscar producto..."
                        class="w-full py-2 pl-4 pr-10 text-gray-900 bg-white border border-gray-300 rounded-md dark:bg-gray-900 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute w-5 h-5 text-gray-400 pointer-events-none right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>
                </div>
                <div class="w-full md:w-1/3">
                    <label for="catalog-category" class="sr-only">Categoría</label>
                    <select id="catalog-category" wire:model.live="selectedCategory"
                        class="w-full px-2 py-2 text-gray-900 bg-white border border-gray-300 rounded-md cursor-pointer dark:bg-gray-900 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $id => $category)
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="flex flex-wrap items-center gap-2" role="group" aria-label="Filtrar por uso">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">Filtrar por uso:</p>
                @foreach ($places as $id => $place)
                    <button type="button" wire:key="use-{{ $id }}" wire:click="$set('selectedUse', {{ $selectedUse == $id ? 'null' : $id }})"
                        aria-pressed="{{ $selectedUse == $id ? 'true' : 'false' }}"
                        class="btn-press px-3 py-1 text-sm rounded-full border transition-colors duration-200 cursor-pointer
                            {{ $selectedUse == $id
                                ? 'bg-brand border-brand text-white'
                                : 'bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 border-gray-300 dark:border-gray-600 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400' }}">
                        {{ $place }}
                    </button>
                @endforeach

                @if ($selectedUse || $selectedCategory || $search)
                    <button type="button" wire:click="clearFilters"
                        class="btn-press px-3 py-1 text-sm text-red-600 border border-red-300 rounded-full cursor-pointer hover:bg-red-50 dark:hover:bg-red-950 dark:text-red-400 dark:border-red-800">
                        Limpiar filtros
                    </button>
                @endif
            </div>
        </div>
    </div>

    <main class="container relative px-6 pt-12 pb-20 mx-auto bg-transparent">
        <div wire:loading.class="is-loading" wire:target="search,selectedUse,selectedCategory,gotoPage,nextPage,previousPage"
            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 transition-opacity">
            @forelse ($products as $product)
                <a wire:key="product-{{ $product->id }}" href="{{ route('product.show', $product->slug) }}" style="--i: {{ $loop->index % 6 }}"
                    class="pop-in spotlight card-lift group relative flex flex-col items-center w-full p-6 overflow-hidden bg-white border border-gray-200 cursor-pointer dark:bg-ink-900 rounded-3xl dark:border-white/10 focus-visible:ring-2 focus-visible:ring-blue-500">
                    <div style="view-transition-name: product-{{ $product->id }}; view-transition-class: vt-shared"
                        class="tilt flex items-center justify-center mb-4 overflow-hidden border border-gray-100 w-44 h-44 bg-gray-50 dark:bg-white rounded-2xl dark:border-transparent">
                        @if ($product->photos->isNotEmpty())
                            <img src="{{ Media::url($product->photos->first()->path) }}" alt="{{ $product->name }}"
                                class="object-contain w-full h-full transition-transform duration-500 group-hover:scale-110"
                                @if ($loop->index < 3) fetchpriority="high" @else loading="lazy" @endif
                                decoding="async" width="176" height="176">
                        @else
                            <span class="text-sm text-gray-500">Sin imagen</span>
                        @endif
                    </div>

                    <h2 class="mb-2 text-lg font-extrabold tracking-wide text-center text-gray-900 uppercase dark:text-white">{{ $product->name }}</h2>

                    <div class="flex flex-wrap justify-center w-full gap-2 pt-2 text-sm">
                        @foreach (array_filter([$product->certification, $product->base, $product->power_factor]) as $badge)
                            <span class="px-2 py-0.5 text-gray-700 border border-gray-300 rounded dark:text-gray-200 dark:border-gray-600">{{ $badge }}</span>
                        @endforeach
                        @if ($product->warranty)
                            <span class="px-2 py-0.5 font-medium text-yellow-900 bg-yellow-300 rounded-full">Garantía {{ $product->warranty }}</span>
                        @endif
                    </div>

                    <span class="absolute px-3 py-1 text-xs font-semibold text-white transition-all duration-300 translate-y-1 bg-blue-600 rounded-full shadow-lg opacity-0 top-4 right-4 group-hover:opacity-100 group-hover:translate-y-0 group-focus-visible:opacity-100">Ver más</span>
                </a>
            @empty
                <div class="py-16 text-center col-span-full">
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">No encontramos productos con esos filtros.</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Prueba con otra búsqueda o limpia los filtros.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </main>
</div>
