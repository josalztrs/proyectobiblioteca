const names = ['Libros', 'Tesis'];
const names2 = ['Estudiantes', 'Internos','Externos'];
const ages = [24, 10, 45, 13, 16];

let charts = {
    mychart: new Chart(document.getElementById('mychart'), {
        type: 'bar',
        data: {
            labels: names,
            datasets: [{
                label: 'dato',
                data: ages,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1.5
            }]
        }
    }),
    mychart2: new Chart(document.getElementById('mychart2'), {
        type: 'bar',
        data: {
            labels: names2,
            datasets: [{
                label: 'dato2',
                data: ages,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 235, 63, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgb(54, 235, 63)',
                ],
                borderWidth: 1.5
            }]
        }
    }),
    mychart3: new Chart(document.getElementById('mychart3'), {
        type: 'bar',
        data: {
            labels: names,
            datasets: [{
                label: 'dato3',
                data: ages,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1.5
            }]
        }
    })
};

function changeChartType(chartId, type) {
    charts[chartId].destroy(); // Destruir el gráfico actual

    charts[chartId] = new Chart(document.getElementById(chartId), {
        type: type,
        data: {
            labels: names,
            datasets: [{
                label: 'Edad',
                data: ages,
                backgroundColor: type === 'pie' ? [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                   
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
                  
                ],
                borderWidth: 1.5
            }]
        }
    });
}

