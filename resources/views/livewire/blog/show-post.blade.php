<div>
    @php
        use App\Support\Media;
        use Carbon\Carbon;
        use Illuminate\Support\Str;

        $postImage = Media::url($post->image);
        $postDescription = $post->meta_description ?: $post->excerpt ?: Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($post->content))), 155);
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;

        $articleSchema = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => Str::limit($post->title, 110, ''),
            'description' => $postDescription,
            'image' => $postImage ? [$postImage] : null,
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'articleSection' => $post->category,
            'inLanguage' => 'es-MX',
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => route('blog.show', $post->slug)],
            'author' => ['@id' => url('/') . '#organization'],
            'publisher' => ['@id' => url('/') . '#organization'],
        ]);
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('blog.show', $post->slug)],
            ],
        ];
    @endphp

    @section('title', $post->meta_title ?: \App\Support\Seo::title($post->title))
    @section('meta_description', $postDescription)
    @section('og_type', 'article')
    @section('og_image', $postImage ?? '')

    @push('head')
        <meta property="article:published_time" content="{{ $post->created_at->toIso8601String() }}">
        <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
        <meta property="article:section" content="{{ $post->category }}">
        <script type="application/ld+json">{!! json_encode($articleSchema, $jsonFlags) !!}</script>
        <script type="application/ld+json">{!! json_encode($breadcrumb, $jsonFlags) !!}</script>
    @endpush

    {{-- Encabezado --}}
    <header data-glow class="relative overflow-hidden text-white bg-ink-950">
        <div class="absolute rounded-full -top-32 -left-20 size-[28rem] bg-brand/40 blur-3xl" aria-hidden="true"></div>
        <div class="absolute rounded-full -bottom-40 right-10 size-[24rem] bg-lumen/15 blur-3xl" aria-hidden="true"></div>
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="container relative max-w-4xl px-6 pt-6 pb-24 mx-auto lg:pb-32">
            <nav aria-label="Breadcrumb" class="py-3 overflow-x-auto whitespace-nowrap">
                <ol class="flex items-center text-sm text-white/70">
                    <li><a href="{{ route('home') }}" class="hover:text-lumen">Inicio</a></li>
                    <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                    <li><a href="{{ route('blog') }}" class="hover:text-lumen">Blog</a></li>
                    <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                    <li aria-current="page" class="font-semibold text-white truncate max-w-[10rem] sm:max-w-xs">{{ $post->title }}</li>
                </ol>
            </nav>

            <div class="flex flex-wrap items-center gap-4 mt-10">
                <span class="px-3 py-1 text-xs font-semibold tracking-widest uppercase rounded-full bg-lumen text-ink-950">{{ $post->category }}</span>
                <time datetime="{{ $post->created_at->toIso8601String() }}" class="text-sm text-white/70">
                    {{ Carbon::parse($post->created_at)->translatedFormat('d \d\e F \d\e Y') }}
                </time>
            </div>

            <h1 data-split class="mt-6 text-4xl break-words display md:text-6xl">{{ $post->title }}</h1>
            @if ($post->excerpt)
                <p class="max-w-2xl mt-6 text-lg text-white/75">{{ $post->excerpt }}</p>
            @endif
        </div>
    </header>

    <article class="container relative max-w-4xl px-6 mx-auto -mt-16 lg:-mt-24">
        @if ($postImage)
            <img src="{{ $postImage }}" alt="{{ $post->title }}"
                style="view-transition-name: post-{{ $post->id }}; view-transition-class: vt-shared"
                class="object-cover w-full shadow-2xl rounded-[2rem] aspect-[16/9] ring-1 ring-black/5" fetchpriority="high" decoding="async" width="896" height="504">
        @endif

        <div class="px-2 py-12 sm:px-8">
            <div class="prose prose-lg max-w-none prose-headings:font-bold prose-headings:tracking-tight prose-a:text-brand dark:prose-a:text-lumen prose-img:rounded-2xl text-gray-700 dark:prose-invert dark:text-gray-300">
                {!! $post->content !!}
            </div>

            <div class="flex flex-wrap items-center justify-between gap-6 pt-8 mt-12 border-t border-gray-200 dark:border-white/10">
                <x-share-bar :title="$post->title" />
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 font-semibold transition-all text-brand dark:text-lumen hover:gap-3"><span aria-hidden="true">&larr;</span> Volver al blog</a>
            </div>
        </div>
    </article>

    {{-- Más entradas --}}
    @if ($related->isNotEmpty())
        <section class="py-20 mt-8 bg-gray-100 dark:bg-gray-950" aria-labelledby="mas-entradas">
            <div class="container px-6 mx-auto">
                <p class="eyebrow reveal">Sigue leyendo</p>
                <h2 id="mas-entradas" class="mt-4 text-3xl display md:text-5xl text-ink-900 dark:text-white reveal">Más entradas</h2>

                <div class="grid gap-6 mt-10 md:grid-cols-3">
                    @foreach ($related as $item)
                        <a href="{{ route('blog.show', $item->slug) }}" style="--i: {{ $loop->index }}" class="reveal card-lift group relative block overflow-hidden rounded-3xl aspect-[4/5] bg-ink-900">
                            @if ($item->image)
                                <img class="absolute inset-0 object-cover w-full h-full transition-transform duration-700 group-hover:scale-110" src="{{ Media::url($item->image) }}" alt="{{ $item->title }}" loading="lazy" decoding="async" width="400" height="500">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-ink-950 via-ink-950/40 to-transparent" aria-hidden="true"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                                <span class="text-xs font-semibold tracking-widest uppercase text-lumen">{{ $item->category }}</span>
                                <h3 class="mt-2 text-xl font-bold leading-snug">{{ $item->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>
