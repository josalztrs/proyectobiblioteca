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
    <link rel="stylesheet" href="/fontawasome/fontawesome-free-6.7.2-web/css/all.css">
    <script src="https://kit.fontawesome.com/96ea2d2ec6.js" crossorigin="anonymous"></script>
              <!-- link para poder usar la libreria chartjs -->
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

<body id="body" >  <!--onload="loadHTML('header', 'header.html'); loadHTML('menu', 'menu-lateral.html');"  <div id="header"></div> <div id="menu"></div> -->
    
    <header>
        <div class="icono__menu" id="btn-open">
            <i class="fa-solid fa-bars"></i>
        </div>

        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-bell" title="Notificaciones"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-user" title="Perfil"></i>
                </a></li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-right-from-bracket" title="Salir"></i>
                </a>
            </li>
        </ul>
   </header>

    <div class="menu__lateral" id="menu-lateral">
       
        <div class="name__pag">
            <i class="fa-solid fa-earth-americas"></i>
            <h4>Biblioteca</h4>
            
        </div>

        <ul class="opciones__menu">
            <li>
                <a href="./admin.php" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-house" title="Inicio"></i>
                    <h4>Inicio</h4>
                </a>
            </li>
            <li>
                <a href="#" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-hourglass-half" title="Prestamos"></i>
                    <h4>Prestamos</h4>
                </a>
            </li>
            <li>
                <a href="./Personas.php" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-users" title="Personas"></i>
                    <h4>Personas</h4>
                </a>
            </li>
            <li>
                <a href="#" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-book" title="Libros"></i>
                    <h4>Libros</h4>
                </a>
            </li>
            <li>
                <a href="#" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-solid fa-user-graduate" title="Tesis"></i>
                    <h4>Tesis</h4>
                </a>
            </li>

            <li>
                <a href="#" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-regular fa-rectangle-list" title="Materias"></i>
                    <h4>Materias</h4>
                </a>
            </li>
            <li>
                <a href="#" class="menu-item" onclick="highlightMenu(this)">
                    <i class="fa-regular fa-file" title="Reporte"></i>
                    <h4>Reporte</h4>
                </a>
            </li>
        </ul>
    </div>
    
    <script src="../js/mover_menu.js"></script> <!-- script para desplazar el menu  -->
    <div class="titulo">
        <div>
            <h1>
                <i class="fa-solid fa-gauge"></i>
                Panel de Administracion
            </h1>
        </div>
    </div>

    <main>
        
        <div class="card">

            <div class="card-contend">
                <div class="card-section">
                    <i class="fa-solid fa-hourglass-half" title="Prestamos"></i>
                    <a href="#">
                        <h4>Prestamos</h4>
                    </a>
                </div>
                
            </div>

            <div class="card-contend">

                <div class="card-section">
                    <i class="fa-solid fa-users" title="Personas"></i>
                    <a href="./Personas.php" onclick="highlightMenu(this)">
                        <h4>Personas</h4>
                    </a>

                </div>

            </div>

            <div class="card-contend">

                <div class="card-section">
                    <i class="fa-solid fa-book" title="Libros"></i>
                    <a href="">
                        <h4>Libros</h4>
                    </a>
                </div>

            </div>

            <div class="card-contend">

                <div class="card-section">

                    <i class="fa-solid fa-user-graduate" title="Tesis"></i>
                    <a href="#">
                        <h4>Tesis</h4>
                    </a>

                </div>

            </div>

            <div class="card-contend">
                <div class="card-section">
                    <i class="fa-regular fa-file" title="Reporte"></i>
                    <a href="#">
                        <h4>Materias</h4>
                    </a>
                </div>
            </div>
           
        </div>

        <!-- Graficas -->
        <div  class="div-graficas">
            <section class="content-graficos">
                <h2>Registros de Libros/Tesis</h2>
                <div>
                    <button onclick="changeChartType('bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart" ></canvas>
             </section>

             <section class="content-graficos">
                <h2>Registros de...</h2>
                <div>
                    <button onclick="changeChartType('bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart" ></canvas>
             </section>

             <section class="content-graficos">
                <h2>Registros de</h2>
                <div>
                    <button onclick="changeChartType('bar')">Gráfico de Barras</button>
                    <button onclick="changeChartType('line')">Gráfico de Líneas</button>
                    <button onclick="changeChartType('pie')">Gráfico de Torta</button>
                </div>
                    <canvas id="mychart" ></canvas>
             </section>
        </div>
        <script src="../js/graficos.js"></script>
    </main>
    <script src="../js/rotar-icono-menu.js"></script>
</body>
</html>

<!-- <i class="fa-solid fa-bars"></i> icono menu
<i class="fa-solid fa-house" title="Inicio"></i> icono Inicio
<i class="fa-solid fa-hourglass-half" title="Prestamos"></i> iconos Prestamos
<i class="fa-solid fa-users" title="Personas"></i> iconos Personas
<i class="fa-solid fa-book" title="Libros"></i> iconos Libros
<i class="fa-regular fa-rectangle-list" title="Materias"></i> iconos Materias
<i class="fa-regular fa-file" title="Reporte"></i> icono reporte -->
