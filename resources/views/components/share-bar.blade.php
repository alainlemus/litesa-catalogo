@props(['title'])

@php
    $url = request()->fullUrl();
    $btn = 'inline-flex items-center justify-center w-9 h-9 lg:w-10 lg:h-10 rounded-full text-white transition-transform duration-200 hover:scale-110 active:scale-95';
@endphp

<div class="flex flex-wrap items-center gap-3" x-data="{ copied: false }">
    <span class="font-semibold text-gray-600 dark:text-gray-300">Compartir:</span>

    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir en Facebook" title="Compartir en Facebook" class="{{ $btn }} bg-blue-600 hover:bg-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>
    </a>

    <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($title) }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir en X" title="Compartir en X" class="{{ $btn }} bg-black hover:bg-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
    </a>

    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($url) }}&title={{ urlencode($title) }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir en LinkedIn" title="Compartir en LinkedIn" class="{{ $btn }} bg-blue-800 hover:bg-blue-900">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.327-.027-3.037-1.849-3.037-1.851 0-2.132 1.445-2.132 2.939v5.667H9.358V9h3.414v1.561h.049c.476-.899 1.637-1.849 3.37-1.849 3.602 0 4.267 2.369 4.267 5.455v6.285zM5.337 7.433c-1.144 0-2.069-.926-2.069-2.069 0-1.144.925-2.07 2.069-2.07 1.143 0 2.069.926 2.069 2.07 0 1.143-.926 2.069-2.069 2.069zm1.777 13.019H3.56V9h3.554v11.452zM22.225 0H1.771C.792 0 0 .771 0 1.723v20.549C0 23.229.792 24 1.771 24h20.451C23.2 24 24 23.229 24 22.271V1.723C24 .771 23.2 0 22.225 0z"/></svg>
    </a>

    <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}" target="_blank" rel="noopener noreferrer" aria-label="Compartir por WhatsApp" title="Compartir por WhatsApp" class="{{ $btn }} bg-[#25D366] hover:bg-[#1ebe57]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5" aria-hidden="true"><path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.02L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.54 0 4.93.99 6.74 2.76A9.94 9.94 0 0 1 22 12c0 5.52-4.48 10-10 10z"/></svg>
    </a>

    <button type="button" aria-label="Copiar enlace" title="Copiar enlace"
        @click="navigator.clipboard.writeText(@js($url)).then(() => { copied = true; setTimeout(() => copied = false, 1500) })"
        class="{{ $btn }} bg-gray-500 hover:bg-gray-600 cursor-pointer">
        <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
        <svg x-show="copied" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    </button>
    <span class="sr-only" role="status" x-text="copied ? 'Enlace copiado' : ''"></span>
</div>
