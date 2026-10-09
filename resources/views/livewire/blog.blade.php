<div>

    @php
        use App\Support\Media;
        use Carbon\Carbon;
    @endphp

    @section('title', 'Blog - Noticias y novedades | Grupo Litesa' . ($posts->currentPage() > 1 ? ' (página ' . $posts->currentPage() . ')' : ''))
    @section('meta_description', 'Mantente informado con las últimas noticias, consejos y actualizaciones de Grupo Litesa sobre iluminación y más.')
    @section('og_image', Media::url('uploads/navio.webp'))

    <header data-glow class="relative overflow-hidden text-white bg-ink-950">
        <div class="absolute rounded-full -top-32 -left-20 size-[28rem] bg-brand/40 blur-3xl" aria-hidden="true"></div>
        <div class="absolute rounded-full -bottom-40 right-10 size-[24rem] bg-lumen/15 blur-3xl" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="container relative px-6 py-16 mx-auto lg:py-20">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <p class="eyebrow eyebrow-light">Blog</p>
                    <h1 data-split class="mt-5 text-4xl display lg:text-6xl">Entradas recientes</h1>
                    <p class="max-w-xl mt-4 text-lg text-white/75">Noticias, consejos y novedades de Grupo Litesa.</p>
                </div>
                <button type="button" wire:click="toggleSearch" aria-expanded="{{ $show ? 'true' : 'false' }}" aria-controls="blog-search" aria-label="Buscar entradas"
                    class="p-3 rounded-full cursor-pointer glass hover:bg-white/20 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-lumen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            @if ($show || $search)
                <div id="blog-search" wire:transition class="mt-8" role="search">
                    <label for="blog-search-input" class="sr-only">Buscar entradas</label>
                    <input id="blog-search-input" wire:model.live.debounce.400ms="search" type="search" placeholder="Buscar entradas..." autofocus
                        class="w-full px-5 py-3 text-white placeholder-white/40 border rounded-full bg-white/10 border-white/20 focus:outline-none focus:ring-2 focus:ring-lumen">
                </div>
            @endif
        </div>
    </header>

    <section class="transition-colors duration-300 bg-transparent dark:bg-gray-950">
        <div class="container px-6 py-14 mx-auto">

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">

                @forelse ($posts as $post)
                    <article wire:key="post-{{ $post->id }}" style="--i: {{ $loop->index % 3 }}" class="pop-in card-lift group p-4 bg-white border border-gray-200 rounded-3xl dark:bg-ink-900 dark:border-white/10">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden rounded-2xl" tabindex="-1" aria-hidden="true">
                            @if ($post->image)
                                <img style="view-transition-name: post-{{ $post->id }}; view-transition-class: vt-shared"
                                    class="object-cover object-center w-full h-64 transition-transform duration-500 lg:h-80 group-hover:scale-105"
                                    src="{{ Media::url($post->image) }}"
                                    alt="{{ $post->title }}"
                                    @if ($loop->index < 3) fetchpriority="high" @else loading="lazy" @endif
                                    decoding="async" width="400" height="320">
                            @endif
                        </a>

                        <div class="px-2 pt-6 pb-2">
                            <span class="inline-block px-3 py-1 text-xs font-semibold tracking-widest uppercase rounded-full bg-lumen/20 text-ink-900 dark:text-lumen">{{ $post->category }}</span>

                            <h2 class="mt-3 text-xl font-bold text-ink-900 dark:text-white">
                                <a href="{{ route('blog.show', $post->slug) }}" class="transition-colors hover:text-blue-600 dark:hover:text-blue-400">{{ $post->title }}</a>
                            </h2>

                            <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $post->excerpt }}</p>

                            <div class="flex items-center justify-between mt-4">
                                <time datetime="{{ $post->created_at->toIso8601String() }}" class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ Carbon::parse($post->created_at)->translatedFormat('d \d\e F \d\e Y') }}
                                </time>

                                <a href="{{ route('blog.show', $post->slug) }}" aria-label="Leer entrada: {{ $post->title }}" class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 hover:gap-2 transition-all">
                                    Leer entrada <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="py-16 text-center text-gray-600 col-span-full dark:text-gray-300">No encontramos entradas que coincidan con tu búsqueda.</p>
                @endforelse

            </div>

            {{-- Links de paginación --}}
            <div class="mt-6 pb-16">
                {{ $posts->links('vendor.pagination.tailwind') }}
            </div>

        </div>
    </section>


</div>
