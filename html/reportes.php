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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/cargadatosedit.js"></script>
    <script src="../js/busquedadinamica.js"></script>
    <link rel="stylesheet" href="../fontawasome/fontawesome-free-6.7.2-web/css/all.css">
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

    <main>
        <div class="main-rep">
            <div class="conten-repor">
                <div class="card-report">
                    <div class="card-contendReport">

                        <div class="card-sectionPrest">
                            <a href="../fpdf186/gen_pdf_librosprestados.php" target="_blank" >
                                <i class="fa-brands fa-leanpub" title="Libros Prestados"></i>
                                <h4>Libros Prestados</h4>
                            </a>

                        </div>

                    </div>

                    <div class="card-contendReport">

                        <div class="card-sectionPrest">
                            <a href="../fpdf186/gen_pdf_morosos.php" target="_blank">
                                <!-- <i class="fa-solid fa-users" title="Personas Morosas"></i> -->
                                <i class="fa-solid fa-face-angry"></i>
                                <h4>Personas Morosas</h4>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="contenedor-reportes">
                <div class="consulta"> <!-- Bloque para consultar los datos de la población -->
                    <section class="seccion-consulta">
                        <p class="titulo-biblioteca">Biblioteca Luis Beltran Prieto Figueroa</p>
                        <div class="hrCenter"><hr></div>
                        <p id="Tconsul">Consultar Persona</p>
                    </section>

                    <section class="seccion-buscar" id="seccion-buscar">
                        <input type="text" placeholder="Ingresa la cédula" id="CEDULA" name="CEDULA" maxlength="9" onkeypress="return ValidarNumeros(event)">
                        <button onclick="buscarCedula()">Buscar</button>
                    </section>

                    <section class="seccion-resultados" id="seccion-resultados">
                        <p id="resultado-consulta">Aquí aparecerán los datos consultados.</p>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include "footer.php" ?> 
    </footer>

    <script src="../js/mover_menu.js"></script>
    <script src="../js/pager.js"></script>
    <script src="../js/modal-persona.js"></script>
    <script src="../js/rotar-icono-menu.js"></script>
    <!-- <script src="../js/pagina-hover.js"></script> -->
    <script src="../js/header.js"></script>
</body>
</html>