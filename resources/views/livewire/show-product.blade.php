<div class="bg-transparent dark:bg-gray-700">

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

            <a href="{{ route('catalog') }}" class="text-gray-600 dark:text-gray-200 hover:underline">
                Caralogo de Iluminación
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>

            <span class="text-blue-600 dark:text-blue-400 hover:underline">
                {{ $product->name }}
            </span>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

            <!-- Product Images -->
            <div class="hidden lg:block">
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative overflow-hidden bg-white shadow-lg rounded-2xl">
                        <div class="flex items-center justify-center p-8 aspect-square">
                            <img id="mainImage" src="{{ App::environment('local') ? asset('storage/' . $product->photos->first()->path) : \Illuminate\Support\Facades\Storage::disk('s3')->url($product->photos->first()->path) }}" alt="LÁMPARA MR 16 Y GU10 - Vista 1" class="object-fill max-w-full max-h-full"/>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">

                <div class="p-8 bg-white shadow-lg dark:bg-gray-500 rounded-2xl">

                    <div class="block lg:hidden">
                        <div class="space-y-4">
                            <!-- Main Image -->
                            <div class="relative overflow-hidden bg-white rounded-2xl">
                                <div class="flex items-center justify-center aspect-square">
                                    <img id="mainImage" src="{{  asset('storage/' . $product->photos->first()->path) }}" alt="{{ $product->name }}" class="object-fill max-w-full max-h-full"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="mb-2 text-3xl font-bold text-gray-500 dark:text-white">{{ $product->name }}</h1>

                    <div class="flex flex-wrap items-center gap-2 space-x-4">
                        <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-white bg-yellow-300 rounded-full dark:bg-gray-500 dark:border-gray-700 border-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                              </svg>
                            <span class="px-2 py-1 text-white rounded-full">Garantía {{ $product->warranty }}</span>
                        </div>
                        <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full dark:text-white bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                              </svg>

                            <span class="p-1 dark:text-white">
                                {{ $product->power_factor }}
                            </span>
                        </div>
                        <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1 dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                              </svg>

                            <span class="p-1 text-yellow-500 dark:text-white">{{ $product->certification }}</span>
                        </div>
                        <div class="inline-flex items-center px-3 py-1 text-sm font-bold text-yellow-500 border-yellow-500 rounded rounded-full bg-litesa-yellow dark:bg-gray-500 dark:border-gray-700 border-1">
                            <span class="p-1 text-yellow-500 dark:text-white">{{ $product->base }}</span>
                        </div>
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
                @else
                    <div class="mt-16">
                        <div class="w-full">
                            <div id="specifications" class="mt-6 tab-content">
                                <div class="p-8 bg-white shadow-lg rounded-2xl">
                                    <h3 class="mb-4 text-xl font-bold text-litesa-purple">No hay variantes disponibles</h3>
                                    <p class="text-gray-600">Este producto no tiene variantes.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>