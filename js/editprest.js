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
        document.getElementById('edit-id').value = data[0].textContent;
        document.getElementById('placeholder').value = data[1].textContent;
        console.log(data[3]);
        document.getElementById('edit-cedula').value = data[3].textContent;
        console.log(data[1]);
        document.getElementById('edit-cota').value = data[1].textContent;
        console.log(data[5]);
        document.getElementById('edit-fechaprest').value = data[5].textContent;
        console.log(data[6]);
        document.getElementById('edit-fechaent').value = data[6].textContent;
        console.log(data[7]);
        document.getElementById('edit-estado').value = data[7].textContent;
    }
});