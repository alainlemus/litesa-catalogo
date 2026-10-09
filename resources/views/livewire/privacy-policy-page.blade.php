<div class="w-full bg-white dark:bg-gray-900">

    @section('title', 'Aviso de Privacidad | Grupo Litesa')
    @section('meta_description', 'Lee nuestro aviso de privacidad y conoce cómo protegemos tu información personal en Grupo Litesa.')

    <div class="container max-w-4xl px-4 py-12 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-gray-800 dark:text-white">Aviso de Privacidad</h1>

        @if ($privacyPolicy)
            <div class="prose text-gray-700 max-w-none dark:prose-invert dark:text-white">
                {!! $privacyPolicy !!}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-300">El aviso de privacidad no está disponible en este momento.</p>
        @endif
    </div>
</div>
