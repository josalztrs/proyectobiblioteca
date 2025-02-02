// Datos para los gráficos
const names = ['Libros', 'Tesis'];
const names2 = ['Estudiantes', 'Internos', 'Externos'];
const ages = [24, 10]; // Datos para documentos
const ages2 = [30, 15, 25]; // Datos para personas
const ages3 = [40, 20]; // Datos para préstamos (prestados y devueltos)

// Colores para los gráficos
const colors = {
    bar: [
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)'
    ],
    pie: [
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)'
    ]
};

// Inicialización de gráficos
let charts = {
    mychart: createChart('mychart', 'bar', names, ages),
    mychart2: createChart('mychart2', 'bar', names2, ages2),
    mychart3: createChart('mychart3', 'bar', ['Activos', 'Devueltos'], ages3) // Cambiado para préstamos
};

// Función para crear un gráfico
function createChart(chartId, type, labels, data) {
    return new Chart(document.getElementById(chartId), {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: '',
                data: data,
                backgroundColor: type === 'pie' ? colors.pie : colors.bar,
                borderColor: type === 'pie' ? [] : colors.bar.map(color => color.replace(/0.6/, '1')), // Cambia la opacidad para el borde
                borderWidth: 1.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)', // Fondo del tooltip
                    titleColor: '#fff', // Color del título del tooltip
                    bodyColor: '#fff' // Color del cuerpo del tooltip
                }
            }
        }
    });
}

// Función para cambiar el tipo de gráfico
function changeChartType(chartId, type) {
    charts[chartId].destroy(); // Destruir el gráfico actual

    let labels, data;
    if (chartId === 'mychart') {
        labels = names;
        data = ages;
    } else if (chartId === 'mychart2') {
        labels = names2;
        data = ages2;
    } else if (chartId === 'mychart3') {
        labels = ['Activos', 'Devueltos']; // Etiquetas para préstamos
        data = ages3; // Datos para préstamos
    }

    charts[chartId] = createChart(chartId, type, labels, data);
}

// Asegúrate de que el código se ejecute después de que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Aquí puedes inicializar tus gráficos o cualquier otra lógica
});

