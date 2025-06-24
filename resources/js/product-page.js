function bindTabEvents() {
    window.showTab = function (tabName) {
        // Ocultar todas las pestañas
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // Quitar clase activa de todos los botones
        document.querySelectorAll('.tab-trigger').forEach(trigger => {
            trigger.classList.remove('active');
        });

        // Activar contenido de la pestaña
        const content = document.getElementById(tabName);
        if (content) content.classList.add('active');

        // Activar botón correspondiente
        document.querySelectorAll('.tab-trigger').forEach(trigger => {
            if (trigger.getAttribute('onclick')?.includes(tabName)) {
                trigger.classList.add('active');
            }
        });
    };
}

// Ejecutar al inicio (carga inicial)
document.addEventListener("DOMContentLoaded", () => {
    console.log("Script cargado");
    bindTabEvents();
});

// Re-ejecutar cada vez que Livewire actualiza el DOM
Livewire.hook('message.processed', () => {
    console.log("Livewire volvió a renderizar el DOM");
    bindTabEvents();
});
