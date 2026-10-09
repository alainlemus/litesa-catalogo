@props(['title' => '¿Listo para iluminar tu proyecto?', 'text' => 'Cuéntanos qué necesitas y un asesor te responderá a la brevedad.'])

<section class="relative py-20 overflow-hidden text-white bg-gradient-to-br from-brand via-ink-800 to-ink-950">
    <div class="absolute rounded-full -top-24 right-1/4 size-96 bg-lumen/20 blur-3xl" aria-hidden="true"></div>
    <div class="container relative px-6 mx-auto text-center reveal">
        <h2 class="max-w-3xl mx-auto text-3xl display md:text-5xl">{{ $title }}</h2>
        <p class="max-w-xl mx-auto mt-4 text-lg text-white/75">{{ $text }}</p>
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <a href="{{ route('contact') }}" class="btn-lumen">Solicitar cotización</a>
            <a href="{{ route('ilumination.catalog') }}" class="btn-ghost">Ver catálogo</a>
        </div>
    </div>
</section>
