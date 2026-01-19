<div class="bg-transparent dark:bg-gray-900">

    @section('title', $product->name . ' - Grupo Litesa')
    @section('meta_description', $product->description ? $product->description : 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('og_title',  $product->name . ' - Grupo Litesa')
    @section('og_description', $product->description ? $product->description : 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('og_image', App::environment('local') ? asset('storage/' . $product->photo) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photo))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title',  $product->name . ' - Grupo Litesa')
    @section('twitter_description', $product->description ? $product->description : 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
    @section('twitter_image', App::environment('local') ? asset('storage/' . $product->photo) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photo))

    <div class="container flex-grow h-full px-4 py-12 mx-auto">

        <!-- Breadcrumb -->
        <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap">
            <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <a href="{{ route('ilumination.catalog') }}" class="text-gray-600 dark:text-gray-200 hover:underline">
                Catálogo
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <span class="text-gray-500 dark:text-gray-300 hover:underline">
                {{ $product->name }}
            </span>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

            <!-- Product Images Carousel -->
            <div class="hidden lg:block">
                <div class="space-y-4">
                    <div class="relative overflow-hidden bg-white shadow-lg rounded-2xl">
                        <div class="flex items-center justify-center p-8 aspect-square">
                            <div id="carousel" class="relative w-full">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->photos as $photo)
                                            <div class="swiper-slide flex items-center justify-center h-full">
                                                <img src="{{ App::environment('local') ? asset('storage/' . $photo->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($photo->path) }}" alt="{{ $product->name }}" class="object-contain max-w-full max-h-full h-full w-auto mx-auto rounded-2xl"/>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Add Navigation -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SwiperJS CDN -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    new Swiper('.swiper-container', {
                        loop: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                });
            </script>

            <!-- Product Info -->
            <div class="space-y-6">

                <div class="p-8 bg-white shadow-lg dark:bg-gray-700 rounded-2xl">

                    <div class="block lg:hidden">
                        <div class="space-y-4">
                            <!-- Main Image -->
                            <div class="relative overflow-hidden bg-white rounded-2xl">
                                <div class="flex items-center justify-center aspect-square">
                                    @if (!$product->photos->isEmpty())
                                        <img id="mainImage" src="{{ App::environment('local') ? asset('storage/' . $product->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photos->first()->path) }}" alt="{{ $product->name }}" class="object-fill max-w-full max-h-full"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="mb-2 text-3xl font-bold text-gray-500 dark:text-white">{{ $product->name }}</h1>

                    <div class="flex flex-wrap items-center gap-2 space-x-4">
                        @if ($product->warranty != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-white bg-yellow-300 rounded-full dark:bg-gray-500 dark:border-gray-700 border-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                                <span class="px-2 py-1 text-white rounded-full">Garantía {{ $product->warranty }}</span>
                            </div>
                        @endif
                        @if ($product->power_factor != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full dark:text-white bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>

                                <span class="p-1 dark:text-white">
                                    {{ $product->power_factor }}
                                </span>
                            </div>
                        @endif
                        @if ($product->certification != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>

                                <span class="p-1 text-yellow-500 dark:text-white">{{ $product->certification }}</span>
                            </div>
                        @endif
                        @if ($product->base != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1">
                                <span class="p-1 text-yellow-500 dark:text-white">{{ $product->base }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-start pt-6 text-gray-700 dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                        </svg>
                        <h4 class="pl-3 mb-3 font-semibold">
                            Usos
                        </h4>
                    </div>
                    <ul class="space-y-2">

                        @foreach ($product->uses as $uses)

                            <li class="flex items-center space-x-2 text-gray-900 dark:text-white">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $uses->name }}</span>
                            </li>

                        @endforeach

                    </ul>
                    @if ($product->description != null)
                        <hr class="my-6 border-gray-300 dark:border-gray-600 dark:text-white" />
                        <div>
                            <span class="dark:text-white">{!! $product->description !!}</span>
                        </div>
                    @endif

                    @if ($whatsapp)
                        <div class="mt-6 flex justify-end">
                            <a
                                href="https://wa.me/52{{ $whatsapp }}?text={{ urlencode('Hola, quiero más información sobre el producto: ' . $product->name . ($product->warranty ? ' | Garantía: ' . $product->warranty : '') . ($product->power_factor ? ' | Factor de Potencia: ' . $product->power_factor : '') . ($product->certification ? ' | Certificación: ' . $product->certification : '') . ($product->base ? ' | Base: ' . $product->base : '') . (request()->fullUrl() ? ' | Link: ' . request()->fullUrl() : '')) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-6 py-3 text-white bg-green-500 rounded-lg shadow hover:bg-green-600 transition-colors font-semibold text-lg"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.62-.47-.16-.01-.36-.01-.56-.01-.19 0-.5.07-.76.34-.26.27-1 1-.98 2.43.02 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                                </svg>
                                Pedir informes por WhatsApp
                            </a>
                        </div>
                    @endif
                </div>

                @if ($product->variants->isNotEmpty())
                    <div class="mt-16">
                        <div class="w-full">

                            <div id="specifications" class="mt-6 tab-content">
                                <div class="p-8 bg-white shadow-lg rounded-2xl dark:bg-gray-500">
                                    <h3 class="mb-4 text-xl font-bold text-gray-700 dark:text-white">Variantes</h3>
                                    <div class="overflow-x-auto bg-blue-600 dark:bg-gray-900">
                                        <table class="w-full border-collapse">
                                            <thead>
                                                <tr class="text-white border-b-1">
                                                    <th class="p-3 text-left">ID</th>
                                                    <th class="p-3 text-center">Tamaño</th>
                                                    <th class="p-3 text-center">Potencia</th>
                                                    <th class="p-3 text-center">Lúmenes</th>
                                                    <th class="p-3 text-center">Voltaje</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->variants as $variant )

                                                    <tr class="bg-gray-50">
                                                        <td class="p-3 font-medium text-litesa-purple">{{ $variant->variant_id }}</td>
                                                        <td class="p-3 text-center">{{ $variant->size }}</td>
                                                        <td class="p-3 font-semibold text-center">{{ $variant->power }}</td>
                                                        <td class="p-3 text-center">{{ $variant->lumen }}</td>
                                                        <td class="p-3 text-center">{{ $variant->voltage }}</td>
                                                    </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

    <style>
        td{
            border: 1px solid black;
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>

</div>
