<div>
    @php
        use App\Support\Media;
        use Carbon\Carbon;

        $homeTitle = $seo?->share_title ?? 'Nosotros - Grupo Litesa';
        $homeDescription = $seo?->share_description ?? 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores.';
        $heroUrl = Media::url($page->hero_image);
        $services = collect($page->services ?? []);
        $pillars = [
            ['svg' => $page->about_svg, 'title' => $page->about_title, 'text' => $page->about_description],
            ['svg' => $page->mission_svg, 'title' => $page->mission_title, 'text' => $page->mission_description],
            ['svg' => $page->vision_svg, 'title' => $page->vision_title, 'text' => $page->vision_description],
        ];
        $inline = fn ($html) => strip_tags((string) $html, '<span><br><strong><em>');
        $contactCards = [
            ['title' => 'Email', 'hint' => 'Estamos para ayudarle.', 'icon' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75'],
            ['title' => 'Oficina', 'hint' => 'Visítanos en', 'icon' => 'M15 10.5a3 3 0 11-6 0 3 3 0 016 0zM19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z'],
            ['title' => 'Teléfono', 'hint' => $site?->contact_hours, 'icon' => 'M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z'],
        ];
    @endphp

    @section('title', $homeTitle)
    @section('meta_description', $homeDescription)
    @section('og_image', Media::url($seo?->share_image ?? 'uploads/navio.webp'))

    @if ($heroUrl)
        @push('head')
            <link rel="preload" as="image" href="{{ $heroUrl }}" fetchpriority="high">
        @endpush
    @endif

    {{-- ============ HERO ============ --}}
    <section data-glow class="relative flex items-end w-full overflow-hidden text-white bg-ink-950 min-h-[calc(100svh-var(--header-h))] max-h-[52rem]">
        @if ($heroUrl)
            <img src="{{ $heroUrl }}" alt="Grupo Litesa" class="absolute inset-0 object-cover w-full h-full hero-img" fetchpriority="high" decoding="async" width="1920" height="1080">
        @endif
        <div class="absolute inset-0 hero-shade" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>

        <div class="container relative px-6 pt-24 pb-20 mx-auto seq">
            <p class="eyebrow eyebrow-light">Grupo Litesa · 100% mexicana</p>

            <h1 data-split class="max-w-5xl mt-6 text-5xl display sm:text-6xl lg:text-7xl [&_span]:!text-lumen [&_p]:inline">
                {!! $inline($page->hero_text) !!}
            </h1>

            <p class="max-w-2xl mt-8 text-lg leading-relaxed text-white/80 line-clamp-4 sm:line-clamp-none">
                {!! $inline($page->section1_text) !!}
            </p>

            <div class="flex flex-wrap items-center gap-4 mt-10">
                <a href="{{ route('ilumination.catalog') }}" class="btn-lumen">
                    Ver catálogo
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6l6 6-6 6"/></svg>
                </a>
                <a href="{{ route('contact') }}" class="btn-ghost">Contáctanos</a>
            </div>
        </div>

        <a href="#nosotros" aria-label="Bajar al contenido" class="absolute hidden -translate-x-1/2 bottom-6 left-1/2 text-white/70 hover:text-white lg:block bounce-soft">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </a>
    </section>

    {{-- ============ CINTA DE SERVICIOS ============ --}}
    @if ($services->isNotEmpty())
        <div class="py-6 border-y bg-ink-900 border-white/10" aria-hidden="true">
            <div class="marquee">
                <div class="marquee-track">
                    @foreach ([1, 2] as $copy)
                        @foreach ($services as $service)
                            <span class="flex items-center gap-12 text-sm font-semibold tracking-[0.2em] uppercase whitespace-nowrap text-white/70">
                                {{ $service['title'] }}
                                <span class="w-2 h-2 rounded-full bg-lumen"></span>
                            </span>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- ============ NOSOTROS ============ --}}
    <section id="nosotros" class="py-24 bg-white dark:bg-gray-900 lg:py-32">
        <div class="container grid items-center gap-16 px-6 mx-auto lg:grid-cols-2">
            @if ($page->section2_image)
                <div class="relative reveal">
                    <div class="absolute hidden rounded-[2rem] -inset-4 bg-gradient-to-br from-brand/30 to-lumen/30 blur-2xl lg:block" aria-hidden="true"></div>
                    <img src="{{ Media::url($page->section2_image) }}" alt="{{ strip_tags($page->section2_text) }}"
                        class="img-reveal relative object-cover w-full shadow-2xl rounded-[2rem] aspect-[4/5] lg:aspect-[5/6]" loading="lazy" decoding="async" width="720" height="864">
                    <div class="absolute px-5 py-4 text-sm font-semibold text-white shadow-2xl -bottom-5 -right-3 lg:-right-6 rounded-2xl bg-ink-900 border border-white/10">
                        <span class="block text-xs tracking-widest uppercase text-lumen">Alianzas estratégicas</span>
                        con las mejores marcas del mundo
                    </div>
                </div>
            @endif

            <div class="reveal" style="--i: 2">
                <p class="eyebrow">Nosotros</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white [&_p]:inline [&_span]:!text-brand dark:[&_span]:!text-lumen">
                    {!! $inline($page->section2_text) !!}
                </h2>
                <div class="mt-6 text-lg leading-relaxed text-gray-600 dark:text-gray-300 [&_p]:mb-4">
                    {!! $page->section3_text !!}
                </div>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="{{ route('about') }}" class="btn-lumen">Conoce más sobre nosotros</a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 font-semibold transition-colors border rounded-full text-ink-900 border-gray-300 hover:border-brand hover:text-brand dark:text-white dark:border-white/20 dark:hover:border-lumen dark:hover:text-lumen">Hablemos de tu proyecto</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ SERVICIOS ============ --}}
    @if ($services->isNotEmpty())
        <section class="relative py-24 overflow-hidden text-white bg-ink-950 lg:py-32">
            <div class="absolute rounded-full -top-40 -right-40 size-[40rem] bg-brand/25 blur-3xl" aria-hidden="true"></div>
            <div class="absolute rounded-full -bottom-52 -left-32 size-[34rem] bg-lumen/10 blur-3xl" aria-hidden="true"></div>

            <div class="container relative px-6 mx-auto">
                <div class="max-w-2xl reveal">
                    <p class="eyebrow eyebrow-light">Servicios</p>
                    <h2 class="mt-5 text-3xl display md:text-5xl">Conoce nuestros <span class="text-lumen">servicios</span></h2>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 mt-6 font-semibold transition-all text-lumen hover:gap-3">Ver todos los servicios <span aria-hidden="true">&rarr;</span></a>
                </div>

                <div class="grid gap-5 mt-14 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($services as $service)
                        <article style="--i: {{ $loop->index % 3 }}" class="reveal spotlight group flex flex-col p-8 border rounded-3xl bg-white/[0.04] border-white/10 hover:border-lumen/40 transition-colors duration-300">
                            <span class="inline-flex self-start p-3.5 rounded-2xl bg-lumen/15 text-lumen transition-transform duration-500 group-hover:scale-110 group-hover:rotate-6">
                                {!! $service['svg'] !!}
                            </span>
                            <h3 class="mt-6 text-xl font-bold capitalize">{{ $service['title'] }}</h3>
                            <p class="flex-1 mt-3 leading-relaxed text-white/70">{{ $service['description'] }}</p>

                            @if ($service['url'])
                                <a href="{{ route($service['url']) }}" class="inline-flex items-center gap-2 mt-6 text-sm font-semibold transition-all text-lumen hover:gap-3">
                                    Ver más <span aria-hidden="true">&rarr;</span>
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ ILUMINACIÓN DESTACADA ============ --}}
    @if (count($featured))
        <section class="py-24 bg-gray-100 dark:bg-gray-950 lg:py-28">
            <div class="container px-6 mx-auto">
                <div class="flex flex-wrap items-end justify-between gap-4 reveal">
                    <div>
                        <p class="eyebrow">Iluminación</p>
                        <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Productos destacados</h2>
                    </div>
                    <a href="{{ route('ilumination.catalog') }}" class="inline-flex items-center gap-2 font-semibold transition-all text-brand dark:text-lumen hover:gap-3">Ver catálogo completo <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="grid gap-6 mt-12 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($featured as $product)
                        <x-product-card :product="$product" :index="$loop->index" />
                    @endforeach
                </div>

                @if (count($uses))
                    <div class="mt-14 reveal">
                        <p class="text-sm font-semibold tracking-widest text-gray-500 uppercase dark:text-gray-400">Explora por aplicación</p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach ($uses as $use)
                                <a href="{{ route('ilumination.application', $use->slug) }}" class="px-5 py-2 font-medium transition-colors bg-white border border-gray-300 rounded-full text-ink-900 hover:border-brand hover:text-brand dark:bg-ink-900 dark:text-gray-100 dark:border-white/15 dark:hover:border-lumen dark:hover:text-lumen">{{ $use->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ============ TESTIMONIOS ============ --}}
    @if ($testimonials->isNotEmpty())
        <section class="py-24 bg-white dark:bg-gray-900 lg:py-32">
            <div class="container px-6 mx-auto">
                <div class="max-w-3xl mx-auto text-center reveal">
                    <p class="justify-center eyebrow">Testimonios</p>
                    <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white [&_p]:inline [&_span]:!text-brand dark:[&_span]:!text-lumen">{!! $inline($page->testimonials_title) !!}</h2>
                    <p class="mt-5 text-lg text-gray-600 dark:text-gray-300">{{ $page->testimonials_description }}</p>
                </div>

                <div class="grid gap-6 mt-14 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($testimonials as $testimonio)
                        <figure style="--i: {{ $loop->index % 3 }}" class="reveal card-lift relative flex flex-col p-8 bg-gray-50 border border-gray-200 rounded-3xl dark:bg-gray-800/60 dark:border-white/10">
                            <svg class="absolute w-12 h-12 top-6 right-6 text-brand/15 dark:text-lumen/20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.17 6A5.17 5.17 0 004 11.17V18h6.83v-6.83H7.4A1.8 1.8 0 019.17 9.4V6zm9 0A5.17 5.17 0 0013 11.17V18h6.83v-6.83H16.4a1.8 1.8 0 011.77-1.77V6z"/></svg>
                            <blockquote class="relative flex-1 mt-8 leading-relaxed text-gray-700 dark:text-gray-300">{{ $testimonio->message }}</blockquote>
                            <figcaption class="flex items-center gap-4 mt-8">
                                @if ($testimonio->image)
                                    <img class="object-cover rounded-full size-14 ring-4 ring-white dark:ring-gray-700" src="{{ Media::url($testimonio->image) }}" alt="Foto de {{ $testimonio->name }}" loading="lazy" decoding="async" width="56" height="56">
                                @endif
                                <div>
                                    <p class="font-bold text-ink-900 dark:text-white">{{ $testimonio->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $testimonio->position }}</p>
                                </div>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ BLOG ============ --}}
    @if ($posts->isNotEmpty())
        <section class="py-24 bg-gray-100 dark:bg-gray-950 lg:py-28">
            <div class="container px-6 mx-auto">
                <div class="flex flex-wrap items-end justify-between gap-4 reveal">
                    <div>
                        <p class="eyebrow">Blog</p>
                        <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Entradas recientes</h2>
                    </div>
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 font-semibold text-brand dark:text-lumen hover:gap-3 transition-all">Ver todo el blog <span aria-hidden="true">&rarr;</span></a>
                </div>

                <div class="grid gap-6 mt-12 md:grid-cols-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" style="--i: {{ $loop->index }}" class="reveal card-lift group relative block overflow-hidden rounded-3xl aspect-[4/5] bg-ink-900">
                            @if ($post->image)
                                <img style="view-transition-name: post-{{ $post->id }}; view-transition-class: vt-shared" class="absolute inset-0 object-cover w-full h-full transition-transform duration-700 group-hover:scale-110"
                                    src="{{ Media::url($post->image) }}" alt="{{ $post->title }}" loading="lazy" decoding="async" width="400" height="500">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-ink-950 via-ink-950/40 to-transparent" aria-hidden="true"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                                <time datetime="{{ $post->created_at->toIso8601String() }}" class="text-xs font-semibold tracking-widest uppercase text-lumen">{{ Carbon::parse($post->created_at)->translatedFormat('d \d\e F, Y') }}</time>
                                <h3 class="mt-2 text-xl font-bold leading-snug">{{ $post->title }}</h3>
                                <p class="mt-2 text-sm text-white/70 line-clamp-2">{{ $post->excerpt }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============ CONTACTO ============ --}}
    <section class="relative py-24 overflow-hidden text-white bg-gradient-to-br from-brand via-ink-800 to-ink-950 lg:py-28">
        <div class="absolute rounded-full -top-24 right-1/4 size-96 bg-lumen/20 blur-3xl" aria-hidden="true"></div>
        <div class="container relative px-6 mx-auto">
            <div class="max-w-2xl mx-auto text-center reveal">
                <p class="justify-center eyebrow eyebrow-light">Medios de contacto</p>
                <h2 class="mt-5 text-3xl display md:text-5xl">Listos para escuchar tus requerimientos</h2>
                <p class="mt-4 text-lg text-white/75">Cuéntanos qué necesitas y te apoyamos.</p>
            </div>

            <div class="grid gap-5 mt-14 md:grid-cols-3">
                @foreach ($contactCards as $card)
                    <div style="--i: {{ $loop->index }}" class="reveal glass flex flex-col items-center p-8 text-center rounded-3xl transition-transform duration-300 hover:-translate-y-1">
                        <span class="p-3.5 rounded-2xl bg-lumen text-ink-950">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/></svg>
                        </span>
                        <h3 class="mt-5 text-lg font-bold">{{ $card['title'] }}</h3>
                        <p class="mt-1 text-sm text-white/70">{{ $card['hint'] }}</p>
                        @if ($card['title'] === 'Email')
                            <a href="mailto:{{ $site?->contact_email }}" class="mt-3 font-semibold break-all text-lumen hover:underline">{{ $site?->contact_email }}</a>
                        @elseif ($card['title'] === 'Oficina')
                            <address class="mt-3 not-italic font-semibold text-lumen">{{ $site?->contact_address }}</address>
                        @else
                            <a href="tel:{{ preg_replace('/[^+0-9]/', '', (string) $site?->contact_phone) }}" class="mt-3 font-semibold text-lumen hover:underline">{{ $site?->contact_phone }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
