@extends('layouts.layout')
@section('title', 'Página no encontrada')
@section('content')

    <section class="bg-white dark:bg-gray-900 ">
        <div class="container min-h-screen px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
            <div class="wf-ull lg:w-1/2">
                <p class="text-sm font-medium text-blue-500 dark:text-blue-400">Error 404</p>
                <h1 class="mt-3 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">Pagina no encontrada</h1>
                <p class="mt-4 text-gray-500 dark:text-gray-400">La pagina que estas buscando no existe. Aqui hay unos links de ayuda:</p>

                <div class="flex items-center mt-6 gap-x-3">
                    <a href="{{ url()->previous() }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:rotate-180">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>


                        <span>Regresar</span>
                    </a>

                    <a href="{{ route("home") }}" class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        Llevame a inicio
                    </a>
                </div>
            </div>

            <div class="relative w-full mt-12 lg:w-1/2 lg:mt-0">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-full max-w-lg lg:mx-auto" viewBox="0 0 514 164" fill="none"><script xmlns=""/><script xmlns=""/>
                    <circle cx="101" cy="22" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="101" cy="142" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="21" cy="102" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="141" cy="102" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="193" cy="82" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="313" cy="82" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="253" cy="22" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="253" cy="142" r="20" stroke="#667085" stroke-width="2"/>
                    <path d="M1 102C1 90.9543 9.9543 82 21 82H141C152.046 82 161 90.9543 161 102C161 113.046 152.046 122 141 122H21C9.9543 122 1 113.046 1 102Z" stroke="#667085" stroke-width="2"/>
                    <path d="M101 162C89.9543 162 81 153.046 81 142L81 22C81 10.9543 89.9543 2 101 2C112.046 2 121 10.9543 121 22L121 142C121 153.046 112.046 162 101 162Z" stroke="#667085" stroke-width="2"/>
                    <path d="M7.14214 115.995C-0.668351 108.184 -0.668351 95.5211 7.14214 87.7106L86.7107 8.1421C94.5212 0.331614 107.184 0.331607 114.995 8.14209C122.805 15.9526 122.805 28.6159 114.995 36.4264L35.4264 115.995C27.6159 123.805 14.9526 123.805 7.14214 115.995Z" stroke="#667085" stroke-width="2"/>
                    <circle cx="453" cy="22" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="453" cy="142" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="373" cy="102" r="20" stroke="#667085" stroke-width="2"/>
                    <circle cx="493" cy="102" r="20" stroke="#667085" stroke-width="2"/>
                    <path d="M353 102C353 90.9543 361.954 82 373 82H493C504.046 82 513 90.9543 513 102C513 113.046 504.046 122 493 122H373C361.954 122 353 113.046 353 102Z" stroke="#667085" stroke-width="2"/>
                    <path d="M453 162C441.954 162 433 153.046 433 142L433 22C433 10.9543 441.954 2 453 2C464.046 2 473 10.9543 473 22L473 142C473 153.046 464.046 162 453 162Z" stroke="#667085" stroke-width="2"/>
                    <path d="M359.142 115.995C351.332 108.184 351.332 95.5211 359.142 87.7106L438.711 8.1421C446.521 0.331614 459.184 0.331607 466.995 8.14209C474.805 15.9526 474.805 28.6159 466.995 36.4264L387.426 115.995C379.616 123.805 366.953 123.805 359.142 115.995Z" stroke="#667085" stroke-width="2"/>
                    <circle cx="253" cy="82" r="80" stroke="#667085" stroke-width="2"/>
                    <circle cx="253" cy="82" r="40" stroke="#667085" stroke-width="2"/>
                    <line x1="8.74228e-08" y1="1" x2="513" y2="1.00004" stroke="#667085" stroke-width="2"/>
                    <line x1="-8.74228e-08" y1="163" x2="513" y2="163" stroke="#667085" stroke-width="2"/>
                    <script xmlns=""/><script xmlns=""/></svg>
            </div>
        </div>
    </section>
@endsection
