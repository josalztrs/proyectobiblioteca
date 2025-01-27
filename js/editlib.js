document.addEventListener('DOMContentLoaded', () => {
    const table = document.querySelector('.tabla-A');
    const modaleditar = document.getElementById('modal-edit-lib');
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
        console.log(data[0].textContent);
    }
});