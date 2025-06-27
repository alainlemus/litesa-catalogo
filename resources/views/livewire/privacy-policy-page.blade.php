<div class="w-full bg-white dark:bg-gray-900">

    @php
        $siteSettings = \App\Models\SiteSetting::first();
        $imageLogo =$siteSettings->logo_light;
    @endphp

    @section('title', 'Aviso de Privacidad - Grupo Litesa')
    @section('meta_description', 'Lee nuestro aviso de privacidad y conoce cómo protegemos tu información.')
    @section('og_title', 'Aviso de Privacidad - Grupo Litesa')
    @section('og_description', 'Lee nuestro aviso de privacidad y conoce cómo protegemos tu información.')
    @section('og_image',  App::environment('local') ? asset('site/' . ltrim($imageLogo, '/')) : Storage::disk('s3')->url($imageLogo))


    <div class="container max-w-4xl px-4 py-8 mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-gray-800 dark:text-white">Aviso de Privacidad</h1>

        @if ($privacyPolicy)
            <div class="prose text-gray-500 dark:prose-invert max-w-none dark:text-white">
                {!! $privacyPolicy !!}
            </div>
        @else
            <p class="text-gray-600 dark:text-gray-300">El aviso de privacidad no está disponible en este momento.</p>
        @endif
    </div>
</div>