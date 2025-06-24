<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - Litesa</title>
    <link rel="icon" type="image/x-icon" href="storage/favicon.png">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="flex flex-col w-full min-h-screen font-sans bg-gray-100">

    <div class="flex-grow">
        {{ $slot }}
    </div>

   <!-- Footer -->
   <footer class="w-full p-4 text-white bg-[var(--color-primary)] shadow py-12 lg:py-4">
        <div class="container flex flex-col items-center justify-between mx-auto space-y-2 sm:flex-row sm:space-y-0">
            <a href="https://grupolitesa.com.mx" target="_blank" class="p-2 bg-white rounded">
                <img src="{{ asset('storage/litesa.png') }}" alt="Litesa Logo" class="h-10">
            </a>
            <p class="text-sm text-center">© Todos los derechos reservados — <a class="underline hover:text-gray-300" href="https://grupolitesa.com.mx" target="_blank">Grupo Litesa S.A. de C.V.</a></p>
        </div>
    </footer>

    @livewireScripts

</body>
</html>