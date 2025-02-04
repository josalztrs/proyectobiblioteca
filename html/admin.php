<!DOCTYPE html>
<html lang="en">
<?php
include '../php/connection.php';


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/graficas.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../fontawasome/fontawesome-free-6.7.2-web/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/96ea2d2ec6.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Libros', 'Trabajos de Investigacion'],
                    <?php
                    $query = "SELECT 'Libros' AS table_name, COUNT(*) AS count
                    FROM libros
                    UNION ALL
                    SELECT 'Trabajos de Investigacion' AS table_name, COUNT(*) AS count
                    FROM otrosmateriales;";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "['".$row["table_name"]."', ".$row["count"]."],";
                    }
                    
                    
                    ?>
                ]);

                var options = {
                    title: 'Documentos',
                    is3d: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart-libros'));

                chart.draw(data, options);
                }
                </script>

                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Libros', 'Trabajos de Investigacion'],
                    <?php
                    $query = "SELECT COUNT(*) AS count, 'ESTUDIANTE' AS tipo FROM personas WHERE tipo = 'ESTUDIANTE'
UNION ALL
SELECT COUNT(*) AS count, 'INTERNO' AS tipo FROM  personas WHERE tipo = 'INTERNO'
UNION ALL
SELECT COUNT(*) AS count, 'EXTERNO' AS tipo FROM personas WHERE tipo = 'EXTERNO';";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "['".$row["tipo"]."', ".$row["count"]."],";
                    }
                    
                    
                    ?>
                ]);

                var options = {
                    title: 'Tipos de Personas',
                    is3d: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart-personas'));

                chart.draw(data, options);
                }
                </script>


    <!-- <script>
        // Función para cargar contenido HTML externo
        function loadHTML(elementId, file) {
            fetch(file)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById(elementId).innerHTML = data;
                })
                .catch(error => {
                    console.error('Hubo un problema con la petición Fetch:', error);
                });
        }
    </script> -->

</head>

<body id="body" >  
    
    <header>
        <?php include "header.php" ?>
    </header>

    <div class="menu__lateral" id="menu-lateral">
       <?php include "menu-lateral.php" ?>   
    </div>
    
    <div class="titulo">
        <div>
            <h1>
                <i class="fa-solid fa-gauge"></i>
                Panel de Administración
            </h1>
        </div>
    </div>
    
    <main>
        
        <div class="card">

            <div class="card-contend">
                <div class="card-section">                    
                    <a href="./Personas.php" onclick="highlightMenu(this)">
                        <i class="fa-solid fa-users" title="Personas"></i>   
                        <h4>Personas</h4>
                    </a>
                </div>
            </div>

            <div class="card-contend">
                <div class="card-section">                   
                    <a href="./libros.php" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-book" title="Libros"></i>
                        <h4>Libros</h4>
                    </a>
                </div>
            </div>

            <div class="card-contend">
                <div class="card-section">
                    <a href="./Tesis.php" onclick="highlightMenu(this)">
                        <i class="fa-solid fa-user-graduate" title="Tesis"></i>
                        <h4>Trabajos De Investigación</h4>
                    </a>

                </div>

            </div>

            <div class="card-contend">
                <div class="card-section"> 
                    <a href="./prestamos.php" onclick="highlightMenu(this)">
                        <i class="fa-solid fa-hourglass-half" title="Prestamos"></i>
                        <h4>Préstamos</h4>
                    </a>
                </div>
                
            </div>

            <div class="card-contend">
                <div class="card-section">
                    <a href="./reportes.php" onclick="highlightMenu(this)">
                        <i class="fa-regular fa-file" title="Reporte"></i>
                        <h4>Reporte</h4>
                    </a>
                </div>
            </div>
           
        </div>

        <!-- Graficas -->
        <div class="div-graficas">
            <section class="content-graficos">
                <h2>Documentos</h2>
                <div id="piechart-libros"></div>
            </section>

            <section class="content-graficos">
                <h2>Personas</h2>
                <div id="piechart-personas"></div>
            </section>

            <section class="content-graficos">
                <h2>Préstamos</h2>
                <div class="btn-grafi">
                    <button onclick="changeChartType('mychart3', 'bar')"><i class="fa-solid fa-chart-simple"></i></button>
                    <button onclick="changeChartType('mychart3', 'line')"><i class="fa-solid fa-chart-line"></i></button>
                    <button onclick="changeChartType('mychart3', 'pie')"><i class="fa-solid fa-chart-pie"></i></button>
                </div>
                <canvas id="mychart3"></canvas>
            </section>
        </div>
        
    </main>

    <footer>
    <?php include "footer.php" ?> 
    </footer>

    <script src="../js/rotar-icono-menu.js"></script>
    <script src="../js/mover_menu.js"></script> <!-- script para desplazar el menu  -->
    <script src="../js/graficos.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/notificaciones.js"></script>
    <!-- <script src="../js/pagina-hover.js"></script> -->
</body>
</html>