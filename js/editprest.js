document.addEventListener('DOMContentLoaded', () => {
    const table = document.querySelector('.tabla-A');
    const modaleditar = document.getElementById('modal-edit');
    const inputs = document.querySelectorAll('input');

    table.addEventListener("click", (e) => {
        if (e.target.closest('.editBtn')) {
            e.stopPropagation();
            let data = e.target.closest('tr').children;
            console.log(data);
            filldata(data);
            modaleditar.classList.toggle('modal-edit');
        }
    });

    const filldata = (data) => {
        console.log(data[3]);
        document.getElementById('edit-cedula').value = data[3].textContent;
        console.log(data[1]);
        document.getElementById('edit-cota').value = data[1].textContent;
        console.log([5]);
        document.getElementById('edit-fecha_prest').value = data[5].textContent;
        console.log([6]);
        document.getElementById('edit-fecha_ent').value = data[6].textContent;
    }
});