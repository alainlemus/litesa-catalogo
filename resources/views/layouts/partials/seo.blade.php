@php
    use App\Support\Media;

    $siteName = $site?->title ?: config('app.name');
    $pageTitle = trim($__env->yieldContent('title'));
    $title = $pageTitle !== '' ? $pageTitle : $siteName;
    $description = trim($__env->yieldContent('meta_description')) ?: ($site?->description ?? '');

    $ogTitle = trim($__env->yieldContent('og_title')) ?: $title;
    $ogDescription = trim($__env->yieldContent('og_description')) ?: $description;
    $ogImage = trim($__env->yieldContent('og_image'))
        ?: Media::url($site?->share_image)
        ?: asset('img/litesa-logo.png');
    $ogType = trim($__env->yieldContent('og_type')) ?: 'website';

    // Canonical: sin filtros ni búsquedas; solo conserva la paginación
    $filtered = request()->hasAny(['search', 'selectedUse', 'selectedCategory']);
    $pageNumber = request()->integer('page', 1);
    $canonical = trim($__env->yieldContent('canonical')) ?: (request()->path() === '/' ? url('/') . '/' : url()->current()) . ($pageNumber > 1 && ! $filtered ? '?page=' . $pageNumber : '');
    $robots = trim($__env->yieldContent('robots')) ?: ($filtered ? 'noindex, follow' : 'index, follow, max-image-preview:large, max-snippet:-1');
@endphp
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="theme-color" content="#196BAC">

<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="es_MX">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImage }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ trim($__env->yieldContent('twitter_title')) ?: $ogTitle }}">
<meta name="twitter:description" content="{{ trim($__env->yieldContent('twitter_description')) ?: $ogDescription }}">
<meta name="twitter:image" content="{{ trim($__env->yieldContent('twitter_image')) ?: $ogImage }}">

@php
    $sameAs = collect($site?->socials ?? [])->pluck('url')->filter()->values()->all();
    $organization = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => url('/') . '#organization',
        'name' => $siteName,
        'url' => url('/'),
        'logo' => Media::url($site?->logo_light),
        'description' => $site?->description,
        'email' => $site?->contact_email,
        'telephone' => $site?->contact_phone,
        'address' => $site?->contact_address ? [
            '@type' => 'PostalAddress',
            'streetAddress' => $site->contact_address,
            'addressCountry' => 'MX',
        ] : null,
        'sameAs' => $sameAs ?: null,
    ]);
    $website = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => $siteName,
        'inLanguage' => 'es-MX',
        'publisher' => ['@id' => url('/') . '#organization'],
    ];
    $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;
@endphp
<script type="application/ld+json">{!! json_encode($organization, $jsonFlags) !!}</script>
<script type="application/ld+json">{!! json_encode($website, $jsonFlags) !!}</script>
