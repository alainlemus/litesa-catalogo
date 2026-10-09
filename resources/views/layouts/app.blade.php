<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if ($storageHost = parse_url(\App\Support\Media::url('x') ?? '', PHP_URL_HOST))
        @if ($storageHost !== request()->getHost())
            <link rel="preconnect" href="https://{{ $storageHost }}" crossorigin>
        @endif
    @endif

    @include('layouts.partials.seo')

    @if ($site?->favicon)
        <link rel="icon" href="{{ \App\Support\Media::url($site->favicon) }}">
        <link rel="apple-touch-icon" href="{{ \App\Support\Media::url($site->favicon) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif

    @stack('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        try {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col w-full min-h-screen font-sans bg-gray-100 dark:bg-gray-900 transition-colors duration-300">

    <a href="#contenido" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-50 focus:px-4 focus:py-2 focus:rounded-lg focus:bg-blue-600 focus:text-white">
        Saltar al contenido
    </a>

    @php
        $navLinks = [
            ['label' => 'Inicio', 'route' => 'home', 'match' => ['home']],
            ['label' => 'Nosotros', 'route' => 'about', 'match' => ['about']],
            ['label' => 'Servicios', 'route' => 'services', 'match' => ['services']],
            ['label' => 'Iluminación', 'route' => 'ilumination', 'match' => ['ilumination', 'ilumination.*', 'product.*'], 'children' => [
                ['label' => 'Resumen', 'hint' => 'Soluciones de iluminación', 'route' => 'ilumination'],
                ['label' => 'Catálogo', 'hint' => 'Todos los productos', 'route' => 'ilumination.catalog'],
                ['label' => 'Por aplicación', 'hint' => 'Hogar, hotel, escuela y más', 'route' => 'ilumination.applications'],
            ]],
            ['label' => 'Blog', 'route' => 'blog', 'match' => ['blog', 'blog.*']],
            ['label' => 'Contacto', 'route' => 'contact', 'match' => ['contact']],
        ];
        $isActive = fn (array $patterns) => request()->routeIs(...$patterns);
        $themeIcons = <<<'SVG'
            <svg class="w-6 h-6 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/></svg>
            <svg class="hidden w-6 h-6 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8-9h1M3 12H2m16.364-6.364l.707.707M4.929 19.071l.707.707M16.364 19.071l.707-.707M4.929 4.929l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
        SVG;
    @endphp

    <header class="site-header sticky top-0 z-20" data-scrolled="false">
        <nav x-data="{ isOpen: false }" @keydown.escape.window="isOpen = false" aria-label="Principal"
            class="bg-white/90 backdrop-blur-md shadow-sm dark:bg-gray-900/90 transition-colors duration-300">
            <div class="container px-6 py-4 mx-auto">
                <div class="lg:flex lg:items-center lg:justify-between">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center lg:hidden">
                            <button type="button" data-theme-toggle aria-label="Cambiar tema claro/oscuro" aria-pressed="false"
                                class="p-1 text-gray-700 transition-colors cursor-pointer dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">
                                {!! $themeIcons !!}
                            </button>
                        </div>

                        <a href="{{ route('home') }}" class="mx-auto lg:mx-0" aria-label="{{ $site?->title }} - Inicio">
                            @if ($site?->logo_light)
                                <img src="{{ \App\Support\Media::url($site->logo_light) }}" alt="{{ $site->title }}" class="block dark:hidden" fetchpriority="high" decoding="async" width="71" height="40">
                                <img src="{{ \App\Support\Media::url($site->logo_dark) }}" alt="{{ $site->title }}" class="hidden dark:block" fetchpriority="high" decoding="async" width="71" height="40">
                            @endif
                        </a>

                        <div class="flex lg:hidden">
                            <button type="button" @click="isOpen = !isOpen" :aria-expanded="isOpen" aria-controls="menu-principal" aria-label="Abrir menú"
                                class="p-1 text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-white transition-colors cursor-pointer">
                                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                                </svg>
                                <svg x-show="isOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div id="menu-principal"
                        :class="isOpen ? 'is-open translate-x-0 opacity-100 visible' : 'opacity-0 -translate-x-full invisible lg:visible'"
                        class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white shadow-md lg:bg-transparent lg:dark:bg-transparent lg:shadow-none dark:bg-gray-900 lg:p-0 lg:relative lg:w-auto lg:opacity-100 lg:translate-x-0">

                        <div class="-mx-4 lg:flex lg:items-center lg:gap-2">
                            @foreach ($navLinks as $link)
                                @if (!empty($link['children']))
                                    <div class="relative mx-4 mt-4 lg:mt-0" x-data="{ sub: false }" @mouseenter="if (window.innerWidth >= 1024) sub = true" @mouseleave="if (window.innerWidth >= 1024) sub = false" @keydown.escape="sub = false" @click.outside="sub = false">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route($link['route']) }}" @if ($isActive($link['match'])) aria-current="page" @endif
                                                class="nav-link capitalize text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">{{ $link['label'] }}</a>
                                            <button type="button" @click="sub = !sub" :aria-expanded="sub" aria-label="Submenú de {{ $link['label'] }}" class="p-1 text-gray-500 cursor-pointer dark:text-gray-300 hover:text-blue-600">
                                                <svg class="w-4 h-4 transition-transform duration-300" :class="sub && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                            </button>
                                        </div>
                                        <div x-show="sub" x-cloak x-transition.origin.top.duration.200ms
                                            class="mt-3 lg:absolute lg:left-1/2 lg:-translate-x-1/2 lg:top-full lg:w-72 lg:p-2 lg:bg-white lg:dark:bg-ink-900 lg:rounded-2xl lg:shadow-2xl lg:ring-1 lg:ring-black/5 lg:dark:ring-white/10">
                                            @foreach ($link['children'] as $child)
                                                <a href="{{ route($child['route']) }}" @if (request()->routeIs($child['route'])) aria-current="page" @endif
                                                    class="block px-4 py-2.5 rounded-xl transition-colors hover:bg-brand/10 dark:hover:bg-white/5 aria-[current=page]:text-brand">
                                                    <span class="block font-semibold text-gray-800 dark:text-white">{{ $child['label'] }}</span>
                                                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ $child['hint'] }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route($link['route']) }}" @if ($isActive($link['match'])) aria-current="page" @endif
                                        class="nav-link block mx-4 mt-4 lg:mt-0 capitalize text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $link['label'] }}
                                    </a>
                                @endif
                            @endforeach

@php
                                $waNumber = preg_replace('/[^0-9]/', '', (string) $site?->whatsapp);
                                $phoneHref = preg_replace('/[^+0-9]/', '', (string) $site?->contact_phone);
                                $ctaHref = $waNumber ? 'https://wa.me/52' . $waNumber . '?text=' . urlencode('Hola, me gustaría recibir información.') : ($phoneHref ? 'tel:' . $phoneHref : route('contact'));
                            @endphp
                            <a href="{{ $ctaHref }}" @if ($waNumber) target="_blank" rel="noopener noreferrer" @endif
                                class="btn-press inline-flex items-center gap-2 mx-4 mt-4 lg:mt-0 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                Contáctanos
                            </a>

                            <div class="items-center justify-center hidden lg:flex">
                                <button type="button" data-theme-toggle aria-label="Cambiar tema claro/oscuro" aria-pressed="false"
                                    class="p-1 text-gray-700 transition-colors cursor-pointer dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400">
                                    {!! $themeIcons !!}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div id="contenido" class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </div>

    <footer class="relative overflow-hidden text-white bg-ink-950">
        <div class="absolute rounded-full -top-32 left-1/2 size-96 -translate-x-1/2 bg-brand/30 blur-3xl" aria-hidden="true"></div>
        <div class="container relative px-6 py-14 mx-auto">
            <div class="flex flex-col items-center text-center">
                <a href="{{ route('home') }}" aria-label="{{ $site?->title }} - Inicio">
                    @if ($site?->logo_light)
                        <img src="{{ \App\Support\Media::url($site->logo_dark) }}" alt="{{ $site->title }}" loading="lazy" decoding="async" width="71" height="40" class="h-12 w-auto">
                    @endif
                </a>

                @livewire('newsletter-form')

            </div>

            <nav aria-label="Pie de página" class="grid gap-10 pt-10 mt-10 text-left border-t border-white/10 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $footerCols = [
                        'Empresa' => [['Inicio', 'home'], ['Nosotros', 'about'], ['Servicios', 'services'], ['Contacto', 'contact']],
                        'Iluminación' => [['Resumen', 'ilumination'], ['Catálogo', 'ilumination.catalog'], ['Por aplicación', 'ilumination.applications']],
                        'Recursos' => [['Blog', 'blog'], ['Preguntas frecuentes', 'faq'], ['Aviso de privacidad', 'privacy.policy']],
                    ];
                @endphp
                @foreach ($footerCols as $title => $links)
                    <div>
                        <h2 class="text-sm font-semibold tracking-widest uppercase text-lumen">{{ $title }}</h2>
                        <ul class="mt-4 space-y-3">
                            @foreach ($links as [$label, $routeName])
                                <li><a href="{{ route($routeName) }}" class="text-white/70 transition-colors duration-300 hover:text-lumen">{{ $label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                <div>
                    <h2 class="text-sm font-semibold tracking-widest uppercase text-lumen">Contacto</h2>
                    <ul class="mt-4 space-y-3 text-white/70">
                        @if ($site?->contact_email)<li><a href="mailto:{{ $site->contact_email }}" class="break-all hover:text-lumen">{{ $site->contact_email }}</a></li>@endif
                        @if ($site?->contact_phone)<li><a href="tel:{{ preg_replace('/[^+0-9]/', '', $site->contact_phone) }}" class="hover:text-lumen">{{ $site->contact_phone }}</a></li>@endif
                        @if ($site?->contact_address)<li class="text-sm">{{ $site->contact_address }}</li>@endif
                    </ul>
                </div>
            </nav>

            <hr class="my-8 border-white/10 md:my-12" />

            <div class="flex flex-col items-center gap-6 sm:flex-row sm:justify-between">
                <div class="flex flex-col items-center gap-2 lg:flex-row lg:gap-6">
                    <p class="text-sm text-white/60">© {{ date('Y') }} {{ $site?->title }}. Todos los derechos reservados.</p>
                    <a href="{{ route('privacy.policy') }}" class="text-sm text-white/70 hover:text-lumen">Aviso de Privacidad</a>
                </div>

                <div class="flex gap-4">
                    @foreach ($site?->socials ?? [] as $network)
                        <a href="{{ $network['url'] }}" target="_blank" rel="noopener noreferrer me"
                            class="text-white/70 transition-all duration-300 hover:text-lumen hover:-translate-y-1"
                            aria-label="{{ $network['name'] }}">
                            {!! $network['svg'] !!}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </footer>

    @if ($whatsapp = $site?->whatsapp)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text={{ urlencode('Me gustaría recibir información de sus servicios') }}" target="_blank" rel="noopener noreferrer" aria-label="Escríbenos por WhatsApp"
            style="view-transition-name: wa-fab; box-shadow: 0 4px 16px 0 rgba(37,211,102,0.3);"
            class="group overflow-hidden fixed z-50 bottom-6 right-6 flex items-center w-14 h-14 rounded-full shadow-lg bg-[#25D366] hover:bg-[#1ebe57] transition-all duration-300 hover:w-60 focus-visible:w-60 active:scale-95">
            <span class="flex items-center justify-center w-14 h-14 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="w-6 h-6" aria-hidden="true">
                    <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.62-.47-.16-.01-.36-.01-.56-.01-.19 0-.5.07-.76.34-.26.27-1 1-.98 2.43.02 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                </svg>
            </span>
            <span class="mr-4 text-sm font-semibold text-white transition-opacity duration-300 opacity-0 select-none whitespace-nowrap group-hover:opacity-100 group-focus-visible:opacity-100">
                ¿Te ayudo por WhatsApp?
            </span>
        </a>
    @endif

    @livewireScripts
    @stack('scripts')
</body>
</html>
