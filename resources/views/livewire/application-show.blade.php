<div>
    @php
        use App\Support\Media;
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;
        $lower = mb_strtolower($use->name, 'UTF-8');
        $pageTitle = 'Iluminación LED para ' . $lower;
        $desc = $use->meta_description ?: 'Productos de iluminación LED de Grupo Litesa ideales para ' . $lower . '. Consulta especificaciones, garantía y variantes.';
        $intro = $use->description ?: $desc;
        $schema = ['@context' => 'https://schema.org', '@type' => 'CollectionPage', 'name' => $pageTitle, 'url' => route('ilumination.application', $use->slug),
            'mainEntity' => ['@type' => 'ItemList', 'itemListElement' => $products->values()->map(fn ($p, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'url' => route('product.show', $p->slug), 'name' => $p->name])->all()]];
        $breadcrumb = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Aplicaciones', 'item' => route('ilumination.applications')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $use->name, 'item' => route('ilumination.application', $use->slug)],
        ]];
    @endphp

    @section('title', $use->meta_title ?: \App\Support\Seo::title($pageTitle))
    @section('meta_description', $desc)
    @section('og_image', Media::url($use->image) ?? Media::url($products->first()?->photos->first()?->path) ?? '')
    @push('head')
        <script type="application/ld+json">{!! json_encode($schema, $jsonFlags) !!}</script>
        <script type="application/ld+json">{!! json_encode($breadcrumb, $jsonFlags) !!}</script>
    @endpush

    <x-page-header eyebrow="Aplicación" :title="$pageTitle" :subtitle="$intro" :crumbs="['Aplicaciones' => route('ilumination.applications'), $use->name => null]" />

    <section class="py-20 bg-gray-100 dark:bg-gray-950">
        <div class="container px-6 mx-auto">
            <nav class="flex flex-wrap gap-2 mb-10" aria-label="Otras aplicaciones">
                @foreach ($others as $other)
                    <a href="{{ route('ilumination.application', $other->slug) }}" class="px-4 py-1.5 text-sm font-medium transition-colors bg-white border border-gray-300 rounded-full text-gray-800 hover:border-brand hover:text-brand dark:bg-ink-900 dark:text-gray-100 dark:border-white/15 dark:hover:border-lumen dark:hover:text-lumen">{{ $other->name }}</a>
                @endforeach
            </nav>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($products as $product)
                    <x-product-card :product="$product" :index="$loop->index" />
                @empty
                    <p class="py-16 text-center text-gray-600 col-span-full dark:text-gray-300">Pronto agregaremos productos para esta aplicación.</p>
                @endforelse
            </div>
        </div>
    </section>

    <x-cta-band :title="'¿Proyecto de ' . $lower . '?'" />
</div>
