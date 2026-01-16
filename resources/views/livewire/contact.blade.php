<div>

    @section('title', 'Contacto - Grupo Litesa')
    @section('meta_description', 'Contactanos, estamos para escucharte y resolver tus dudas.')
    @section('og_title', 'Contacto - Grupo Litesa')
    @section('og_description', 'Contactanos, estamos para escucharte y resolver tus dudas.')
    @section('og_image', App::environment('local') ? asset('uploads/' . ltrim('grua.jpg', '/')) : Storage::disk('s3')->url('uploads/grua.jpg'))

    @section('twitter_card', 'summary_large_image')
    @section('twitter_title', 'Contacto - Grupo Litesa')
    @section('twitter_description', 'Contactanos, estamos para escucharte y resolver tus dudas.')
    @section('twitter_image', App::environment('local') ? asset('uploads/' . ltrim('grua.jpg', '/')) : Storage::disk('s3')->url('uploads/grua.jpg'))

    <section class="min-h-screen bg-cover" style="background-image: url('{{ App::environment('local')
            ? asset('storage/' . ltrim($formImage->path, '/'))
            : Storage::disk('s3')->url($formImage->path) }}')">

        <div class="flex flex-col min-h-screen bg-black/60">
            <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                    <div class="text-white lg:w-1/2 lg:mx-6">
                        <h1 class="text-2xl font-semibold capitalize lg:text-3xl">Necesitas nuestra asesoria</h1>

                        <p class="max-w-xl mt-6">
                            En Grupo Litesa estamos para escucharte y resolver tus dudas. Si tienes alguna pregunta, comentario o necesitas más información sobre nuestros servicios, no dudes en contactarnos. Nuestro equipo de asesores está listo para ayudarte en lo que necesites.
                        </p>

                        <div class="mt-6 md:mt-8">
                            <h3 class="text-gray-300 ">Siguenos</h3>

                            <div class="flex mt-4 -mx-1.5 ">
                                @php
                                    $siteSetting = \App\Models\SiteSetting::first();
                                    $socialNetworks = $siteSetting?->socials ?? [];
                                @endphp
                                @foreach ($socialNetworks as $network)
                                    <a href="{{ $network['url'] }}" target="_blank"
                                        class="mx-2 text-gray-300 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400"
                                        aria-label="{{ $network['name'] }}">
                                        {!! $network['svg'] !!}
                                    </a>
                                @endforeach
                                        </div>
                                    </div>
                                </div>

                    <div class="mt-8 lg:w-1/2 lg:mx-6 duration-300 fade-in-up">
                        <div class="w-full px-8 py-10 mx-auto overflow-hidden transition-colors duration-300 bg-white shadow-2xl rounded-xl dark:bg-gray-900 lg:max-w-xl">
                            <h1 class="text-xl font-medium text-gray-700 dark:text-gray-200">Formulario de contacto</h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Escribenos y un asesor se pondrá en contacto contigo a la brevedad posible.
                            </p>

                            <form wire:submit.prevent="sendMessage" class="mt-6">
                                <div class="flex-1">
                                    <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nombre completo</label>
                                    <input wire:model="name" type="text" placeholder="Carlos Carbajal" class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
                                    @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex-1 mt-6">
                                    <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Correo electronico</label>
                                    <input wire:model="email" type="email" placeholder="carlos@example.com" class="block w-full px-5 py-3 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" />
                                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div class="w-full mt-6">
                                    <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Mensaje</label>
                                    <textarea wire:model="message" class="block w-full h-32 px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md md:h-48 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring" placeholder="Mensaje"></textarea>
                                    @error('message') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div wire:ignore class="mt-4" id="recaptcha-container"></div>
                                <input type="hidden" wire:model="recaptcha" id="recaptcha-token">
                                @error('g-recaptcha-response')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror

                                <button
                                    class="w-full px-6 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled"
                                    wire:target="sendMessage"
                                >
                                    <span wire:loading.remove wire:target="sendMessage">Enviar</span>
                                    <span wire:loading wire:target="sendMessage">Enviando...</span>
                                </button>
                            </form>
                            <div
                                x-data="{ show: true }"
                                x-show="show"
                            >
                                @if (session()->has('success'))
                                    <div class="w-full mt-4 text-white bg-emerald-500">
                                        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                            <div class="flex">
                                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                                                    </path>
                                                </svg>

                                                <p class="mx-3">¡Mensaje enviado!</p>
                                            </div>

                                            <button @click="show = false" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @elseif (session()->has('error'))
                                    <div class="w-full mt-4 text-white bg-red-500">
                                        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                            <div class="flex">
                                                <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                                    </path>
                                                </svg>

                                                <p class="mx-3">Ocurrio un error, por favor vuelva a intentarlo.</p>
                                            </div>

                                            <button @click="show = false" class="p-1 transition-colors duration-300 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js?onload=initRecaptcha&render=explicit" async defer></script>

    <script>

        let recaptchaWidgetId;

        function onCaptchaVerified(token) {
            const el = document.getElementById('recaptcha-token');
            el.value = token;
            el.dispatchEvent(new Event('input', { bubbles: true }));

            Livewire.emit('captchaVerified', token);
        }

        function initRecaptcha() {
            if (typeof grecaptcha !== 'undefined') {
                recaptchaWidgetId = grecaptcha.render('recaptcha-container', {
                    'sitekey': '{{ env("RECAPTCHA_SITE_KEY") }}',
                    'callback': onCaptchaVerified,
                });
            }
        }

        document.addEventListener('livewire:load', function () {
            initRecaptcha();

            Livewire.on('resetRecaptcha', () => {
                if (typeof grecaptcha !== 'undefined' && recaptchaWidgetId !== undefined) {
                    grecaptcha.reset(recaptchaWidgetId);
                }
            });

        });
    </script>

    <style>
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: none;
            }
        }
    </style>

</div>
