function setupLogoutConfirmation() {
    document.getElementById('salir').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del enlace
        const confirmExit = confirm("¿Estás seguro de que deseas salir?");
        if (confirmExit) {
            // Aquí puedes redirigir a otra página o realizar otra acción
            alert("Has salido."); // Mensaje de salida (puedes cambiarlo o eliminarlo)
            // Por ejemplo, redirigir a otra página:
            window.location.href = '../index.php';
        } else {
            alert("Has cancelado la salida."); // Mensaje si se cancela
        }
    });
}

// Asegúrate de que la función se ejecute después de que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    setupLogoutConfirmation();
});