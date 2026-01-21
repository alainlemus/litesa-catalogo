<div>
    @section('title', 'Iluminación - Grupo Litesa')
    @section('meta_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('og_title', 'Iluminación - Grupo Litesa')
    @section('og_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('og_image', App::environment('local') ? asset('uploads/' . ltrim('iluminacion.jpg', '/')) : Storage::disk('s3')->url('uploads/iluminacion.jpg'))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title', 'Iluminación - Grupo Litesa')
    @section('twitter_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('twitter_image', App::environment('local') ? asset('uploads/' . ltrim('iluminacion.jpg', '/')) : Storage::disk('s3')->url('uploads/iluminacion.jpg'))

    <section class="bg-white dark:bg-gray-900">

       @if ($lighting->header_image)
            <div
                x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 300)"
                :class="loaded ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
                class="w-full bg-center bg-cover h-[38rem] transition-all duration-700 ease-out opacity-0 scale-95"
                style="background-image: url('{{ App::environment('local')
                            ? asset('storage/' . ltrim($lighting->header_image, '/'))
                            : Storage::disk('s3')->url($lighting->header_image) }}')"
                aria-label="Grupo Litesa"
                ></div>
        @endif

        <div class="duration-300 fade-in-up container flex flex-col px-6 py-10 mx-auto space-y-6 lg:h-[32rem] lg:py-16 lg:flex-row lg:items-center">
            <div class="w-full lg:w-1/2">
                <div class="lg:max-w-lg">
                    <h1 class="text-3xl font-semibold tracking-wide text-gray-800 dark:text-white lg:text-4xl">{{ $lighting->section1_title }}</h1>
                    <p class="mt-4 text-gray-600 dark:text-gray-300">{{ $lighting->section1_description }}</p>
                    <div class="grid gap-6 mt-8 sm:grid-cols-2">

                        @foreach ($lighting->section1_items ?? [] as $item)
                            <div class="flex items-center text-gray-800 -px-3 dark:text-gray-200">
                                {!! $item['svg'] !!}
                                <span class="mx-3">{{ $item['text'] }}</span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center w-full h-96 lg:w-1/2">

                @if ($firstImage->path)
                    <img class="object-cover w-full h-full max-w-2xl rounded-md" src="{{ App::environment('local')
                        ? asset('storage/' . ltrim($firstImage->path, '/'))
                        : Storage::disk('s3')->url($firstImage->path) }}" alt="{{ $firstImage->name }}" loading="lazy">
                @endif
            </div>
        </div>
    </section>

    <section class="py-20 bg-white dark:bg-gray-900 duration-300 fade-in-up">
        <div class="max-w-6xl px-6 py-10 mx-auto">

            <main class="relative z-10 w-full mt-8 md:flex md:items-center xl:mt-12">
                <div class="absolute w-full bg-gray-700 shadow -z-10 md:h-96 rounded-2xl"></div>

                <div class="w-full p-6 bg-gray-600 md:flex md:items-center rounded-2xl md:bg-transparent md:p-0 lg:px-12 md:justify-evenly">

                    @if ($secondImage->path)
                        <img class="object-cover shadow-md md:h-[32rem] md:w-80 lg:h-[36rem] lg:w-[26rem] md:rounded-2xl" src="{{ App::environment('local')
                        ? asset('storage/' . ltrim($secondImage->path, '/'))
                        : Storage::disk('s3')->url($secondImage->path) }}" alt="{{ $secondImage->name }}" />
                    @endif

                    <div class="pt-10 mt-2 md:mx-6 lg:pt-0">
                        <div>
                            <p class="pb-6 text-3xl font-medium tracking-tight text-white">{{ $lighting->section2_title }}</p>
                            <p class="text-blue-200 ">{{ $lighting->section2_description }} </p>
                            <br>
                            <a href="{{ $lighting->section2_url ? route($lighting->section2_url) : route('home') }}" class="w-full p-2 text-white transition transform bg-blue-600 rounded cursor-pointer hover:border-1 hover:scale-105 hover:border-white dark:bg-blue-600 dark:" type="submit">Ver catálogo</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="w-full flex justify-between items-center px-4 md:px-20 mb-8">
            <p class="text-3xl dark:text-white">Lo último en productos</p>
            <a href="{{ route('ilumination.catalog') }}" class="text-blue-600 font-semibold hover:underline flex items-center gap-2">Ver catálogo completo <span>&rarr;</span></a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 px-4 md:px-20">
            @foreach ($newProducts as $product)
                <a href="{{ route('product.show', $product->slug) }}" class="bg-white dark:bg-gray-800 rounded-3xl p-6 flex flex-col items-center shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group relative overflow-hidden">
                    <div class="w-44 h-44 flex items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-2xl mb-4 overflow-hidden border border-gray-100 dark:border-gray-700 group-hover:scale-105 transition-transform duration-300">
                        <img src="{{ App::environment('local')
                            ? asset('storage/' . ltrim($product->photos->first()->path ?? '', '/'))
                            : Storage::disk('s3')->url($product->photos->first()->path ?? '') }}"
                            alt="{{ $product->name }}"
                            class="object-contain w-full h-full transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 dark:text-white mb-2 text-center tracking-wide uppercase">{{ mb_strtoupper($product->name, 'UTF-8') }}</h3>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-semibold shadow-lg">Ver más</span>
                </a>
            @endforeach
        </div>
    </section>

    @if ($lighting->section3_images)
        <section class="pb-20 bg-white dark:bg-gray-900 duration-300 fade-in-up">
            <div class="container px-6 py-10 mx-auto">

                <div class="w-full flex justify-center pb-20">
                    <p class="pb-6 text-3xl font-medium tracking-tight dark:text-white">Distribuidores Oficiales</p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-61 lg:grid-cols-3">
                    @foreach ($lighting->section3_images as $image)
                        <div class="flex items-center justify-center col-span-1 md:col-span-2 lg:col-span-1">
                            @if ($image)
                                <img class="rounded h-20"
                                    src="{{ App::environment('local')
                                        ? asset('storage/' . ltrim($image, '/'))
                                        : Storage::disk('s3')->url($image) }}"
                                    alt="Galería Iluminación">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
