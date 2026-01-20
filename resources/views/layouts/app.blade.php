<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Título por defecto')</title>

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta name="description" content="@yield('meta_description', 'Descripción por defecto')">
    <meta property="og:title" content="@yield('og_title', 'Título OG por defecto')">
    <meta property="og:description" content="@yield('og_description', 'Descripción OG por defecto')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('default-og-image.jpg'))">

    <!-- Twitter (X) Cards -->
    <meta name="twitter:card" content="@yield('twitter_card')">
    <meta name="twitter:title" content="@yield('twitter_title')">
    <meta name="twitter:description" content="@yield('twitter_description')">
    <meta name="twitter:image" content="@yield('twitter_image')">
    <meta name="twitter:site" content="@yield('twitter_site')">
    <meta name="twitter:creator" content="@yield('twitter_creator')">

    @stack('head')

    @if ($setting = \App\Models\SiteSetting::first())
        <link rel="icon" type="image/x-icon" href="{{ Storage::disk('public')->url($setting->favicon ?? 'default-favicon.ico') }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ request()->getHost().'/storage/site/01JYMZNT38344XSXY924RVBCTS.png'}}">
    @endif

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script rel="preconnect" defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

</head>
<body class="flex flex-col w-full min-h-screen font-sans transition-colors duration-300 bg-gray-100">

    <header class="sticky top-0 z-20">
        <nav x-data="{ isOpen: false }" class="transition-colors duration-300 bg-white shadow dark:bg-gray-900">
            <div class="container px-6 py-4 mx-auto">

                <div class="lg:flex lg:items-center lg:justify-between">

                    <div class="flex items-center justify-between">

                        <div class="flex items-center justify-center space-x-4 lg:hidden lg:py-0">
                            <button aria-label="Cambiar tema claro/oscuro" onclick="toggleTheme()" class="text-gray-700 transition-colors dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600">
                                <svg id="theme-icon2" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <!-- Icono dinámico por JS -->
                                </svg>
                            </button>
                        </div>

                        <a href="{{ route('home') }}" class="mx-auto transition-opacity duration-300">
                            @if ($setting = \App\Models\SiteSetting::first())
                                <img
                                    src="{{ Storage::disk('public')->url($setting->logo_light) }}"
                                    alt="{{ $setting->title }} logo"
                                    class="block h-10 dark:hidden"
                                >
                                <img
                                    src="{{ Storage::disk('public')->url($setting->logo_dark) }}"
                                    alt="{{ $setting->title }} logo"
                                    class="hidden h-10 dark:block"
                                >
                            @endif
                        </a>

                        <!-- Mobile menu button -->
                        <div class="flex lg:hidden">
                           <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                                </svg>

                                <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                    <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white shadow-md lg:bg-transparent lg:dark:bg-transparent lg:shadow-none dark:bg-gray-900 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:w-auto lg:opacity-100 lg:translate-x-0">


                        @php

                            function activeClass($routes) {
                                $routes = (array) $routes; // Asegura que sea un array
                                foreach ($routes as $route) {
                                    if (request()->routeIs($route)) {
                                        return 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-600';
                                    }
                                }
                                return '';
                            }

                        @endphp

                        <div class="-mx-4 lg:flex lg:items-center">
                            <a href="{{ route('home') }}"
                            class="block mx-4 capitalize dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600 {{ activeClass('home') }}">
                                Nosotros
                            </a>
                            <a href="{{ route('ilumination') }}"
                            class="block mx-4 mt-4 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600 {{ activeClass(['ilumination', 'ilumination.*']) }}">
                                Iluminación
                            </a>
                            <a href="{{ route('blog') }}"
                            class="block mx-4 mt-4 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600 {{ activeClass(['blog', 'blog.*']) }}">
                                Blog
                            </a>
                            <a href="{{ route('contact') }}"
                            class="block mx-4 mt-4 capitalize lg:mt-0 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600 {{ activeClass('contact') }}">
                                Contacto
                            </a>

                            <div class="items-center justify-center hidden py-10 space-x-4 lg:flex lg:py-0">
                                <button aria-label="Cambiar tema claro/oscuro" onclick="toggleTheme()" class="text-gray-700 transition-colors cursor-pointer dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600">
                                    <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="white" stroke="currentColor"
                                        viewBox="0 0 24 24" stroke-width="2">
                                        <!-- Icono dinámico por JS -->
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <div class="flex-grow">
        {{ $slot }}
    </div>

    <!-- Footer -->
    <footer class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-8 mx-auto">
            <div class="flex flex-col items-center text-center">
                <a href="{{ route('home') }}">
                    @if ($setting = \App\Models\SiteSetting::first())
                                <img
                            src="{{ Storage::disk('public')->url($setting->logo_light) }}"
                            alt="{{ $setting->title }} logo"
                            class="block h-7 dark:hidden"
                        >
                        <img
                            src="{{ Storage::disk('public')->url($setting->logo_dark) }}"
                            alt="{{ $setting->title }} logo"
                            class="hidden h-7 dark:block"
                        >
                    @endif
                </a>

                @livewire('newsletter-form')

                <div class="flex flex-wrap justify-center pt-4 mt-6 -mx-4">
                    <a href="{{ route('home') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Nosotros </a>

                    <a href="{{ route('ilumination') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Iluminación </a>

                    <a href="{{ route('blog') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Blog </a>

                    <a href="{{ route('contact') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Contacto </a>
                </div>

            </div>

            <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700" />

            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <div class="flex justify-center flex-col lg:flex-row">
                    <p class="text-sm text-gray-500 dark:text-gray-300">© Copyright {{ date("Y") }}. Todos los derechos reservados.</p>
                    <a href="{{ route('privacy.policy') }}" class="lg:pt-0 pt-4 pl-0 lg:pl-6 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400">
                        Aviso de Privacidad
                    </a>
                </div>


                <div class="flex -mx-2 lg:pt-0 pt-12">

                    @php
                        $siteSetting = \App\Models\SiteSetting::first();
                        $socialNetworks = $siteSetting?->socials ?? [];
                    @endphp
                    @foreach ($socialNetworks as $network)
                        <a href="{{ $network['url'] }}" target="_blank"
                            class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400"
                            aria-label="{{ $network['name'] }}">
                            {!! $network['svg'] !!}
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </footer>

    @livewireScripts

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            const icon2 = document.getElementById('theme-icon2');

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                icon.innerHTML = sunIcon;
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                icon.innerHTML = moonIcon;
            }
        }

        const sunIcon = `<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8-9h1M3 12H2m16.364-6.364l.707.707M4.929 19.071l.707.707M16.364 19.071l.707-.707M4.929 4.929l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />`;
        const moonIcon = `<path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />`;

        // Al cargar, actualizamos el icono
        document.addEventListener('DOMContentLoaded', () => {
            const icon = document.getElementById('theme-icon');
            const icon2 = document.getElementById('theme-icon2');
            if (localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                icon.innerHTML = moonIcon;
                icon2.innerHTML = moonIcon;
            } else {
                icon.innerHTML = sunIcon;
                icon2.innerHTML = sunIcon;
            }
        });
    </script>

    @php
        $siteSetting = \App\Models\SiteSetting::first();
        $whatsapp = $siteSetting?->whatsapp;
    @endphp
    @if ($whatsapp)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Me gustaria recibir información de sus servicios" target="_blank" aria-label="WhatsApp"
        class="overflow-hidden fixed z-50 bottom-6 right-6 flex items-center w-14 h-14 rounded-full shadow-lg bg-[#25D366] hover:bg-[#1ebe57] transition-all duration-300 group px-0 hover:w-62"
        style="box-shadow: 0 4px 16px 0 rgba(37,211,102,0.3);">
            <span class="flex items-center justify-center w-14 h-14 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="w-6 h-6 mx-auto transition-all duration-300">
                    <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.62-.47-.16-.01-.36-.01-.56-.01-.19 0-.5.07-.76.34-.26.27-1 1-.98 2.43.02 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                </svg>
            </span>
            <span class="mr-4 text-white whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-sm font-semibold select-none">
                ¿Te ayudo por WhatsApp?
            </span>
        </a>
    @endif

</body>
</html>
