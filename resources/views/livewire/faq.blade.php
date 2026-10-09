<div>
    @php
        $jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP;
        $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $faqs->map(fn ($f) => [
            '@type' => 'Question', 'name' => $f->question, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->answer],
        ])->all()];
    @endphp

    @section('title', 'Preguntas frecuentes | Grupo Litesa')
    @section('meta_description', 'Resuelve tus dudas sobre cotizaciones, garantía, certificaciones y productos de iluminación de Grupo Litesa.')
    @push('head')<script type="application/ld+json">{!! json_encode($schema, $jsonFlags) !!}</script>@endpush

    <x-page-header eyebrow="Ayuda" title="Preguntas frecuentes" subtitle="Respuestas rápidas a las dudas más comunes." :crumbs="['Preguntas frecuentes' => null]" />

    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="container max-w-3xl px-6 mx-auto space-y-4">
            @foreach ($faqs as $faq)
                <details style="--i: {{ $loop->index % 3 }}" class="reveal group p-6 bg-gray-50 border border-gray-200 rounded-2xl open:bg-white open:shadow-lg dark:bg-ink-900 dark:border-white/10 dark:open:bg-ink-800 transition-colors" @if ($loop->first) open @endif>
                    <summary class="flex items-center justify-between gap-4 text-lg font-bold list-none cursor-pointer text-ink-900 dark:text-white [&::-webkit-details-marker]:hidden">
                        {{ $faq->question }}
                        <span class="flex items-center justify-center transition-transform duration-300 rounded-full size-8 shrink-0 bg-brand/10 text-brand dark:bg-lumen/15 dark:text-lumen group-open:rotate-45" aria-hidden="true">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                        </span>
                    </summary>
                    <p class="mt-4 leading-relaxed text-gray-600 dark:text-gray-300">{{ $faq->answer }}</p>
                </details>
            @endforeach
        </div>
    </section>

    <x-cta-band title="¿Sigues con dudas?" text="Escríbenos y con gusto te ayudamos." />
</div>
