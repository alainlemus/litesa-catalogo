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

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
                                <button aria-label="Cambiar tema claro/oscuro" onclick="toggleTheme()" class="text-gray-700 transition-colors dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-600">
                                    <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
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
        @yield('content')
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

                <div class="flex flex-wrap justify-center mt-6 -mx-4">
                    <a href="{{ route('home') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Nosotros </a>

                    <a href="{{ route('ilumination') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Iluminación </a>

                    <a href="{{ route('blog') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Blog </a>

                    <a href="{{ route('contact') }}" class="mx-4 text-sm text-gray-600 transition-colors duration-300 hover:text-blue-500 dark:text-gray-300 dark:hover:text-blue-400" aria-label="Reddit"> Contacto </a>
                </div>

            </div>

            <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700" />

            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <div class="flex justify-center">
                    <p class="text-sm text-gray-500 dark:text-gray-300">© Copyright {{ date("Y") }}. Todos los derechos reservados.</p>
                    <a href="{{ route('privacy.policy') }}" class="pl-6 text-sm text-gray-600 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400">
                        Aviso de Privacidad
                    </a>
                </div>


                <div class="flex -mx-2">

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


</body>
</html>