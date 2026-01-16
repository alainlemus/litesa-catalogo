<div>

    @push('head')
        <link rel="preload" as="image" href="{{ App::environment('local')
            ? asset('storage/' . ltrim($page->section2_image, '/'))
            : Storage::disk('s3')->url($page->section2_image) }}"
            fetchpriority="high">
    @endpush

    @section('title', $seo?->share_title ?? 'Nosotros - Grupo Litesa')
    @section('meta_description', $seo?->share_description ?? 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores.')
    @section('og_title', $seo?->share_title ?? 'Nosotros - Grupo Litesa')
    @section('og_description', $seo?->share_description ?? 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores.')

    @section('og_image', App::environment('local')
        ? asset('storage/' . ltrim($seo?->share_image ?? 'uploads/navio.jpg', '/'))
        : Storage::disk('s3')->url($seo?->share_image ?? 'uploads/navio.jpg'))

    @php
        use Carbon\Carbon;
    @endphp

    @if ($page->hero_image)
        <div
            x-data="{ loaded: false }"
            x-init="setTimeout(() => loaded = true, 300)"
            :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
            class="w-full bg-center bg-cover h-[38rem] transition-all duration-700 ease-out opacity-0 scale-95"
            style="background-image: url('{{ App::environment('local')
                        ? asset('storage/' . ltrim($page->hero_image, '/'))
                        : Storage::disk('s3')->url($page->hero_image) }}')"
            aria-label="Grupo Litesa"
            ></div>
    @endif

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900 fade-in-up">
        <div class="container flex flex-col items-center px-4 py-12 mx-auto text-center">
            <h2 class="max-w-2xl mx-auto text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white fade-in-up">
                {!! $page->hero_text !!}
            </h2>
            <p class="max-w-4xl mt-6 text-center text-gray-500 dark:text-gray-300 fade-in-up">
                {!! $page->section1_text !!}
            </p>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-gray-100 dark:bg-gray-800 lg:py-12 lg:flex lg:justify-center fade-in-up">
        <div class="overflow-hidden transition-colors duration-300 bg-white dark:bg-gray-900 lg:mx-8 lg:flex lg:max-w-6xl lg:w-full lg:shadow-md lg:rounded-xl fade-in-up">
            <div class="lg:w-1/2 fade-in-up">
                @if ($page->section2_image)
                    <div class="h-64 bg-cover lg:h-full fade-in-up" style="background-image: url('{{ App::environment('local')
                        ? asset('storage/' . ltrim($page->section2_image, '/'))
                        : Storage::disk('s3')->url($page->section2_image) }}')" aria-label="Imagen de fondo {{ $page->section2_text }}">
                    </div>
                @endif
            </div>
            <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2 fade-in-up">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl fade-in-up">
                    {!! $page->section2_text !!}
                </h2>
                <p class="mt-4 text-gray-500 dark:text-gray-300 fade-in-up">
                    {!! $page->section3_text !!}
                </p>
                <div class="inline-flex w-full mt-6 sm:w-auto fade-in-up">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full px-6 py-2 text-sm text-white duration-300 bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80 fade-in-up">
                        Contactanos
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900 fade-in-up">
        <div class="container px-6 py-12 mx-auto fade-in-up">
            <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white fade-in-up">¿Quienes somos?</h1>
            <div class="grid grid-cols-1 gap-8 mt-8 lg:mt-16 md:grid-cols-2 xl:grid-cols-3 fade-in-up">
                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        {!! $page->about_svg !!}
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">{{ $page->about_title }}</h1>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            {{ $page->about_description }}
                        </p>
                    </div>
                </div>
                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        {!! $page->mission_svg !!}
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">{{ $page->mission_title }}</h1>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            {{ $page->mission_description }}
                        </p>
                    </div>
                </div>
                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        {!! $page->vision_svg !!}
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">{{ $page->vision_title }}</h1>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            {{ $page->vision_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900 fade-in-up">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">conoce nuestros <br> <span class="text-blue-500">Servicios</span></h1>

            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                {{-- Servicios --}}
                @foreach($page->services ?? [] as $service)
                    <div class="flex flex-col items-center p-6 space-y-3 text-center transition-colors duration-300 bg-gray-100 rounded-xl dark:bg-gray-800">
                        <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                            {!! $service['svg'] !!}
                        </span>

                        <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">{{ $service['title'] }}</h1>

                        <p class="text-gray-500 dark:text-gray-300">
                            {{ $service['description'] }}
                        </p>

                        <a href="{{ $service['url'] ? route($service['url']) : route('home') }}" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                            <span class="mx-1">ver más</span>
                            <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900 fade-in-up">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">
                {!! $page->testimonials_title !!}
            </h1>

            <p class="max-w-2xl mx-auto mt-6 text-center text-gray-500 dark:text-gray-300">
                {{ $page->testimonials_description }}
            </p>

            <section class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($testimonials as $testimonio)
                    <div class="p-8 border rounded-lg dark:border-gray-700">
                        <p class="leading-loose text-gray-500 dark:text-gray-400">
                            {{ $testimonio->message }}
                        </p>

                        <div class="flex items-center mt-8 -mx-2">
                            @if ($testimonio->image)
                                <img class="object-cover mx-2 rounded-full w-14 shrink-0 h-14 ring-4 ring-gray-300 dark:ring-gray-700" src="{{ App::environment('local')
                                ? asset('storage/' . ltrim($testimonio->image, '/'))
                                : Storage::disk('s3')->url($testimonio->image) }}" alt="{{ $testimonio->name }}">
                            @endif

                            <div class="mx-2">
                                <h1 class="font-semibold text-gray-800 dark:text-white">{{ $testimonio->name }}</h1>
                                <span class="text-sm text-gray-500">{{ $testimonio->position }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </section>

    <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Entradas recientes del blog</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">

                @foreach ($posts as $post)
                <a href="{{ route('blog.show', $post->slug) }}">
                    <div class="lg:flex">
                        @if ($post->image)
                            <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="{{ App::environment('local')
                                ? asset('storage/' . ltrim($post->image, '/'))
                                : Storage::disk('s3')->url($post->image) }}" alt="{{ $post->title }}">
                        @endif

                        <div class="flex flex-col justify-between py-6 lg:mx-6">

                            <h2 class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">{{ $post->title }}</h2>

                            <p>{{ $post->excerpt }}</p>

                            @php
                                $fechaFormateada = Carbon::parse($post->updated_at)
                                ->translatedFormat('d \d\e\l \m\e\s F \d\e\l Y');
                            @endphp

                            <span class="text-sm text-gray-500 dark:text-gray-300">Publicado: {{ $fechaFormateada }}</span>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900 fade-in-up">
        <div class="container px-6 py-12 mx-auto">
            <div class="text-center">
                <p class="font-medium text-blue-500 dark:text-blue-400">Medios de</p>

                <h1 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-white">Contacto</h1>

                <p class="mt-3 text-gray-500 dark:text-gray-400">Listos para escuchar su requerimientos y apoyarlos.</p>
            </div>

            @php
                $siteSetting = \App\Models\SiteSetting::first();
            @endphp

            <div class="grid grid-cols-1 gap-12 mt-10 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col items-center justify-center text-center">
                    <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>

                    <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Email</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Estamos para ayudarle.</p>
                    <p class="mt-2 text-blue-500 dark:text-blue-400">{{ $siteSetting->contact_email }}</p>
                </div>

                <div class="flex flex-col items-center justify-center text-center">
                    <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </span>

                    <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Oficina</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Visitanos en </p>
                    <p class="mt-2 text-blue-500 dark:text-blue-400">{{ $siteSetting->contact_address }}</p>
                </div>

                <div class="flex flex-col items-center justify-center text-center">
                    <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </span>

                    <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Teléfono</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">{{ $siteSetting->contact_hours }}</p>
                    <p class="mt-2 text-blue-500 dark:text-blue-400">{{ $siteSetting->contact_phone }}</p>
                </div>
            </div>
        </div>
    </section>

    <style>
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease-out forwards;
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: none;
        }
    }
    </style>

</div>
