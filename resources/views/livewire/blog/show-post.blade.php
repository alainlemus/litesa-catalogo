<div>

    @section('title', $post->title . ' - Grupo Litesa')
    @section('meta_description', $post->excerpt)
    @section('og_title', $post->title . ' - Grupo Litesa')
    @section('og_description', $post->excerpt)
    @section('og_image', App::environment('local') ? asset('blog/' . ltrim($post->image, '/')) : Storage::disk('s3')->url('blog/'.$post->image))

    @php
        use Carbon\Carbon;
    @endphp

    <div class="flex justify-center w-full px-4 py-10 mx-auto transition-colors duration-300 dark:bg-gray-900">

        <div class="max-w-3xl">

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

                <a href="{{ route('blog') }}" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Entradas del Blog
                </a>

                <span class="mx-5 text-gray-500 dark:text-gray-300 rtl:-scale-x-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>

                <span class="text-blue-600 dark:text-blue-400 hover:underline">
                    {{ $post->title }}
                </span>
            </div>

            <h1 class="mb-4 text-3xl font-bold text-gray-800 dark:text-white">{{ strtoupper($post->title) }}</h1>

            @if ($post->image)
                <img
                    src="{{ Storage::disk('public')->url($post->image) }}"
                    alt="{{ $post->title }}"
                    class="w-full mb-6 rounded-xl"
                >
            @endif

            <div class="flex justify-between mb-4">

                @php
                    $fechaFormateada = Carbon::parse($post->updated_at)
                    ->translatedFormat('d \d\e\l \m\e\s F \d\e\l Y');
                @endphp
                <p class="mb-4 text-sm text-gray-400 dark:text-gray-500">{{ strtoupper("Categoría: ".$post->category) }}</p>
                <p class="mb-4 text-sm text-gray-400 dark:text-gray-500">{{ strtoupper($fechaFormateada) }}</p>
            </div>

            <div class="prose text-gray-700 prose-neutral max-w-none dark:text-white">
                {!! $post->content !!}
            </div>

        </div>

    </div>

</div>
