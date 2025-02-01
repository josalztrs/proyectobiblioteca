const  openModal = document.querySelector('.btn-agregar');
const  modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal_close');
const fechaPrestamo = document.getElementById('fechaPrestamo');
const fechaEntrega = document.getElementById('fechaEntrega');

openModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.add('modal--show');

    // Obtener la fecha actual en formato YYYY-MM-DD
    const today = new Date().toISOString().split('T')[0];
    fechaPrestamo.value = today;

    // Calcular la fecha de entrega sumando 3 días
    const entregaDate = new Date();
    entregaDate.setDate(entregaDate.getDate() + 3); // Sumar 3 días
    const entregaDateString = entregaDate.toISOString().split('T')[0]; // Formato YYYY-MM-DD
    console.log("Fecha de entrega:", entregaDateString);
    fechaEntrega.value = entregaDateString; 
});

closeModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.remove('modal--show');
});

// Modal de editar
const modalEdit = document.getElementById('modal-edit');
function editPerson(id) {
    modalEdit.classList.add('modal--show');
}
// Cerrar el modal de edición
document.getElementById('cancelar-edit').addEventListener('click', (e) => {
    e.preventDefault();
    modalEdit.classList.remove('modal--show');
});

     // modal eliminar registro
     const modalDelet = document.getElementById('modal-Delete');
     function deletPerson() {
         modalDelet.classList.add('modal--show');
         
     }
     //  cerrando modal eliminar registro
     document.getElementById('cancelar-delete').addEventListener('click', (e) =>{
         e.preventDefault();
         modalDelet.classList.remove('modal--show');
     });
     // confirmar ELiminar
     document.querySelector('#modal-Delete button[type="submit"]').addEventListener('click', (e) => {
         e.preventDefault();
         
         modalDelet.classList.remove('modal--show'); // Cerrar el modal
     });


// select del formulario registrar persona
function toggleInput() {
    const tipoSelect = document.getElementById('tipo-persona');
    const carreraInput = document.getElementById('tipo-carrera');
    const cargoInput = document.getElementById('tipo-cargo');

    // Deshabilitar ambos selects al inicio
    carreraInput.disabled = true;
    cargoInput.disabled = true;

    // Limpiar los valores de los selects
    carreraInput.value = '';
    cargoInput.value = '';


    // Verificar la opción seleccionada
    if (tipoSelect.value === 'estudiante') {
        carreraInput.disabled = false; 
    } else if (tipoSelect.value === 'interno') {
        cargoInput.disabled = false; 
    }
}

function toggleInput_Edit() {
    const tipoSelect = document.getElementById('edit-tipo');
    const carreraSelect = document.getElementById('edit-carrera');
    const cargoSelect = document.getElementById('edit-cargo');

    // Deshabilitar ambos selects al inicio
    carreraSelect.disabled = true;
    cargoSelect.disabled = true;

    // Limpiar los valores de los selects
    carreraSelect.value = '';
    cargoSelect.value = '';

    // Verificar  opción seleccionada
    if (tipoSelect.value === 'ESTUDIANTE') {
        carreraSelect.disabled = false; 
    } else if (tipoSelect.value === 'INTERNO') {
        cargoSelect.disabled = false; 
    } 
}

// Validar que solo acepte la entrada de numeros
function ValidarNumeros(event){
    let charCode  = (event.which) ?event.which : event.keyCode;
        if(charCode <48 || charCode > 57){
            event.preventDefault();
            return false;
        }
        return true;
   } 

function ValidarCedula(event) {
    let charCode = (event.which) ? event.which : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        event.preventDefault();
        return false;
    }
} 



