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
    
   <script>
        document.getElementById('notificaciones').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar el comportamiento por defecto del enlace
    const notificacionesList = document.getElementById('notificaciones-list');
    notificacionesList.style.display = notificacionesList.style.display === 'block' ? 'none' : 'block';
});

// Cerrar la lista de notificaciones si se hace clic fuera de ella
document.addEventListener('click', function(event) {
    const notificacionesList = document.getElementById('notificaciones-list');
    const notificacionesLink = document.getElementById('notificaciones');
    if (!notificacionesLink.contains(event.target) && !notificacionesList.contains(event.target)) {
        notificacionesList.style.display = 'none';
    }
});
   </script>
    
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
                        <h4>Prestamos</h4>
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
        <div  class="div-graficas">
            <section class="content-graficos">
                <h2>Documentos</h2>
                <div>
                    <button onclick="changeChartType('mychart','bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('mychart','line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('mychart','pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart" ></canvas>
             </section>

             <section class="content-graficos">
                <h2>Personas</h2>
                <div>
                    <button onclick="changeChartType('mychart2','bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('mychart2','line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('mychart2','pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart2" ></canvas>
             </section>

             <section class="content-graficos">
                <h2>Prestamos</h2>
                <div>
                    <button onclick="changeChartType('mychart3','bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('mychart3','line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('mychart3','pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart3" ></canvas>
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
    <!-- <script src="../js/pagina-hover.js"></script> -->
</body>
</html>