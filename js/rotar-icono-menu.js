document.getElementById('btn-open').addEventListener('click', function() {
    const namePagIcon = document.querySelector('.name__pag i');
    namePagIcon.classList.add('rotate');

    // Remover la clase después de la animación para que se pueda volver a aplicar
    setTimeout(() => {
        namePagIcon.classList.remove('rotate');
    }, 500); // 500ms es el mismo tiempo que la animación
});