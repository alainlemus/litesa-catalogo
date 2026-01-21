<div class="bg-transparent dark:bg-gray-900">

    @php
        use Illuminate\Support\Str;
        $plainDescription = $product->description ? Str::limit(strip_tags($product->description), 160) : 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.';
    @endphp
    @section('title', strtoupper($product->name) . ' - Grupo Litesa')
    @section('meta_description', $plainDescription)
    @section('og_title',  strtoupper($product->name) . ' - Grupo Litesa')
    @section('og_description', $plainDescription)
    @section('og_image', App::environment('local') ? asset('storage/' . $product->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photos->first()->path))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title',  strtoupper($product->name) . ' - Grupo Litesa')
    @section('twitter_description', $plainDescription)
    @section('twitter_image', App::environment('local') ? asset('storage/' . $product->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photos->first()->path))

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

            <span class="text-gray-500 dark:text-gray-300 hover:underline max-w-xs truncate inline-block align-bottom" style="vertical-align:bottom;" title="{{ strtoupper($product->name) }}">
                {{ strtoupper($product->name) }}
            </span>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

            <!-- Product Images Carousel -->
            <div class="hidden lg:block">
                <div class="space-y-4">
                    <div class="relative overflow-hidden bg-white shadow-lg rounded-2xl group">
                        <div class="flex items-center justify-center p-8 aspect-square">
                            <div id="carousel" class="relative w-full">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @foreach ($product->photos as $photo)
                                            <div class="swiper-slide flex items-center justify-center h-full">
                                                <img src="{{ App::environment('local') ? asset('storage/' . $photo->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($photo->path) }}" alt="{{ $product->name }}" class="object-contain max-w-full max-h-full h-full w-auto mx-auto rounded-2xl transition-transform duration-300" style="cursor:default;"/>
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

                <div class="p-8 ">

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

                    <h1 class="lg:pt-0 pt-4 mb-2 text-3xl font-bold text-gray-500 dark:text-white">{{ strtoupper($product->name) }}</h1>

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
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500  rounded-full dark:text-white bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>

                                <span class="p-1 dark:text-white">
                                    {{ $product->power_factor }}
                                </span>
                            </div>
                        @endif
                        @if ($product->certification != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>

                                <span class="p-1 text-yellow-500 dark:text-white">{{ $product->certification }}</span>
                            </div>
                        @endif
                        @if ($product->base != null)
                            <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1">
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
                        <div class="mt-6 flex flex-col lg:items-end items-center gap-2">
                            <div class="flex gap-2 mb-2">
                                <p class="font-semibold text-gray-600 flex justify-center items-center dark:text-white">Compartir: </p>
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white overflow-hidden" title="Compartir en Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/>
                                    </svg>
                                </a>
                                <!-- Twitter/X -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode('Mira este producto: ' . strtoupper($product->name)) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-black hover:bg-gray-800 text-white" title="Compartir en X (Twitter)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path d="M22.162 5.656c.015.211.015.423.015.636 0 6.49-4.941 13.973-13.973 13.973-2.777 0-5.366-.813-7.548-2.213.386.045.772.075 1.173.075 2.3 0 4.415-.772 6.105-2.073-2.15-.045-3.963-1.462-4.59-3.417.303.045.606.075.924.075.439 0 .879-.06 1.288-.166-2.23-.454-3.91-2.415-3.91-4.773v-.06c.651.363 1.401.606 2.2.636-1.288-.863-2.13-2.34-2.13-4.011 0-.878.227-1.701.621-2.409 2.274 2.789 5.675 4.617 9.504 4.808-.075-.351-.12-.712-.12-1.082 0-2.626 2.13-4.757 4.757-4.757 1.373 0 2.614.575 3.484 1.501 1.082-.211 2.13-.606 3.06-1.173-.363 1.127-1.127 2.073-2.13 2.671 0.963-.106 1.877-.372 2.724-.757-.651.954-1.462 1.797-2.406 2.463z"/>
                                    </svg>
                                </a>
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode(strtoupper($product->name)) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-800 hover:bg-blue-900 text-white" title="Compartir en LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.327-.027-3.037-1.849-3.037-1.851 0-2.132 1.445-2.132 2.939v5.667H9.358V9h3.414v1.561h.049c.476-.899 1.637-1.849 3.37-1.849 3.602 0 4.267 2.369 4.267 5.455v6.285zM5.337 7.433c-1.144 0-2.069-.926-2.069-2.069 0-1.144.925-2.07 2.069-2.07 1.143 0 2.069.926 2.069 2.07 0 1.143-.926 2.069-2.069 2.069zm1.777 13.019H3.56V9h3.554v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.549C0 23.229.792 24 1.771 24h20.451C23.2 24 24 23.229 24 22.271V1.723C24 .771 23.2 0 22.225 0z"/>
                                    </svg>
                                </a>
                                <!-- Instagram -->
                                <a href="https://www.instagram.com/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500 hover:from-pink-600 hover:via-red-600 hover:to-yellow-600 text-white" title="Compartir en Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.974.974 1.246 2.241 1.308 3.608.058 1.266.069 1.646.069 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.974.974-2.241 1.246-3.608 1.308-1.266.058-1.646.069-4.85.069s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.974-.974-1.246-2.241-1.308-3.608C2.175 15.647 2.163 15.267 2.163 12s.012-3.584.07-4.85c.059-1.282.353-2.394 1.333-3.374.98-.98 2.092-1.274 3.374-1.333C8.416 2.175 8.796 2.163 12 2.163zm0-2.163C8.741 0 8.332.013 7.052.072 5.771.131 4.659.425 3.678 1.406c-.98.98-1.274 2.092-1.333 3.374C2.013 5.668 2 6.077 2 12c0 5.923.013 6.332.072 7.612.059 1.282.353 2.394 1.333 3.374.98.98 2.092 1.274 3.374 1.333C8.332 23.987 8.741 24 12 24s3.668-.013 4.948-.072c1.282-.059 2.394-.353 3.374-1.333.98-.98 1.274-2.092 1.333-3.374.059-1.28.072-1.689.072-7.612 0-5.923-.013-6.332-.072-7.612-.059-1.282-.353-2.394-1.333-3.374-.98-.98-2.092-1.274-3.374-1.333C15.668.013 15.259 0 12 0zm0 5.838A6.162 6.162 0 0 0 5.838 12 6.162 6.162 0 0 0 12 18.162 6.162 6.162 0 0 0 18.162 12 6.162 6.162 0 0 0 12 5.838zm0 10.162A3.999 3.999 0 1 1 12 8a3.999 3.999 0 0 1 0 7.999zm6.406-11.845a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z"/>
                                    </svg>
                                </a>
                                <!-- Copiar link -->
                                <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}');this.innerHTML='<span class=\'text-green-400\'>¡Copiado!</span>';setTimeout(()=>{this.innerHTML='<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'currentColor\' viewBox=\'0 0 24 24\' class=\'w-5 h-5\'><path d=\'M19 21H9a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2zm0-2V3h-6v2h4a2 2 0 0 1 2 2v12h2zm-2 0H9V7h8v12z\'/></svg>'}, 1200);" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gray-400 hover:bg-gray-500 text-white cursor-pointer" title="Copiar enlace">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                        <path d="M19 21H9a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h2V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2zm0-2V3h-6v2h4a2 2 0 0 1 2 2v12h2zm-2 0H9V7h8v12z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex justify-end w-full">
                                <a
                                    href="https://wa.me/52{{ $whatsapp }}?text={{ urlencode('Hola, quiero más información sobre el producto: ' . strtoupper($product->name) . ($product->warranty ? ' | Garantía: ' . $product->warranty : '') . ($product->power_factor ? ' | Factor de Potencia: ' . $product->power_factor : '') . ($product->certification ? ' | Certificación: ' . $product->certification : '') . ($product->base ? ' | Base: ' . $product->base : '') . (request()->fullUrl() ? ' | Link: ' . request()->fullUrl() : '')) }}"
    target="_blank"
    class="inline-flex items-center gap-2 px-6 py-3 text-white bg-green-500 rounded-lg shadow hover:bg-green-600 transition-colors font-semibold text-lg"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                        <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.62-.47-.16-.01-.36-.01-.56-.01-.19 0-.5.07-.76.34-.26.27-1 1-.98 2.43.02 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                                    </svg>
                                    Informes por WhatsApp
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($product->variants->isNotEmpty())
                    <div class="mt-16">
                        <div class="w-full">

                            <div id="specifications" class="mt-6 tab-content">
                                <div class="p-8 ">
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

        <div class="py-20">
            <h2 class="mb-4 text-2xl font-bold text-gray-700 dark:text-white">Productos similares</h2>
            <hr class="py-2 mb-6 border-gray-300 dark:border-gray-600" />
            <div class="swiper-similares-container container px-0 sm:px-4">
                <div class="swiper-wrapper gap-4 flex-nowrap overflow-x-auto scrollbar-hide">
                    @foreach ($similares as $similar)
                        <a href="{{ route('product.show', $similar->slug) }}" class="w-3/4 sm:w-1/2 md:w-1/3 lg:w-1/4 min-w-[70vw] sm:min-w-[45vw] md:min-w-[32vw] lg:min-w-0 p-4 bg-white rounded-lg  dark:bg-gray-700 cursor-pointer text-left focus:outline-none focus:ring-2 focus:ring-blue-500  transition-all">
                            <div>
                                <img src="{{ App::environment('local') ? asset('storage/' . $similar->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($similar->photos->first()->path) }}" alt="{{ $similar->name }}" class="object-contain w-full h-32 mb-2 rounded" />
                                <h3 class="mb-2 text-md font-semibold text-gray-600 dark:text-white text-center">{{ mb_strtoupper($similar->name, 'UTF-8') }}</h3>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <style>
        td{
            border: 1px solid black;
            padding-left: 5px;
            padding-right: 5px;
        }
        @media (min-width: 1024px) {
            .group:hover img,
            .group:active img {
                transform: none;
                cursor: default;
            }
        }
        @media (max-width: 1023px) {
            .group:hover img,
            .group:active img {
                transform: none;
                cursor: default;
            }
        }
    </style>
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

</div>
