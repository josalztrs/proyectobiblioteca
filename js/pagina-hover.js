document.addEventListener('DOMContentLoaded', () => {
    const fadeOutDuration = 500; // Duración de la animación en milisegundos

    // Función para redirigir con animación
    function redirectWithFade(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del enlace
        const url = this.href; // Obtener la URL del enlace
        document.body.classList.add('fade-out');
        setTimeout(() => {
            window.location.href = url;
        }, fadeOutDuration);
    }

    // Agregar evento a todos los enlaces con la clase 'link'
    const links = document.querySelectorAll('.menu-item');
    links.forEach(link => {
        link.addEventListener('click', redirectWithFade);
    });
    // document.body.classList.add('fade-in');
});