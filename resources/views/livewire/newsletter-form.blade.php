<div class="w-full">
    <div class="pt-4">
        <p class="py-4 text-gray-500">Suscribete al Newsletter y recibe las ultimas noticias</p>
        <form wire:submit.prevent="suscribe" method="POST">
            @csrf
            <input wire:model.defer="email" type="email" name="email" placeholder="Tu correo electrónico" required class="w-full p-2 border-gray-300 rounded border-1 lg:w-1/2 dark:text-white">
            <button class="w-full p-2 text-white bg-blue-500 rounded cursor-pointer lg:w-auto mt-2 " type="submit">Suscribirse</button>
        </form>

        @error('email')
            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
        @enderror

        @if($suscribed)
            <p class="mt-2 text-sm text-green-600">¡Gracias por suscribirte!</p>
        @endif
    </div>
</div>
