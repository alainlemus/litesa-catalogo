@props(['eyebrow' => null, 'title', 'subtitle' => null, 'crumbs' => []])

<header data-glow class="relative overflow-hidden text-white bg-ink-950">
    <div class="absolute rounded-full -top-32 -right-20 size-[28rem] bg-brand/40 blur-3xl" aria-hidden="true"></div>
    <div class="absolute rounded-full -bottom-40 left-10 size-[24rem] bg-lumen/15 blur-3xl" aria-hidden="true"></div>
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="container relative px-6 py-16 mx-auto lg:py-24 seq">
        @if ($crumbs)
            <nav aria-label="Breadcrumb" class="mb-8 overflow-x-auto whitespace-nowrap">
                <ol class="flex items-center text-sm text-white/70">
                    <li><a href="{{ route('home') }}" class="hover:text-lumen">Inicio</a></li>
                    @foreach ($crumbs as $label => $url)
                        <li aria-hidden="true" class="mx-3 text-white/30">/</li>
                        @if ($url)
                            <li><a href="{{ $url }}" class="hover:text-lumen">{{ $label }}</a></li>
                        @else
                            <li aria-current="page" class="font-semibold text-white">{{ $label }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
        @if ($eyebrow)<p class="eyebrow eyebrow-light">{{ $eyebrow }}</p>@endif
        <h1 data-split class="max-w-4xl mt-5 text-4xl display lg:text-6xl">{{ $title }}</h1>
        @if ($subtitle)<p class="max-w-2xl mt-5 text-lg text-white/75">{{ $subtitle }}</p>@endif
        {{ $slot }}
    </div>
</header>
