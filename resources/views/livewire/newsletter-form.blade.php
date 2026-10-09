<div class="w-full">
    <div class="pt-4">
        <p class="py-4 text-white/70">Suscríbete al newsletter y recibe las últimas noticias</p>

        <form wire:submit="suscribe" class="flex flex-col items-center justify-center gap-2 sm:flex-row">
            <label for="newsletter-email" class="sr-only">Correo electrónico</label>
            <input wire:model="email" id="newsletter-email" type="email" name="email" placeholder="Tu correo electrónico" autocomplete="email" required
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                class="w-full px-5 py-3 text-white placeholder-white/40 border rounded-full sm:w-1/2 lg:w-1/3 bg-white/10 border-white/20 focus:outline-none focus:ring-2 focus:ring-lumen">
            <button type="submit" wire:loading.attr="disabled" wire:target="suscribe"
                class="w-full cursor-pointer sm:w-auto btn-lumen disabled:opacity-60">
                <span wire:loading.remove wire:target="suscribe">Suscribirse</span>
                <span wire:loading wire:target="suscribe" class="inline-flex items-center gap-2"><svg class="w-4 h-4 spin" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity=".25"/><path d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>Enviando…</span>
            </button>
        </form>

        <div aria-live="polite">
            @error('email')
                <p role="alert" class="mt-2 text-sm text-red-300">{{ $message }}</p>
            @enderror

            @if ($suscribed)
                <p wire:transition class="mt-2 text-sm text-lumen">¡Gracias por suscribirte!</p>
            @endif
        </div>
    </div>
</div>
