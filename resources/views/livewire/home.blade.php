<div>

    @section('title', 'Nosotros - Grupo Litesa')
    @section('meta_description', 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores, a partir de entonces nos dedicamos a crear alianzas estratégicas con las mejores marcas del mundo respaldadas en sus productos.')
    @section('og_title', 'Nosotros - Grupo Litesa')
    @section('og_description', 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores, a partir de entonces nos dedicamos a crear alianzas estratégicas con las mejores marcas del mundo respaldadas en sus productos.')
    @section('og_image', App::environment('local') ? asset('uploads/' . ltrim('navio.jpg', '/')) : Storage::disk('s3')->url('uploads/navio.jpg'))

    @php
        use Carbon\Carbon;
    @endphp

    <div
        class="w-full bg-center bg-cover h-[38rem]"
        style="background-image: url('{{ App::environment('local')
                    ? asset('storage/' . ltrim($headerImage->path, '/'))
                    : Storage::disk('s3')->url($headerImage->path) }}')"
        aria-label="Imagen de fondo {{ $headerImage->name }}"
    ></div>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container flex flex-col items-center px-4 py-12 mx-auto text-center">
            <h2 class="max-w-2xl mx-auto text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                Especializados en abrir nuevos mercados te ayudamos a posicionar <span class="text-blue-500">tu marca.</span>
            </h2>

            <p class="max-w-4xl mt-6 text-center text-gray-500 dark:text-gray-300">
                Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios, mejorando la calidad de vida de los consumidores, a partir de entonces nos dedicamos a crear alianzas estratégicas con las mejores marcas del mundo respaldadas en sus productos.
            </p>

        </div>
    </section>

    <section class="transition-colors duration-300 bg-gray-100 dark:bg-gray-800 lg:py-12 lg:flex lg:justify-center">
        <div
            class="overflow-hidden transition-colors duration-300 bg-white dark:bg-gray-900 lg:mx-8 lg:flex lg:max-w-6xl lg:w-full lg:shadow-md lg:rounded-xl">
            <div class="lg:w-1/2">

                <div class="h-64 bg-cover lg:h-full" style="background-image: url('{{ App::environment('local')
                    ? asset('storage/' . ltrim($cardImage->path, '/'))
                    : Storage::disk('s3')->url($cardImage->path) }}')" aria-label="Imagen de fondo {{ $cardImage->name }}">
                </div>

            </div>

            <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">
                    Te ayudamos a recorrer el mundo con el firme propósito y enorme convicción de ofrecerle a nuestros <span class="text-blue-500">clientes</span> y consumidores diferentes tipos de productos, de gran calidad y las mejores marcas internacionales.
                </h2>

                <p class="mt-4 text-gray-500 dark:text-gray-300">
                    Brindamos un servicio internacional, trabajando con los principales retailers del país, clientes especializados y atendiendo los diversos canales de comercialización, con representación en la unión Europea, ayudamos a estar más cerca de ellos.
                </p>

                <div class="inline-flex w-full mt-6 sm:w-auto">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full px-6 py-2 text-sm text-white duration-300 bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                        Contactanos
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-12 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">¿Quienes somos?</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 lg:mt-16 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M42.5 29.175L24 40.646L5.5 29.175V7.354h37v21.821z"/></svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Nosotros</h1>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            Importadores y comercializadores en diferentes segmentos de mercado para construcción, gobierno y comercio al mayorista.
                            Especializados en abrir nuevos mercados, te ayudamos a posicionar tu marca.
                        </p>
                    </div>
                </div>

                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 256 256"><path fill="currentColor" d="M34.76 42A8 8 0 0 0 32 48v168a8 8 0 0 0 16 0v-44.23c26.79-21.16 49.87-9.75 76.45 3.41c16.4 8.11 34.06 16.85 53 16.85c13.93 0 28.54-4.75 43.82-18a8 8 0 0 0 2.76-6V48a8 8 0 0 0-13.27-6c-28 24.23-51.72 12.49-79.21-1.12C103.07 26.76 70.78 10.79 34.76 42ZM208 164.25c-26.79 21.16-49.87 9.74-76.45-3.41c-25-12.35-52.81-26.13-83.55-8.4V51.79c26.79-21.16 49.87-9.75 76.45 3.4c25 12.35 52.82 26.13 83.55 8.4Z"/></svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Misión</h1>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            Una empresa que a través de nuestro modelo de negocios, nos permita innovar con lo ultimo en tecnología eléctrica y de construcción sustentable para el 2025 con una cartera de clientes y un portafolio de proyectos sólidos, rentables y diversificados a nivel nacional.
                        </p>
                    </div>
                </div>

                <div>
                    <div class="inline-block p-3 text-white bg-blue-600 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M2.5 8.187c.104-2.1.415-3.41 1.347-4.34c.93-.932 2.24-1.243 4.34-1.347M21.5 8.187c-.104-2.1-.415-3.41-1.347-4.34c-.93-.932-2.24-1.243-4.34-1.347m0 19c2.1-.104 3.41-.415 4.34-1.347c.932-.93 1.243-2.24 1.347-4.34M8.187 21.5c-2.1-.104-3.41-.415-4.34-1.347c-.932-.93-1.243-2.24-1.347-4.34m17.135-4.495c.243.304.365.457.365.682s-.122.378-.365.682C18.542 14.05 15.751 17 12 17s-6.542-2.95-7.635-4.318C4.122 12.378 4 12.225 4 12s.122-.378.365-.682C5.458 9.95 8.249 7 12 7s6.542 2.95 7.635 4.318"/><path d="M14 12a2 2 0 1 0-4 0a2 2 0 0 0 4 0"/></g></svg>
                    </div>

                    <div>
                        <h1 class="text-xl font-semibold text-gray-700 dark:text-white">Visión</h1>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                            Ser una empresa confiable, competitiva y de prestigio al ejecutar proyectos integrales, que satisfagan las expectativas presentes y futuras de nuestros clientes,mediante un servicio de calidad y vanguardia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">conoce nuestros <br> <span class="text-blue-500">Servicios</span></h1>

            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                <div class="flex flex-col items-center p-6 space-y-3 text-center transition-colors duration-300 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m7.05 11.293l4.243-4.243a2 2 0 0 1 2.828 0l2.829 2.83a2 2 0 0 1 0 2.828l-4.243 4.243a2 2 0 0 1-2.828 0L7.05 14.12a2 2 0 0 1 0-2.828zm9.193-2.121l3.086-.772a1.5 1.5 0 0 0 .697-2.516L17.81 3.667a1.5 1.5 0 0 0-2.44.47L14.122 7.05"/><path d="M9.172 16.243L8.4 19.329a1.5 1.5 0 0 1-2.516.697L3.667 17.81a1.5 1.5 0 0 1 .47-2.44l2.913-1.248"/></g></svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Confiteria</h1>

                    <p class="text-gray-500 dark:text-gray-300">
                        Nos especializamos en la importación y distribución de productos de confitería, ofreciendo una amplia variedad de dulces y golosinas de alta calidad.
                    </p>

                    <a href="#" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                        <span class="mx-1">ver más</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>

                <div class="flex flex-col items-center p-6 space-y-3 text-center transition-colors duration-300 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16"><path fill="currentColor" d="M1.5 9.6c1.1.7 2.5 1.9 2.5 3.3V14h.1s.9 0 2-1c1 1 2 1 2 1s1 0 2-1c1 1 1.9 1 1.9 1h.1v-1.1c0-1.4 1.4-2.6 2.5-3.3c.6-.4.5-1.2-.2-1.4L13 7.8V4h-1V3H9V1H7v2H4v1H3v3.8l-1.3.4c-.8.2-.8 1-.2 1.4zM4 5h1V4h6v1h1v2.5l-3.3-1c-.5-.1-1-.1-1.5 0L4 7.5V5zm10 9c-1 1-2 1-2 1s-1 0-2-1c-1 1-2 1-2 1s-1 0-2-1c-1 1-2 1-2 1s-1 0-2-1c-1 1-2 1-2 1v1h16v-1s-1 0-2-1z"/></svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Importación / exportación</h1>

                    <p class="text-gray-500 dark:text-gray-300">
                        Ayudamos a nuestros clientes a importar y exportar productos de alta calidad, garantizando un proceso eficiente y transparente.
                    </p>

                    <a href="#" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                        <span class="mx-1">ver más</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>

                <div class="flex flex-col items-center p-6 space-y-3 text-center transition-colors duration-300 bg-gray-100 rounded-xl dark:bg-gray-800">
                    <span class="inline-block p-3 text-blue-500 bg-blue-100 rounded-full dark:text-white dark:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M17.252 12.49c-.284 2.365-1.833 3.31-2.502 3.996c-.67.688-.55.825-.505 1.834a.916.916 0 0 1-.916.971h-2.658a.918.918 0 0 1-.917-.971c0-.99.092-1.22-.504-1.834c-.76-.76-2.548-1.833-2.548-4.784a5.307 5.307 0 1 1 10.55.788"/><path d="M10.46 19.236v1.512c0 .413.23.752.513.752h2.053c.285 0 .514-.34.514-.752v-1.512m-2.32-10.54a2.227 2.227 0 0 0-2.226 2.227m10.338.981h1.834m-3.68-6.012l1.301-1.301M18.486 17l1.301 1.3M12 2.377V3.86m-6.76.73l1.292 1.302M4.24 18.3L5.532 17m-.864-5.096H2.835"/></g></svg>
                    </span>

                    <h1 class="text-xl font-semibold text-gray-700 capitalize dark:text-white">Iluminación inteligente</h1>

                    <p class="text-gray-500 dark:text-gray-300">
                        Ejecutamos su proyecto de iluminación con la más alta calidad, cumpliendo con los estándares internacionales y adaptándonos a las necesidades específicas de cada cliente.
                    </p>

                    <a href="{{ route('catalog') }}" class="flex items-center -mx-1 text-sm text-blue-500 capitalize transition-colors duration-300 transform dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                        <span class="mx-1">ver más</span>
                        <svg class="w-4 h-4 mx-1 rtl:-scale-x-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">
                Que dicen nuestros <span class="text-blue-500 ">clientes</span>
            </h1>

            <p class="max-w-2xl mx-auto mt-6 text-center text-gray-500 dark:text-gray-300">
                Testimonios de nuestros clientes satisfechos con nuestros servicios y productos. Nos enorgullece recibir comentarios positivos que reflejan nuestro compromiso con la calidad y la satisfacción del cliente.
            </p>

            <section class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 lg:grid-cols-2 xl:grid-cols-3">

                @foreach ($testimonials as $testimonio)
                    <div class="p-8 border rounded-lg dark:border-gray-700">
                        <p class="leading-loose text-gray-500 dark:text-gray-400">
                            {{ $testimonio->message }}
                        </p>

                        <div class="flex items-center mt-8 -mx-2">
                            <img class="object-cover mx-2 rounded-full w-14 shrink-0 h-14 ring-4 ring-gray-300 dark:ring-gray-700" src="{{ App::environment('local')
                            ? asset('storage/' . ltrim($testimonio->image, '/'))
                            : Storage::disk('s3')->url($testimonio->image) }}" alt="{{ $testimonio->name }}">

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

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Entradas recientes del blog</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">

                @foreach ($posts as $post)
                    <div class="lg:flex">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="{{ App::environment('local')
                            ? asset('storage/' . ltrim($post->image, '/'))
                            : Storage::disk('s3')->url($post->image) }}" alt="{{ $post->title }}">

                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                {{ $post->title }}
                            </a>

                            @php
                                $fechaFormateada = Carbon::parse($post->updated_at)
                                ->translatedFormat('d \d\e\l \m\e\s F \d\e\l Y');
                            @endphp

                            <span class="text-sm text-gray-500 dark:text-gray-300">Publicado: {{ $fechaFormateada }}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-12 mx-auto">
            <div class="text-center">
                <p class="font-medium text-blue-500 dark:text-blue-400">Medios de</p>

                <h1 class="mt-2 text-2xl font-semibold text-gray-800 md:text-3xl dark:text-white">Contacto</h1>

                <p class="mt-3 text-gray-500 dark:text-gray-400">Listos para escuchar su requerimientos y apoyarlos.</p>
            </div>

            <div class="grid grid-cols-1 gap-12 mt-10 md:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col items-center justify-center text-center">
                    <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </span>

                    <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Email</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Estamos para ayudarle.</p>
                    <p class="mt-2 text-blue-500 dark:text-blue-400">contacto@grupolitesa.com.mx</p>
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
                    <p class="mt-2 text-blue-500 dark:text-blue-400">Av. Ejercito Nacional 425 Chapultepec Morales, Miguel Hidalgo, CP 1152 Ciudad de México</p>
                </div>

                <div class="flex flex-col items-center justify-center text-center">
                    <span class="p-3 text-blue-500 rounded-full bg-blue-100/80 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </span>

                    <h2 class="mt-4 text-lg font-medium text-gray-800 dark:text-white">Teléfono</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Lun-Vie  9am a 6pm.</p>
                    <p class="mt-2 text-blue-500 dark:text-blue-400">+52 (55) 66512699</p>
                </div>
            </div>
        </div>
    </section>

</div>
