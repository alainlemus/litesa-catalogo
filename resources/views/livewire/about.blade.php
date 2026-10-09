<div>
    @php
        use App\Support\Media;

        $inline = fn ($html) => strip_tags((string) $html, '<span><br><strong><em>');
        $pillars = [
            ['svg' => $page->about_svg, 'title' => $page->about_title, 'text' => $page->about_description],
            ['svg' => $page->mission_svg, 'title' => $page->mission_title, 'text' => $page->mission_description],
            ['svg' => $page->vision_svg, 'title' => $page->vision_title, 'text' => $page->vision_description],
        ];
    @endphp

    @section('title', $page->meta_title ?: 'Nosotros - Empresa 100% mexicana | Grupo Litesa')
    @section('meta_description', $page->meta_description ?: 'Conoce a Grupo Litesa: importadores y comercializadores con alianzas estratégicas con las mejores marcas del mundo. Misión, visión y valores.')
    @section('og_image', Media::url($page->section2_image) ?? '')

    <x-page-header eyebrow="Nosotros" title="Quiénes somos" subtitle="Una empresa 100% mexicana que comercializa bienes y servicios para mejorar la calidad de vida de los consumidores." :crumbs="['Nosotros' => null]" />

    <section class="py-24 bg-white dark:bg-gray-900 lg:py-32">
        <div class="container grid items-center gap-16 px-6 mx-auto lg:grid-cols-2">
            @if ($page->section2_image)
                <div class="relative reveal">
                    <div class="absolute hidden rounded-[2rem] -inset-4 bg-gradient-to-br from-brand/30 to-lumen/30 blur-2xl lg:block" aria-hidden="true"></div>
                    <img src="{{ Media::url($page->section2_image) }}" alt="{{ strip_tags($page->section2_text) }}" class="img-reveal relative object-cover w-full shadow-2xl rounded-[2rem] aspect-[4/5] lg:aspect-[5/6]" loading="lazy" decoding="async" width="720" height="864">
                    <div class="absolute px-5 py-4 text-sm font-semibold text-white border shadow-2xl -bottom-5 -right-3 lg:-right-6 rounded-2xl bg-ink-900 border-white/10">
                        <span class="block text-xs tracking-widest uppercase text-lumen">Alianzas estratégicas</span>
                        con las mejores marcas del mundo
                    </div>
                </div>
            @endif
            <div class="reveal" style="--i: 2">
                <p class="eyebrow">Nuestra historia</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white [&_p]:inline [&_span]:!text-brand dark:[&_span]:!text-lumen">{!! $inline($page->section2_text) !!}</h2>
                <div class="mt-6 text-lg leading-relaxed text-gray-600 dark:text-gray-300 [&_p]:mb-4">{!! $page->section3_text !!}</div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-100 dark:bg-gray-950 lg:py-28">
        <div class="container px-6 mx-auto">
            <div class="max-w-2xl reveal">
                <p class="eyebrow">Lo que nos mueve</p>
                <h2 class="mt-5 text-3xl display md:text-5xl text-ink-900 dark:text-white">Nosotros, misión y visión</h2>
            </div>
            <div class="grid gap-6 mt-14 md:grid-cols-3">
                @foreach ($pillars as $pillar)
                    <article style="--i: {{ $loop->index }}" class="reveal spotlight card-lift relative p-8 overflow-hidden bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10">
                        <span class="absolute leading-none text-gray-100 select-none text-8xl font-extrabold right-6 top-4 dark:text-white/5" aria-hidden="true">0{{ $loop->iteration }}</span>
                        <div class="tilt relative inline-flex p-3.5 text-white shadow-lg bg-gradient-to-br from-brand to-blue-500 rounded-2xl">{!! $pillar['svg'] !!}</div>
                        <h3 class="relative mt-6 text-xl font-bold text-ink-900 dark:text-white">{{ $pillar['title'] }}</h3>
                        <p class="relative mt-3 leading-relaxed text-gray-600 dark:text-gray-300">{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-band title="Construyamos algo juntos" />
</div>
