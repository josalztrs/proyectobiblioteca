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
            modaleditar.classList.toggle('modal-edit-lib');
        }
    });

    const filldata = (data) => {
        console.log(data[0].textContent);
        document.getElementById('edit-id').value = data[0].textContent;
        console.log(data[1].textContent);
        document.getElementById('edit-cota').value = data[1].textContent;
        console.log(data[2].textContent);
        document.getElementById('edit-titulo').value = data[2].textContent;
        console.log(data[3].textContent);
        document.getElementById('edit-autor').value = data[3].textContent;
        console.log(data[4].textContent);
        document.getElementById('edit-editorial').value = data[4].textContent;
        console.log(data[5].textContent);
        document.getElementById('edit-anio_edic').value = data[5].textContent;
        
        document.getElementById('edit-materia').value = data[6].getAttribute('value');
        
        document.getElementById('edit-descripcion').value = data[7].textContent;
    }
});