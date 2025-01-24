<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pager.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/reportes.css">
    <script src="../js/cargadatosedit.js"></script>
    <script src="../js/busquedadinamica.js"></script>
    <link rel="stylesheet" href="/fontawasome/fontawesome-free-6.7.2-web/css/all.css">
    <script src="https://kit.fontawesome.com/96ea2d2ec6.js" crossorigin="anonymous"></script>
</head>
<body id="body">
    <header>
        <?php include "header.php" ?>
    </header>
    
    <!-- menu late -->
    <div class="menu__lateral" id="menu-lateral">
        <?php include "menu-lateral.php" ?>
    </div>
            
    <div class="titulo">
        <div>
            <h1>
                <i class="fa-solid fa-gauge"></i>
                Reportes
            </h1>
        </div>
    </div>

    <main id="main-repo">
        <div class="contenedor-reportes">
            <div class="card-reportes">
                <div class="card-contendReport">

                    <div class="card-sectionPrest">
                        <a href="#" >
                            <i class="fa-brands fa-leanpub" title="Libros Prestados"></i>
                            <h4>Libros Prestados</h4>
                        </a>

                    </div>

                </div>

                <div class="card-contendReport">

                    <div class="card-sectionPrest">
                        <a href="#">
                             <i class="fa-solid fa-users" title="Personas Morosas"></i>
                            <h4>Personas Morosas</h4>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="contenedor-reportes">
            <div class="consulta"> <!--Bloque para consultar los datos de la poblacion-->
                <section class="seccion-consulta">
                    <p>Registro Comunal</p>
                    <p id="Tconsul">consulta tus Datos</p>
                </section>
            <br>
            <hr id="hr2">
                <section class="seccion-buscar" id="seccion-buscar" >
                    <input type="text"  placeholder="ingresa la cedula"  id="CEDULA" name="CEDULA" maxlength="9" onkeypress = "return ValidarNumeros(event)">
                    <button onclick="buscarCedula()">Buscar</button>
                </section>
            
            </div>
        </div>
    </main>

    <script src="../js/mover_menu.js"></script>
    <script src="../js/pager.js"></script>
    <script src="../js/modal-persona.js"></script>
    <script src="../js/rotar-icono-menu.js"></script>
</body>
</html>