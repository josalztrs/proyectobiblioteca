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
                window.location.href = '../php/cerrarses.php';
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

function confirmDelete(id, query) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Deseas eliminar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire(
            //     'Se ha eliminado Exitosamente'
            // );
            // Si el usuario confirma, se envía el formulario
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = query;
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();

            

        } else {
            Swal.fire(
                'Cancelado',
                'No se ha eliminado el registro.',
                'info'
            );
        }
    });
}

function Estado_Cambiado() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Deseas eliminar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire(
            //     'Se ha eliminado Exitosamente'
            // );
            // Si el usuario confirma, se envía el formulario
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = query;
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();

            

        } else {
            Swal.fire(
                'Cancelado',
                'No se ha eliminado el registro.',
                'info'
            );
        }
    });
}
