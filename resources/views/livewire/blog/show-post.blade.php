<div>

    @section('title', $post->title . ' - Grupo Litesa')
    @section('meta_description', $post->excerpt)
    @section('og_title', $post->title . ' - Grupo Litesa')
    @section('og_description', $post->excerpt)
    @section('og_image', Storage::disk('public')->url($post->image))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title', $post->title . ' - Grupo Litesa')
    @section('twitter_description', $post->excerpt)
    @section('twitter_image', Storage::disk('public')->url($post->image))

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

            <div class="flex my-6 space-x-4">
                <span class="font-semibold text-gray-600 dark:text-gray-300">Compartir en:</span>

                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                   target="_blank"
                   class="text-blue-600 hover:text-blue-800"
                   title="Compartir en Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.63 9.88v-6.99h-2.8v-2.89h2.8V9.41c0-2.77 1.66-4.3 4.2-4.3 1.22 0 2.49.22 2.49.22v2.73h-1.4c-1.38 0-1.81.86-1.81 1.74v2.09h3.07l-.49 2.89h-2.58v6.99A10 10 0 0022 12z"/>
                    </svg>
                </a>

                <!-- X (Twitter) -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                   target="_blank"
                   class="text-gray-600 hover:text-black"
                   title="Compartir en X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="currentColor" viewBox="0 0 1200 1227">
                        <path d="M715.9 567.3 1178.7 0H1072L666.5 491.3 340.6 0H0l490 728.3L0 1227h106.7l424.5-531.5L875 1227h325L715.9 567.3Zm-150.2 188-49.2-73.6L163.7 91.5h136.3l293.2 438.5 49.2 73.6 373.2 557.2H879.9L565.7 755.3Z"/>
                    </svg>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                   target="_blank"
                   class="text-blue-700 hover:text-blue-900"
                   title="Compartir en LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.45 20.45h-3.55v-5.42c0-1.29-.03-2.96-1.8-2.96-1.8 0-2.08 1.4-2.08 2.85v5.53h-3.54v-11h3.4v1.5h.05c.47-.9 1.63-1.85 3.35-1.85 3.58 0 4.24 2.36 4.24 5.43v6.42zM5.34 8.5c-1.14 0-2.06-.92-2.06-2.06s.92-2.06 2.06-2.06 2.06.92 2.06 2.06-.92 2.06-2.06 2.06zm1.78 11.95H3.56v-11h3.56v11zM22.22 0H1.77C.8 0 0 .77 0 1.73v20.54C0 23.23.8 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/>
                    </svg>
                </a>
            </div>

            @if ($post->image)
                <img
                    src="{{ Storage::disk('public')->url($post->image) }}"
                    alt="{{ $post->title }}"
                    class="w-full mb-6 rounded-xl">
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
