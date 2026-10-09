@php
    use App\Models\SiteSetting;
    use App\Support\Media;

    $livewire ??= null;
    $site = SiteSetting::current();
    $logoDark = Media::url($site?->logo_dark ?? $site?->logo_light);
    $logoLight = Media::url($site?->logo_light ?? $site?->logo_dark);
    $cover = Media::url('uploads/grua.webp') ?? Media::url($site?->share_image);
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <style>
        .ls { display: grid; min-height: 100vh; grid-template-columns: 1fr; font-family: inherit; }
        @media (min-width: 1024px) { .ls { grid-template-columns: 1.1fr 1fr; } }

        /* ---------- Panel de marca ---------- */
        .ls-brand {
            position: relative; display: none; flex-direction: column; justify-content: space-between;
            padding: 3rem; color: #fff; overflow: hidden; background: #06111d;
        }
        @media (min-width: 1024px) { .ls-brand { display: flex; } }
        .ls-brand-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; animation: ls-settle 1.6s cubic-bezier(.16,1,.3,1) both; }
        .ls-brand-shade {
            position: absolute; inset: 0;
            background:
                radial-gradient(40rem 24rem at 10% 100%, rgba(247,181,0,.28), transparent 60%),
                linear-gradient(160deg, rgba(6,17,29,.82) 0%, rgba(17,42,69,.72) 55%, rgba(6,17,29,.92) 100%);
        }
        .ls-brand > *:not(.ls-brand-img):not(.ls-brand-shade) { position: relative; }
        .ls-logo { height: 3rem; width: auto; }
        .ls-eyebrow { display: inline-flex; align-items: center; gap: .6rem; font-size: .75rem; font-weight: 600; letter-spacing: .18em; text-transform: uppercase; color: #f7b500; }
        .ls-eyebrow::before { content: ""; width: 2rem; height: 2px; background: currentColor; border-radius: 2px; }
        .ls-title { margin: 1.25rem 0 0; font-size: clamp(2.2rem, 3.4vw, 3.4rem); line-height: 1.05; font-weight: 800; letter-spacing: -.03em; }
        .ls-title em { font-style: normal; color: #f7b500; }
        .ls-text { margin-top: 1.25rem; max-width: 30rem; font-size: 1.05rem; line-height: 1.6; color: rgba(255,255,255,.75); }
        .ls-list { margin: 2rem 0 0; padding: 0; list-style: none; display: grid; gap: .8rem; }
        .ls-list li { display: flex; align-items: center; gap: .75rem; color: rgba(255,255,255,.85); font-size: .95rem; animation: ls-rise .8s cubic-bezier(.16,1,.3,1) both; }
        .ls-list li:nth-child(2) { animation-delay: .1s; } .ls-list li:nth-child(3) { animation-delay: .2s; }
        .ls-list svg { width: 1.5rem; height: 1.5rem; padding: .3rem; border-radius: 999px; background: #f7b500; color: #06111d; flex: none; }
        .ls-foot { font-size: .8rem; color: rgba(255,255,255,.5); }
        .ls-copy > * { animation: ls-rise .9s cubic-bezier(.16,1,.3,1) both; }
        .ls-copy > *:nth-child(2) { animation-delay: .08s; } .ls-copy > *:nth-child(3) { animation-delay: .16s; }

        /* ---------- Panel del formulario ---------- */
        .ls-form { display: flex; align-items: center; justify-content: center; padding: 2rem 1.5rem; background: #fff; position: relative; }
        .ls-form-inner { width: 100%; max-width: 26rem; animation: ls-rise .8s cubic-bezier(.16,1,.3,1) .15s both; }
        .ls-mobile-logo { display: block; height: 2.75rem; width: auto; margin: 0 auto 2rem; }
        @media (min-width: 1024px) { .ls-mobile-logo { display: none; } }
        .ls-back { position: absolute; top: 1.5rem; right: 1.75rem; font-size: .85rem; color: #6b7280; text-decoration: none; }
        .ls-back:hover { color: #196BAC; }

        /* Encabezado de Filament dentro del formulario */
        .ls-form .fi-simple-header { margin-bottom: 0; text-align: left; align-items: flex-start; }
        .ls-form .fi-simple-header-heading { font-size: 1.9rem; font-weight: 800; letter-spacing: -.02em; text-align: left; }
        .ls-form .fi-simple-header-subheading { text-align: left; }

        @keyframes ls-rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        @keyframes ls-settle { from { transform: scale(1.08); } to { transform: scale(1); } }
        @media (prefers-reduced-motion: reduce) { .ls *, .ls { animation: none !important; } }
    </style>

    <div class="ls">
        <aside class="ls-brand" aria-hidden="false">
            @if ($cover)
                <img class="ls-brand-img" src="{{ $cover }}" alt="" aria-hidden="true">
            @endif
            <div class="ls-brand-shade" aria-hidden="true"></div>

            <div>
                @if ($logoDark)
                    <img class="ls-logo" src="{{ $logoDark }}" alt="{{ $site?->title ?? 'Grupo Litesa' }}">
                @endif
            </div>

            <div class="ls-copy">
                <span class="ls-eyebrow">Panel de administración</span>
                <h2 class="ls-title">Administra tu sitio, <em>sin complicaciones.</em></h2>
                <p class="ls-text">Edita productos, entradas del blog, servicios y preguntas frecuentes desde un solo lugar.</p>
                <ul class="ls-list">
                    @foreach (['Catálogo y aplicaciones de iluminación', 'Blog, servicios y preguntas frecuentes', 'SEO y contenido del sitio'] as $item)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="ls-foot">© {{ date('Y') }} {{ $site?->title ?? 'Grupo Litesa' }}</p>
        </aside>

        <main class="ls-form">
            <a href="{{ url('/') }}" class="ls-back">← Volver al sitio</a>

            <div class="ls-form-inner">
                @if ($logoLight)
                    <img class="ls-mobile-logo" src="{{ $logoLight }}" alt="{{ $site?->title ?? 'Grupo Litesa' }}">
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $livewire?->getRenderHookScopes()) }}
</x-filament-panels::layout.base>
