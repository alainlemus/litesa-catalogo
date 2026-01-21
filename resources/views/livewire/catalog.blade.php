@section('title', 'Catalogo de Iluminación - Grupo Litesa')
@section('meta_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
@section('og_title', 'Iluminación - Grupo Litesa')
@section('og_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
@section('og_image', App::environment('local') ? asset('uploads/' . ltrim('iluminacion.jpg', '/')) : Storage::disk('s3')->url('uploads/iluminacion.jpg'))

@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Catalogo de Iluminación - Grupo Litesa')
@section('twitter_description', 'Expertos en iluminación, ofrecemos soluciones de alta calidad para el hogar y la industria. Descubre nuestra amplia gama de productos y servicios.')
@section('twitter_image', App::environment('local') ? asset('uploads/' . ltrim('iluminacion.jpg', '/')) : Storage::disk('s3')->url('uploads/iluminacion.jpg'))
<div class="bg-transparent dark:bg-gray-900">

    <div class="sticky z-10 w-full text-white bg-white shadow top-18 dark:bg-gray-700">
        <div class="w-full flex flex-wrap items-center px-4 py-3 lg:justify-center md:flex-row md:space-y-0">

            <!-- Buscador y Filtro de Categoría -->
            <div class="flex flex-col w-full gap-2 mt-2 md:mt-0 md:flex-row md:w-2/3">
                <div class="relative w-full md:w-2/3">
                    <svg class="absolute w-5 h-5 text-gray-400 right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>
                    <input wire:model.live="search" type="text" placeholder="Buscar producto..."
                        class="w-full py-2 pl-4 pr-10 text-black bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="w-full md:w-1/3">
                    <select wire:model.live="selectedCategory" class="cursor-pointer w-full h-full py-2 px-2 text-black bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $id => $category)
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Filtro -->
            <div class="flex justify-center px-4 py-2 bg-blue-100 dark:bg-gray-600 w-full mt-2">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="font-semibold text-purple-600 dark:text-white">Filtrar por uso:</p>
                    @foreach ($places as $id => $place)
                        <button
                            wire:click="$set('selectedUse', {{ $id }})"
                            class="px-3 py-1 text-sm rounded transition-all duration-150
                                {{ $selectedUse == $id ? 'bg-purple-600 text-white' : 'bg-white text-black border border-purple-300' }}
                                hover:bg-purple-500 hover:text-white cursor-pointer">
                            {{ $place }}
                        </button>
                    @endforeach

                    @if ($selectedUse)
                        <button wire:click="$set('selectedUse', null)" class="cursor-pointer px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-500">
                            Limpiar filtro
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container relative p-6 pb-20 mx-auto bg-transparent pt-18">
        <h2 class="mb-4 text-2xl font-bold dark:text-white">Catálogo de Productos</h2>
        <p class="mb-6 text-gray-600 dark:text-white">Descubre nuestra amplia gama de productos de iluminación LED</p>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach ($products as $product)
                <a href="{{ route('product.show', $product->slug) }}"
                    class="p-6 bg-white dark:bg-gray-800 rounded-3xl flex flex-col items-center shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group relative overflow-hidden w-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="w-44 h-44 flex items-center justify-center bg-gray-50 dark:bg-gray-900 rounded-2xl mb-4 overflow-hidden border border-gray-100 dark:border-gray-700 group-hover:scale-105 transition-transform duration-300">
                        @if ($product->photos->count() > 0)
                            <img src="{{ App::environment('local') ? asset('storage/' . $product->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photos->first()->path) }}" alt="{{ $product->name }}" class="object-contain w-full h-full transition-transform duration-300 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gray-200 text-gray-500">Sin imagen</div>
                        @endif
                    </div>
                    <h3 class="mb-2 text-lg font-extrabold text-gray-900 dark:text-white text-center tracking-wide uppercase">{{ mb_strtoupper($product->name, 'UTF-8') }}</h3>
                    <div class="w-full pt-2 pl-1">
                        <p class="mb-2 text-green-600">
                            @if ($product->certification != null)
                                <span class="p-1 text-yellow-500 border-gray-300 rounded dark:text-gray-300 border-1">{{ $product->certification }}</span>
                            @endif
                            @if ($product->base != null)
                                <span class="p-1 border-gray-300 rounded border-1 dark:text-gray-300">{{ $product->base }}</span>
                            @endif
                            @if ($product->power_factor != null)
                                <span class="p-1 border-gray-300 rounded border-1 dark:text-gray-300">
                                    {{ $product->power_factor }}
                                </span>
                            @endif
                        </p>
                        <div class="flex items-center mb-2">
                            @if ($product->warranty != null)
                                <span class="px-2 py-1 text-white bg-yellow-300 rounded-full dark:bg-gray-900">Garantía {{ $product->warranty }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-semibold shadow-lg">Ver más</span>
                </a>
            @endforeach
        </div>
        {{-- Links de paginación --}}
        <div class="mt-6">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </main>

</div>
