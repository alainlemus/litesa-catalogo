<div>

    @section('title', 'Blog - Grupo Litesa')
    @section('meta_description', 'Mantente informado con las últimas noticias y actualizaciones de Grupo Litesa.')
    @section('og_title', 'Blog - Grupo Litesa')
    @section('og_description', 'Mantente informado con las últimas noticias y actualizaciones de Grupo Litesa.')
    @section('og_image', App::environment('local') ? asset('uploads/' . ltrim('navio.jpg', '/')) : Storage::disk('s3')->url('uploads/navio.jpg'))

    @php
        use Carbon\Carbon;
    @endphp

    <section class="transition-colors duration-300 bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Entradas recientes </h1>

                <button class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <hr class="my-8 border-gray-200 dark:border-gray-700">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">

                @foreach ($posts as $post)
                    <div>
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

                                <a href="{{ route('blog.show', $post->slug) }}" class="inline-block text-blue-500 underline hover:text-blue-400">Ves entrada</a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

</div>
