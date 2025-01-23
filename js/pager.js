let currentPage = 1;
let rowsPerPage = 5; // Cambia este valor según cuántas filas quieras mostrar por página
const tableBody = document.getElementById('tabla-B');
const rows = Array.from(tableBody.getElementsByTagName('tr'));

function displayPage(page) {
    // Ocultar todas las filas
    rows.forEach(row => row.style.display = 'none');

    // Calcular el índice de inicio y fin
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    // Mostrar solo las filas de la página actual
    for (let i = start; i < end && i < rows.length; i++) {
        rows[i].style.display = '';
    }

    // Actualizar la información de la página
    document.getElementById('pageInfo').innerText = `Pág ${page} / ${Math.ceil(rows.length / rowsPerPage)}`;
}

function changePage(direction) {
    currentPage += direction;

    // Asegurarse de que la página actual esté dentro de los límites
    if (currentPage < 1) currentPage = 1;
    if (currentPage > Math.ceil(rows.length / rowsPerPage)) currentPage = Math.ceil(rows.length / rowsPerPage);

    displayPage(currentPage);
}

function updateRows() {
    rowsPerPage = parseInt(document.getElementById('rows').value);
    currentPage = 1; // Reiniciar a la primera página
    displayPage(currentPage);
}

// Inicializar la tabla mostrando la primera página
displayPage(currentPage);