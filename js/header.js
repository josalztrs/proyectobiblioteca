function setupLogoutConfirmation() {
    document.getElementById('salir').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el comportamiento por defecto del enlace
        const confirmExit = confirm("¿Estás seguro de que deseas salir?");
        if (confirmExit) {
            
            // alert("Has salido."); 
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