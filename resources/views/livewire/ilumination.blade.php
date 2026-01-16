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
                class="w-full bg-center bg-cover h-[38rem]"
                style="background-image: url('{{ App::environment('local')
                            ? asset('storage/' . ltrim($lighting->header_image, '/'))
                            : Storage::disk('s3')->url($lighting->header_image) }}')"
                aria-label="Grupo Litesa"
                ></div>
        @endif

        <div class="container flex flex-col px-6 py-10 mx-auto space-y-6 lg:h-[32rem] lg:py-16 lg:flex-row lg:items-center">
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

    <section class="py-20 bg-white dark:bg-gray-900">
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

    <section class="pb-20 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">

            <hr class="my-12 border-gray-200 dark:border-gray-700">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-61 lg:grid-cols-3">
                @if ($lighting->section3_images)
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
                @endif

            </div>
        </div>
    </section>
</div>
