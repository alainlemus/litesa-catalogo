<div>
    @php
        use App\Support\Media;

        $ilumDescription = 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.';
        $heroUrl = Media::url($lighting->header_image);
    @endphp

    @section('title', 'Iluminación LED para hogar e industria - Grupo Litesa')
    @section('meta_description', $ilumDescription)
    @section('og_image', Media::url($heroImage?->path) ?? Media::url('uploads/iluminacion.webp'))

    @if ($heroUrl)
        @push('head')
            <link rel="preload" as="image" href="{{ $heroUrl }}" fetchpriority="high">
        @endpush
    @endif

    {{-- ============ HERO ============ --}}
    <section data-glow class="relative flex items-end overflow-hidden text-white bg-ink-950 min-h-[34rem] lg:min-h-[44rem]">
        @if ($heroUrl)
            <img src="{{ $heroUrl }}" alt="Iluminación Grupo Litesa" class="absolute inset-0 object-cover w-full h-full hero-img" fetchpriority="high" decoding="async" width="1920" height="1080">
        @endif
        <div class="absolute inset-0 hero-shade" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="container relative px-6 pt-24 pb-16 mx-auto seq">
            <p class="eyebrow eyebrow-light">Iluminación</p>
            <h1 data-split class="max-w-4xl mt-5 text-5xl display lg:text-7xl">{{ $lighting->section1_title }}</h1>
            <p class="max-w-2xl mt-6 text-lg text-white/80">{{ $lighting->section1_description }}</p>
            <div class="flex flex-wrap gap-4 mt-8">
                <a href="{{ route('ilumination.catalog') }}" class="btn-lumen">Ver catálogo <span aria-hidden="true">&rarr;</span></a>
                <a href="{{ route('ilumination.applications') }}" class="btn-ghost">Explorar por aplicación</a>
            </div>
        </div>
    </section>

    {{-- ============ CARACTERÍSTICAS ============ --}}
    @if (!empty($lighting->section1_items) || $firstImage?->path)
        <section class="py-24 bg-white dark:bg-gray-900">
            <div class="container grid items-center gap-14 px-6 mx-auto lg:grid-cols-2">
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($lighting->section1_items ?? [] as $item)
                        <div style="--i: {{ $loop->index % 2 }}" class="reveal spotlight card-lift flex items-center gap-4 p-5 bg-gray-50 border border-gray-200 rounded-2xl dark:bg-gray-800/60 dark:border-white/10 text-ink-900 dark:text-gray-100">
                            <span class="flex items-center justify-center p-2.5 text-white shrink-0 rounded-xl bg-gradient-to-br from-brand to-blue-500 [&_svg]:size-6">{!! $item['svg'] !!}</span>
                            <span class="font-semibold">{{ $item['text'] }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($firstImage?->path)
                    <div class="relative reveal">
                        <div class="absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-brand/30 to-lumen/30 blur-2xl" aria-hidden="true"></div>
                        <img class="img-reveal relative object-cover w-full shadow-2xl rounded-[2rem] aspect-[4/3]" src="{{ Media::url($firstImage->path) }}" alt="{{ $lighting->section1_title }}" loading="lazy" decoding="async" width="672" height="504">
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ============ TECNOLOGÍA ============ --}}
    <section class="relative py-24 overflow-hidden text-white bg-ink-950 lg:py-32">
        <div class="absolute rounded-full -left-40 top-10 size-[36rem] bg-brand/25 blur-3xl" aria-hidden="true"></div>
        <div class="container relative grid items-center gap-14 px-6 mx-auto lg:grid-cols-2">
            @if ($secondImage?->path)
                <img class="img-reveal object-cover w-full max-w-md mx-auto shadow-2xl rounded-[2rem] aspect-[3/4] lg:order-2" src="{{ Media::url($secondImage->path) }}" alt="{{ $lighting->section2_title }}" loading="lazy" decoding="async" width="416" height="576">
            @endif
            <div class="reveal">
                <p class="eyebrow eyebrow-light">Innovación</p>
                <h2 class="mt-5 text-4xl display lg:text-6xl">{{ $lighting->section2_title }}</h2>
                <p class="mt-6 text-lg leading-relaxed text-white/75">{{ $lighting->section2_description }}</p>
                <a href="{{ $lighting->section2_url ? route($lighting->section2_url) : route('ilumination.catalog') }}" class="mt-8 btn-lumen">Ver catálogo <span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </section>

    {{-- ============ NOVEDADES ============ --}}
    <section class="py-24 bg-gray-100 dark:bg-gray-950">
        <div class="container px-6 mx-auto">
            <div class="flex flex-wrap items-end justify-between gap-4 reveal">
                <div>
                    <p class="eyebrow">Novedades</p>
                    <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Lo último en productos</h2>
                </div>
                <a href="{{ route('ilumination.catalog') }}" class="inline-flex items-center gap-2 font-semibold transition-all text-brand dark:text-lumen hover:gap-3">Ver catálogo completo <span aria-hidden="true">&rarr;</span></a>
            </div>

            <div class="grid gap-6 mt-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($newProducts as $product)
                    <a href="{{ route('product.show', $product->slug) }}" style="--i: {{ $loop->index }}" class="reveal spotlight card-lift group relative flex flex-col p-6 overflow-hidden bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10">
                        <div style="view-transition-name: product-{{ $product->id }}; view-transition-class: vt-shared" class="tilt flex items-center justify-center overflow-hidden aspect-square rounded-2xl bg-gray-50 dark:bg-white">
                            <img src="{{ Media::url($product->photos->first()?->path) }}" alt="{{ $product->name }}" class="object-contain w-4/5 h-4/5 transition-transform duration-500 group-hover:scale-110" loading="lazy" decoding="async" width="176" height="176">
                        </div>
                        <h3 class="mt-5 font-bold tracking-wide text-center uppercase text-ink-900 dark:text-white">{{ $product->name }}</h3>
                        <span class="mt-3 text-sm font-semibold text-center transition-all text-brand dark:text-lumen group-hover:tracking-wider">Ver producto &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ DISTRIBUIDORES ============ --}}
    @if ($lighting->section3_images)
        <section class="py-24 bg-white dark:bg-gray-900">
            <div class="container px-6 mx-auto">
                <div class="max-w-2xl mx-auto text-center reveal">
                    <p class="justify-center eyebrow">Marcas</p>
                    <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Distribuidores oficiales</h2>
                </div>

                <div class="grid items-center grid-cols-2 gap-6 mt-14 md:grid-cols-3">
                    @foreach ($lighting->section3_images as $image)
                        @if ($image)
                            <div style="--i: {{ $loop->index % 3 }}" class="reveal flex items-center justify-center p-8 bg-gray-50 border border-gray-200 h-32 rounded-2xl dark:bg-white dark:border-transparent">
                                <img class="object-contain w-auto h-full max-h-16 grayscale opacity-70 transition duration-300 hover:grayscale-0 hover:opacity-100" src="{{ Media::url($image) }}" alt="Logo de distribuidor oficial {{ $loop->iteration }}" loading="lazy" decoding="async" height="64">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
