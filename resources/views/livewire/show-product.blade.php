<div class="bg-transparent dark:bg-gray-900">

    @php
        use App\Support\Media;
        use Illuminate\Support\Str;

        // Productos con el mismo nombre: se distinguen por categoría para no duplicar título/descripcion
        $duplicated = \App\Models\Product::where('name', $product->name)->count() > 1;
        $displayName = $duplicated ? $product->name . ' (' . ($product->category?->name ?? 'ref. ' . $product->id) . ')' : $product->name;
        $plainDescription = $product->meta_description ?: ($product->description
            ? Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($product->description))), 155)
            : 'Conoce ' . $displayName . ', luminaria de Grupo Litesa. Consulta especificaciones, variantes y solicita informes.');
        $productImages = $product->photos->map(fn ($photo) => Media::url($photo->path))->filter()->values();
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;

        $productSchema = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $plainDescription,
            'image' => $productImages->all() ?: null,
            'url' => route('product.show', $product->slug),
            'category' => $product->category?->name,
            'brand' => ['@type' => 'Brand', 'name' => $site?->title ?? 'Grupo Litesa'],
            'additionalProperty' => collect([
                'Garantía' => $product->warranty,
                'Factor de potencia' => $product->power_factor,
                'Certificación' => $product->certification,
                'Base' => $product->base,
            ])->filter()->map(fn ($value, $name) => ['@type' => 'PropertyValue', 'name' => $name, 'value' => $value])->values()->all() ?: null,
        ]);
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Catálogo', 'item' => route('ilumination.catalog')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $product->name, 'item' => route('product.show', $product->slug)],
            ],
        ];
    @endphp

    @section('title', $product->meta_title ?: \App\Support\Seo::title($displayName . ' - Iluminación LED'))
    @section('meta_description', $plainDescription)
    @section('og_type', 'product')
    @section('og_image', $productImages->first() ?? Media::url('uploads/iluminacion.webp'))

    @push('head')
        <script type="application/ld+json">{!! json_encode($productSchema, $jsonFlags) !!}</script>
        <script type="application/ld+json">{!! json_encode($breadcrumb, $jsonFlags) !!}</script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    @endpush

    {{-- Encabezado con breadcrumb --}}
    <div class="relative overflow-hidden text-white bg-ink-950">
        <div class="absolute rounded-full -top-32 -right-20 size-[26rem] bg-brand/40 blur-3xl" aria-hidden="true"></div>
        <div class="absolute rounded-full -bottom-44 left-10 size-[22rem] bg-lumen/15 blur-3xl" aria-hidden="true"></div>
        <nav aria-label="Breadcrumb" class="container relative px-6 py-5 mx-auto overflow-x-auto whitespace-nowrap">
            <ol class="flex items-center text-sm text-white/70">
                <li><a href="{{ route('home') }}" class="hover:text-lumen">Inicio</a></li>
                <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                <li><a href="{{ route('ilumination.catalog') }}" class="hover:text-lumen">Catálogo</a></li>
                @if ($product->category)
                    <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                    <li>{{ $product->category->name }}</li>
                @endif
                <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                <li aria-current="page" class="font-semibold text-white truncate">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container px-6 py-12 mx-auto lg:py-16">
        <div class="grid gap-10 lg:grid-cols-2 lg:gap-16">

            {{-- Galería --}}
            <div class="lg:sticky lg:top-28 lg:self-start reveal">
                <div class="relative">
                    <div class="absolute -inset-3 rounded-[2.5rem] bg-gradient-to-br from-brand/25 to-lumen/25 blur-2xl" aria-hidden="true"></div>
                    <div class="relative overflow-hidden bg-white shadow-2xl rounded-[2rem] ring-1 ring-black/5"
                        style="view-transition-name: product-{{ $product->id }}; view-transition-class: vt-shared">
                        <div class="swiper product-gallery zoom-follow aspect-square" aria-label="Fotos de {{ $product->name }}">
                            <div class="swiper-wrapper">
                                @forelse ($product->photos as $photo)
                                    <div class="flex items-center justify-center p-8 swiper-slide">
                                        <img src="{{ Media::url($photo->path) }}" alt="{{ $product->name }}{{ $product->photos->count() > 1 ? ' - foto ' . $loop->iteration : '' }}"
                                            class="object-contain w-full h-full"
                                            @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                                            decoding="async" width="640" height="640">
                                    </div>
                                @empty
                                    <div class="flex items-center justify-center text-gray-500 swiper-slide">Sin imagen</div>
                                @endforelse
                            </div>
                            @if ($product->photos->count() > 1)
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next" aria-label="Siguiente foto"></div>
                                <div class="swiper-button-prev" aria-label="Foto anterior"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Información --}}
            <div class="reveal" style="--i: 2">
                @if ($product->category)
                    <p class="eyebrow">{{ $product->category->name }}</p>
                @endif
                <h1 data-split class="mt-4 text-4xl uppercase display lg:text-6xl text-ink-900 dark:text-white">{{ $product->name }}</h1>

                @php
                    $specs = array_filter([
                        'Garantía' => $product->warranty,
                        'Factor de potencia' => $product->power_factor,
                        'Certificación' => $product->certification,
                        'Base' => $product->base,
                    ]);
                @endphp
                @if ($specs)
                    <dl class="grid grid-cols-2 gap-3 mt-8 sm:grid-cols-4">
                        @foreach ($specs as $label => $value)
                            <div class="p-4 bg-white border border-gray-200 rounded-2xl dark:bg-ink-900 dark:border-white/10">
                                <dt class="text-xs font-semibold tracking-widest text-gray-500 uppercase dark:text-gray-400">{{ $label }}</dt>
                                <dd class="mt-1 text-lg font-bold text-brand dark:text-lumen">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                @endif

                @if ($product->description)
                    <div class="mt-8 prose max-w-none text-gray-700 dark:prose-invert dark:text-gray-300">
                        {!! $product->description !!}
                    </div>
                @endif

                @if ($product->uses->isNotEmpty())
                    <div class="mt-8">
                        <h2 class="text-sm font-semibold tracking-widest text-gray-500 uppercase dark:text-gray-400">Ideal para</h2>
                        <ul class="flex flex-wrap gap-2 mt-3">
                            @foreach ($product->uses as $use)
                                <li>
                                    <a href="{{ route('ilumination.application', $use->slug) }}" class="inline-flex items-center gap-2 px-4 py-1.5 text-sm font-medium transition-colors border rounded-full bg-brand/10 text-brand border-brand/20 hover:bg-brand hover:text-white dark:bg-lumen/10 dark:text-lumen dark:border-lumen/20 dark:hover:bg-lumen dark:hover:text-ink-950">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        {{ $use->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex flex-wrap items-center gap-4 pt-8 mt-10 border-t border-gray-200 dark:border-white/10">
                    @if ($whatsapp)
                        <a href="https://wa.me/52{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text={{ urlencode('Hola, quiero más información sobre el producto: ' . $product->name . ($product->warranty ? ' | Garantía: ' . $product->warranty : '')) }}"
                            target="_blank" rel="noopener noreferrer" class="btn-lumen">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true"><path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10z"/></svg>
                            Informes por WhatsApp
                        </a>
                    @endif
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 font-semibold transition-colors border rounded-full text-ink-900 border-gray-300 hover:border-brand hover:text-brand dark:text-white dark:border-white/20 dark:hover:border-lumen dark:hover:text-lumen">Solicitar cotización</a>
                </div>

                <div class="mt-8">
                    <x-share-bar :title="'Mira este producto: ' . $product->name" />
                </div>
            </div>
        </div>

        {{-- Variantes --}}
        @if ($product->variants->isNotEmpty())
            <section class="mt-20 reveal" aria-labelledby="variantes-title">
                <p class="eyebrow">Ficha técnica</p>
                <h2 id="variantes-title" class="mt-4 text-3xl display md:text-4xl text-ink-900 dark:text-white">Variantes</h2>

                <div class="mt-8 overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-3xl dark:bg-ink-900 dark:border-white/10">
                    <table class="w-full text-sm text-left">
                        <caption class="sr-only">Variantes de {{ $product->name }}</caption>
                        <thead class="text-white bg-gradient-to-r from-brand to-ink-800">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-semibold">ID</th>
                                <th scope="col" class="px-5 py-4 font-semibold text-center">Tamaño</th>
                                <th scope="col" class="px-5 py-4 font-semibold text-center">Potencia</th>
                                <th scope="col" class="px-5 py-4 font-semibold text-center">Lúmenes</th>
                                <th scope="col" class="px-5 py-4 font-semibold text-center">Voltaje</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/10">
                            @foreach ($product->variants as $variant)
                                <tr class="transition-colors hover:bg-brand/5 dark:hover:bg-white/5 text-gray-800 dark:text-gray-200">
                                    <td class="px-5 py-4 font-semibold text-brand dark:text-lumen">{{ $variant->variant_id }}</td>
                                    <td class="px-5 py-4 text-center">{{ $variant->size }}</td>
                                    <td class="px-5 py-4 font-semibold text-center">{{ $variant->power }}</td>
                                    <td class="px-5 py-4 text-center">{{ $variant->lumen }}</td>
                                    <td class="px-5 py-4 text-center">{{ $variant->voltage }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        @if ($similares->isNotEmpty())
            <section class="pt-20 reveal" aria-labelledby="similares-title">
                <p class="eyebrow">Te puede interesar</p>
                <h2 id="similares-title" class="mt-4 mb-8 text-3xl display md:text-4xl text-ink-900 dark:text-white">Productos similares</h2>
                <div class="flex gap-4 pb-4 overflow-x-auto snap-x snap-mandatory lg:grid lg:grid-cols-4 lg:overflow-visible">
                    @foreach ($similares as $similar)
                        <a href="{{ route('product.show', $similar->slug) }}"
                            class="spotlight card-lift snap-start shrink-0 w-[70vw] sm:w-[45vw] lg:w-auto p-4 bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10 focus-visible:ring-2 focus-visible:ring-blue-500">
                            <div style="view-transition-name: product-{{ $similar->id }}; view-transition-class: vt-shared" class="mb-3 overflow-hidden rounded-2xl bg-gray-50 dark:bg-white">
                                <img src="{{ Media::url($similar->photos->first()?->path) }}" alt="{{ $similar->name }}" class="object-contain w-full h-32" loading="lazy" decoding="async" width="200" height="128">
                            </div>
                            <h3 class="font-bold text-center uppercase text-ink-900 text-md dark:text-white">{{ $similar->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const el = document.querySelector('.product-gallery');
                if (!el || typeof Swiper === 'undefined') return;
                const slides = el.querySelectorAll('.swiper-slide').length;
                new Swiper(el, {
                    loop: slides > 1,
                    keyboard: { enabled: true },
                    a11y: true,
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                });
            });
        </script>
    @endpush

</div>
