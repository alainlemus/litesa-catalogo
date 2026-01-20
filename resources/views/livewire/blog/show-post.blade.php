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

    <div class="flex justify-center w-full px-4 py-10 mx-auto transition-colors duration-300 dark:bg-gray-700">

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

                <span class="text-blue-600 dark:text-blue-400 hover:underline max-w-xs truncate inline-block align-bottom" style="vertical-align:bottom;" title="{{ $post->title }}">
                    {{ $post->title }}
                </span>
            </div>

            <div class="mb-4 overflow-x-auto whitespace-nowrap">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white inline-block align-bottom select-text" style="min-width:fit-content;">
                    {{ strtoupper($post->title) }}
                </h1>
            </div>

            <div class="flex my-6 space-x-4">
                <span class="font-semibold text-gray-600 dark:text-gray-300 justify-center items-center flex">Compartir:</span>
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white overflow-hidden" title="Compartir en Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/>
                    </svg>
                </a>
                <!-- Twitter/X -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode('Mira este producto: ' . $post->title) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-black hover:bg-gray-800 text-white" title="Compartir en X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                        <path d="M22.162 5.656c.015.211.015.423.015.636 0 6.49-4.941 13.973-13.973 13.973-2.777 0-5.366-.813-7.548-2.213.386.045.772.075 1.173.075 2.3 0 4.415-.772 6.105-2.073-2.15-.045-3.963-1.462-4.59-3.417.303.045.606.075.924.075.439 0 .879-.06 1.288-.166-2.23-.454-3.91-2.415-3.91-4.773v-.06c.651.363 1.401.606 2.2.636-1.288-.863-2.13-2.34-2.13-4.011 0-.878.227-1.701.621-2.409 2.274 2.789 5.675 4.617 9.504 4.808-.075-.351-.12-.712-.12-1.082 0-2.626 2.13-4.757 4.757-4.757 1.373 0 2.614.575 3.484 1.501 1.082-.211 2.13-.606 3.06-1.173-.363 1.127-1.127 2.073-2.13 2.671 0.963-.106 1.877-.372 2.724-.757-.651.954-1.462 1.797-2.406 2.463z"/>
                    </svg>
                </a>
                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}" target="_blank" class="inline-flex items-center justify-center w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-blue-800 hover:bg-blue-900 text-white" title="Compartir en LinkedIn">
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

            @if ($post->image)
                <img
                    src="{{ Storage::disk('public')->url($post->image) }}"
                    alt="{{ $post->title }}"
                    class="w-full mb-6 rounded-xl">
            @endif

            <div class="flex lg:justify-between flex-col lg:flex-row mb-4">

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
