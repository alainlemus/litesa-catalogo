<div>
    @php
        use App\Support\Media;

        $services = collect($page->services ?? []);
        $images = [
            'importaci' => 'uploads/barco.webp',
            'iluminaci' => 'uploads/lamparas.webp',
            'confiter' => null,
        ];
        $imageFor = function (string $title) use ($images) {
            $t = mb_strtolower($title, 'UTF-8');
            foreach ($images as $needle => $path) {
                if (str_contains($t, $needle)) return $path ? Media::url($path) : null;
            }
            return null;
        };

        $values = $settings->values ?? [];
        $steps = $settings->steps ?? [];
        $sectors = $settings->sectors ?? [];
        $reasons = collect($settings->reasons ?? [])->pluck('text')->filter()->all();
    @endphp

    @section('title', $settings->meta_title ?: 'Servicios | Grupo Litesa')
    @section('meta_description', $settings->meta_description)
    @section('og_image', Media::url('uploads/barco.webp') ?? '')

    <x-page-header eyebrow="Servicios" :title="$settings->hero_title" :subtitle="$settings->hero_subtitle" :crumbs="['Servicios' => null]">
        <div class="flex flex-wrap gap-4 mt-8">
            <a href="{{ route('contact') }}" class="btn-lumen">Solicitar cotización</a>
            <a href="#servicios" class="btn-ghost">Ver servicios</a>
        </div>
    </x-page-header>

    {{-- ============ VALORES ============ --}}
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container px-6 mx-auto">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($values as $value)
                    <div style="--i: {{ $loop->index }}" class="reveal spotlight card-lift p-7 bg-gray-50 border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10">
                        <span class="inline-flex p-3 text-white shadow-lg rounded-2xl bg-gradient-to-br from-brand to-blue-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ \App\Support\Icons::path($value['icon'] ?? null) }}"/></svg>
                        </span>
                        <h2 class="mt-5 text-lg font-bold text-ink-900 dark:text-white">{{ $value['title'] }}</h2>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ SERVICIOS EN DETALLE ============ --}}
    <section id="servicios" class="py-24 bg-gray-100 dark:bg-gray-950 lg:py-28">
        <div class="container px-6 mx-auto">
            <div class="max-w-2xl reveal">
                <p class="eyebrow">Lo que hacemos</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Nuestros servicios</h2>
            </div>

            <div class="mt-16 space-y-24">
                @foreach ($services as $service)
                    @php $img = $imageFor($service['title']); @endphp
                    <article class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
                        <div class="relative reveal {{ $loop->even ? 'lg:order-2' : '' }}">
                            <div class="absolute hidden rounded-[2rem] -inset-3 bg-gradient-to-br from-brand/30 to-lumen/30 blur-2xl lg:block" aria-hidden="true"></div>
                            @if ($img)
                                <img src="{{ $img }}" alt="{{ $service['title'] }}" class="img-reveal relative object-cover w-full shadow-2xl rounded-[2rem] aspect-[4/3]" loading="lazy" decoding="async" width="720" height="540">
                            @else
                                <div class="relative flex items-center justify-center w-full overflow-hidden text-white shadow-2xl rounded-[2rem] aspect-[4/3] bg-gradient-to-br from-ink-800 via-brand to-ink-950">
                                    <div class="absolute rounded-full size-72 -top-20 -right-10 bg-lumen/30 blur-3xl" aria-hidden="true"></div>
                                    <span class="relative p-8 rounded-[2rem] bg-white/10 backdrop-blur [&_svg]:!w-20 [&_svg]:!h-20 text-lumen">{!! $service['svg'] !!}</span>
                                </div>
                            @endif
                            <span class="absolute px-5 py-2 text-sm font-bold text-white border shadow-xl -top-4 -left-2 rounded-2xl bg-ink-900 border-white/10">0{{ $loop->iteration }}</span>
                        </div>

                        <div class="reveal" style="--i: 2">
                            <span class="inline-flex p-3.5 rounded-2xl bg-brand/10 text-brand dark:bg-lumen/15 dark:text-lumen [&_svg]:!w-7 [&_svg]:!h-7">{!! $service['svg'] !!}</span>
                            <h3 class="mt-5 text-3xl font-bold capitalize display text-ink-900 dark:text-white">{{ $service['title'] }}</h3>
                            <p class="mt-4 text-lg leading-relaxed text-gray-600 dark:text-gray-300">{{ $service['description'] }}</p>
                            <div class="flex flex-wrap gap-4 mt-8">
                                @if ($service['url'])
                                    <a href="{{ route($service['url']) }}" class="btn-lumen">Conocer más <span aria-hidden="true">&rarr;</span></a>
                                @endif
                                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 font-semibold transition-colors border rounded-full text-ink-900 border-gray-300 hover:border-brand hover:text-brand dark:text-white dark:border-white/20 dark:hover:border-lumen dark:hover:text-lumen">Solicitar informes</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ PROCESO ============ --}}
    <section class="relative py-24 overflow-hidden text-white bg-ink-950 lg:py-28">
        <div class="absolute rounded-full -top-40 -left-40 size-[36rem] bg-brand/25 blur-3xl" aria-hidden="true"></div>
        <div class="container relative px-6 mx-auto">
            <div class="max-w-2xl reveal">
                <p class="eyebrow eyebrow-light">Cómo trabajamos</p>
                <h2 class="mt-5 text-3xl display md:text-5xl">Un proceso claro, en cuatro pasos</h2>
            </div>

            <ol class="grid gap-5 mt-14 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($steps as $step)
                    <li style="--i: {{ $loop->index }}" class="reveal spotlight relative p-7 border rounded-3xl bg-white/[0.04] border-white/10">
                        <span class="text-6xl font-extrabold leading-none text-transparent display bg-clip-text bg-gradient-to-b from-lumen to-lumen/10">{{ $loop->iteration }}</span>
                        <h3 class="mt-4 text-lg font-bold">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-white/70">{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============ SECTORES ============ --}}
    <section class="py-24 bg-white dark:bg-gray-900 lg:py-28">
        <div class="container px-6 mx-auto">
            <div class="max-w-2xl reveal">
                <p class="eyebrow">A quién servimos</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Sectores que atendemos</h2>
            </div>
            <div class="grid gap-5 mt-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($sectors as $sector)
                    <div style="--i: {{ $loop->index }}" class="reveal card-lift group flex flex-col p-7 bg-gray-50 border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10">
                        <span class="inline-flex self-start p-3 transition-transform duration-500 rounded-2xl bg-brand/10 text-brand dark:bg-lumen/15 dark:text-lumen group-hover:scale-110 group-hover:-rotate-6">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ \App\Support\Icons::path($sector['icon'] ?? null) }}"/></svg>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-ink-900 dark:text-white">{{ $sector['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600 dark:text-gray-300">{{ $sector['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ POR QUÉ LITESA ============ --}}
    <section class="py-24 bg-gray-100 dark:bg-gray-950 lg:py-28">
        <div class="container grid items-center gap-14 px-6 mx-auto lg:grid-cols-2">
            <div class="reveal">
                <p class="eyebrow">Por qué elegirnos</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Un aliado que entiende tu negocio</h2>
                <ul class="mt-8 space-y-4">
                    @foreach ($reasons as $reason)
                        <li class="flex items-start gap-3 text-lg text-gray-700 dark:text-gray-300">
                            <span class="grid mt-1 rounded-full size-6 shrink-0 place-items-center bg-lumen text-ink-950">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            {{ $reason }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('about') }}" class="mt-8 btn-lumen">Conoce más sobre nosotros</a>
            </div>
            <div class="relative reveal" style="--i: 2">
                <div class="absolute -inset-3 rounded-[2rem] bg-gradient-to-br from-brand/30 to-lumen/30 blur-2xl" aria-hidden="true"></div>
                <img src="{{ Media::url('uploads/grua.webp') }}" alt="Operación logística con contenedores" class="img-reveal relative object-cover w-full shadow-2xl rounded-[2rem] aspect-[4/3]" loading="lazy" decoding="async" width="720" height="540">
            </div>
        </div>
    </section>

    {{-- ============ FAQ ============ --}}
    @if ($faqTeaser->isNotEmpty())
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="container max-w-3xl px-6 mx-auto">
            <div class="text-center reveal">
                <p class="justify-center eyebrow">Preguntas frecuentes</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Antes de empezar</h2>
            </div>
            <div class="mt-10 space-y-4">
                @foreach ($faqTeaser as $faq)
                    <details style="--i: {{ $loop->index }}" class="reveal group p-6 bg-gray-50 border border-gray-200 rounded-2xl open:bg-white open:shadow-lg dark:bg-ink-900 dark:border-white/10 dark:open:bg-ink-800 transition-colors">
                        <summary class="flex items-center justify-between gap-4 text-lg font-bold list-none cursor-pointer text-ink-900 dark:text-white [&::-webkit-details-marker]:hidden">
                            {{ $faq->question }}
                            <span class="grid transition-transform duration-300 rounded-full size-8 shrink-0 place-items-center bg-brand/10 text-brand dark:bg-lumen/15 dark:text-lumen group-open:rotate-45" aria-hidden="true">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                            </span>
                        </summary>
                        <p class="mt-4 leading-relaxed text-gray-600 dark:text-gray-300">{{ $faq->answer }}</p>
                    </details>
                @endforeach
            </div>
            <p class="mt-8 text-center reveal"><a href="{{ route('faq') }}" class="font-semibold text-brand dark:text-lumen link-anim">Ver todas las preguntas frecuentes &rarr;</a></p>
        </div>
    </section>
    @endif

    <x-cta-band :title="$settings->cta_title" :text="$settings->cta_text" />
</div>
