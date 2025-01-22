const  openModal = document.querySelector('.btn-agregar');
const  modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal_close');

openModal.addEventListener('click', (e)=>{
    e.preventDefault();
    modal.classList.add('modal--show');
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



