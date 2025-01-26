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
        console.log(data[2].textContent);
        document.getElementById('edit-cedula').value = data[2].textContent;

        console.log(data[1].textContent);
        document.getElementById('edit-nombres').value = data[1].textContent;

        console.log(data[3].textContent);
        document.getElementById('edit-telefono').value = data[3].textContent;

        console.log(data[4].textContent);
        document.getElementById('edit-email').value = data[4].textContent;

        console.log(data[5].textContent);
        document.getElementById('edit-tipo').value = data[5].textContent;

        
        if(document.getElementById('edit-tipo').value == 'ESTUDIANTE'){
            document.getElementById('edit-carrera').disabled = false;
            console.log(data[6].textContent);
            document.getElementById('edit-carrera').value = data[6].textContent;  
            document.getElementById('edit-cargo').disabled = true;
            document.getElementById('edit-cargo').value = "";
        } else if(data[5].textContent == 'INTERNO'){
            document.getElementById('edit-carrera').disabled = true;
            document.getElementById('edit-cargo').disabled = false;
            console.log(data[8].textContent);
            document.getElementById('edit-cargo').value = data[8].textContent;            
            document.getElementById('edit-carrera').value = "";   
        }

        console.log(data[7].textContent);
        document.getElementById('edit-direccion').value = data[7].textContent;

    }
});