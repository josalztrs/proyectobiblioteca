const ctx = document.getElementById('mychart');
const ctx2 = document.getElementById('mychart2');
const ctx3 = document.getElementById('mychart3');

const names = ['Libros', 'Tesis'];
// const names = ['Libros', 'Tesis', 'Maria', 'Rosa', "Juan"];
const ages = [24, 10, 45, 13, 16];

let mychart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: names,
        datasets: [{
            label: 'Edad',
            data: ages,
            backgroundColor:[
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // 'rgba(255, 206, 86, 0.2)',
                // 'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)',
                // 'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                // 'rgba(255, 206, 86, 1)',
                // 'rgba(75, 192, 192, 1)',
                // 'rgba(153, 102, 255, 1)',
                // 'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1.5
        }]
    }
})

function changeChartType(type) {
    mychart.destroy(); // Destruir el gráfico actual
    // Ajustar el tamaño del canvas para el gráfico de torta
    
    mychart = new Chart(ctx, {
        type: type,
        data: {
            labels: names,
            datasets: [{
                label: 'Edad',
                data: ages,
                backgroundColor: type === 'pie' ? [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    // 'rgba(255, 206, 86, 0.2)',
                    // 'rgba(75, 192, 192, 0.2)',
                    // 'rgba(153, 102, 255, 0.2)',
                ] : [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: type === 'pie' ? [] : [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    // 'rgba(255, 206, 86, 1)',
                    // 'rgba(75, 192, 192, 1)',
                    // 'rgba(153, 102, 255, 1)',
                    // 'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1.5
            }]
        }
    });
}


