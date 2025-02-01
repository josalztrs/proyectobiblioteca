
const openModal_mat = document.querySelector('.btn-AgMat');
const modal_mat = document.getElementById('RegisMat'); 
const closeModal_mat = document.getElementById('cancelar-AggMat'); 


openModal_mat.addEventListener('click', (e) => {
    e.preventDefault();
    modal_mat.classList.add('modal--show'); 
});


closeModal_mat.addEventListener('click', (e) => {
    e.preventDefault();
    modal_mat.classList.remove('modal--show'); 
});
