<div>

    @section('title', 'Blog - Grupo Litesa')
    @section('meta_description', 'Mantente informado con las últimas noticias y actualizaciones de Grupo Litesa.')
    @section('og_title', 'Blog - Grupo Litesa')
    @section('og_description', 'Mantente informado con las últimas noticias y actualizaciones de Grupo Litesa.')
    @section('og_image', App::environment('local') ? asset('uploads/' . ltrim('navio.jpg', '/')) : Storage::disk('s3')->url('uploads/navio.jpg'))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title', 'Blog - Grupo Litesa')
    @section('twitter_description', 'Mantente informado con las últimas noticias y actualizaciones de Grupo Litesa.')
    @section('twitter_image', App::environment('local') ? asset('uploads/' . ltrim('navio.jpg', '/')) : Storage::disk('s3')->url('uploads/navio.jpg'))

    @php
        use Carbon\Carbon;
    @endphp

    <section class="transition-colors duration-300 bg-transparent dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div>

                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Entradas recientes </h1>

                    <button type="button" @click="show = !show" wire:click="toggleSearch" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <div class="{{ $show ? 'block' : 'hidden' }} mt-4 transition-all duration-300">
                    <div class="my-6">
                        <input
                            wire:model.live="search"
                            type="text"
                            placeholder="Buscar entradas..."
                            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600 focus:outline-none focus:ring focus:ring-blue-400"
                        />
                    </div>
                </div>

            </div>

            <hr class="my-8 border-gray-200 dark:border-gray-700">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($posts as $post)
                    <div class="duration-300 fade-in-up">
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80" src="{{ App::environment('local')
                            ? asset('storage/' . ltrim($post->image, '/'))
                            : Storage::disk('s3')->url($post->image) }}" alt="{{ $post->title }}">

                        <div class="mt-8">
                            <span class="text-blue-500 uppercase">{{ $post->category }}</span>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                {{ $post->title }}
                            </h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                {{ $post->excerpt }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    @php
                                        $fechaFormateada = Carbon::parse($post->updated_at)
                                        ->translatedFormat('d \d\e\l \m\e\s F \d\e\l Y');
                                    @endphp
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $fechaFormateada }}</p>
                                </div>

                                <a href="{{ route('blog.show', $post->slug) }}" class="inline-block text-blue-500 underline hover:text-blue-400">Ver entrada</a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Links de paginación --}}
            <div class="mt-6 py-22">
                {{ $posts->links('vendor.pagination.tailwind') }}
            </div>

        </div>
    </section>

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
