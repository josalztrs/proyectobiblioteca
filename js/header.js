function setupLogoutConfirmation() {
    document.getElementById('salir').addEventListener('click', function(event) {
        event.preventDefault(); 
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas salir de la aplicación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                window.location.href = '../index.php';
            } else {

                Swal.fire(
                    'Cancelado',
                    'No has salido de la aplicación.',
                    'info'
                );
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupLogoutConfirmation();
});
// function setupLogoutConfirmation() {
//     document.getElementById('salir').addEventListener('click', function(event) {
//         event.preventDefault(); // Evitar el comportamiento por defecto del enlace
//         const confirmExit = confirm("¿Estás seguro de que deseas salir?");
//         if (confirmExit) {
            
//             // alert("Has salido."); 
//             window.location.href = '../index.php';
//         } else {
//             // alert("Has cancelado la salida."); // Mensaje si se cancela
//         }
//     });
// }
// // Asegúrate de que la función se ejecute después de que el DOM esté completamente cargado
// document.addEventListener('DOMContentLoaded', function() {
//     setupLogoutConfirmation();
// });