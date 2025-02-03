<!DOCTYPE html>
<html lang="en">
<?php
include '../php/connection.php';

$prestamos = [];
$query =    "SELECT DISTINCT prestamos.id AS prestamo_id, prestamos.fecha_prestamo, prestamos.fecha_entrega, prestamos.estado, 
            personas.nombre AS persona_nombre, personas.cedula AS persona_cedula, libros.titulo AS libro_titulo, 
            libros.cota AS libro_cota FROM prestamos 
            INNER JOIN personas ON prestamos.cedula = personas.cedula 
            INNER JOIN libros ON prestamos.cota = libros.cota;";

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $prestamos[] = $row;
    }
    $result->free();
} else {
    echo 'Query failed: ' . $conn->error;
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pager.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/editprest.js"></script>
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
                Registros De Prestamos
            </h1>
        </div>
    </div>

    <main>
        <button class="btn-agregar" type="button" onclick="openModal()" title="Resgistrar">
            <i class="fa-solid fa-plus"></i>
            <span class="btn-text">Realizar Prestamo</span>
        </button> 
     <!-- modal registrar -->
        <section class="modal "  id="modal">
            <div class="modal_container">  
                <section class="modal-header">
                    <h2 class="modal_title"> Registrando Prestamo</h2>
                    <button class="modal_close" id="cancelar"> <i class="fa-solid fa-xmark"></i></button>
                </section>
                    
                <section class="modal-body">
                    <form action="../php/nuevprest.php" method="POST" class="form-Persona" id="formPersona">    
                        <section>
                            <input type=hidden name="id" id="id" value="">
                            <input type=hidden name="estado" id="estado" value="">
                            <input type=hidden name="placeholder" id="placeholder" value="">
                            <label for="">Cédula</label>
                            <input type="text" name='cedula' placeholder="xxxxxxxx" pattern="\d{7,8}" title="La cedula debe tener al menos 7 digitos" required>
                            <label for="">Cota</label>
                            <input type="text" name='cota' placeholder="xxxxxxxx" pattern="[A-Za-z0-9]{4}-[A-Za-z0-9]{4}" title="El formato del codigo es XXXX-XXXX" >
                            <label for="">Fecha Del Prestamo</label>
                            <input type="date" name='fecha_prest' placeholder="fecha" id="fechaPrestamo" readonly>
                            <label for="">Fecha De Entrega</label>
                            <input type="date" name='fecha_ent' placeholder="fecha" id="fechaEntrega" readonly>                                                               
                        </section>

                        <div class="btn" id="Prestamo_R">
                            <!-- <button type="reset"  >Limpiar</button> -->
                            <button type="submit" >Registrar</button>
                        </div>                            
                    </form>
                </section>                                     
            </div>
        </section>
       
      <!-- Modal Editar -->
        <section class="modal" id="modal-edit">
            <div class="modal_container">  
                <section class="modal-header">
                    <h2 class="modal_title"> Editando Prestamo</h2>
                    <button class="modal_close" id="cancelar"></button>
                </section>
                    
                <section class="modal-body">
                    <form action="../php/editprest.php" method="POST" class="form-Persona" id="formPersona">    
                        <section>
                            <input type="hidden" id='edit-id' name='edit-id'>
                            <input type="hidden" id='edit-estado' name='edit-estado'>
                            <input type=hidden name="placeholder" id="placeholder" value="">
                            <label for="">Cédula</label>
                            <input type="text" id='edit-cedula' name='edit-cedula' placeholder="xxxxxxxx" pattern="\d{7,8}" title="La cedula debe tener al menos 7 digitos" required>
                            <label for="">Cota</label>
                            <input type="text" id='edit-cota' name='edit-cota' placeholder="xxxxxxxx" pattern="[A-Za-z0-9]{4}-[A-Za-z0-9]{4}" title="El formato del codigo es XXXX-XXXX" >
                            <label for="">Fecha Del Prestamo</label>
                            <input type="date" id='edit-fechaprest' name='edit-fechaprest' placeholder="fecha" id="fechaPrestamo" readonly>
                            <label for="">Fecha De Entrega</label>
                            <input type="date" id='edit-fechaent' name='edit-fechaent' placeholder="fecha" id="fechaEntrega" readonly>                                                               
                        </section>

                        <div class="btn">
                        <button type="reset" id="cancelar-edit" >Cancelar</button> 
                        <button type="submit">Guardar Cambios</button>
                        </div>                            
                    </form>
                </section>                                     
            </div>
            
        </section>

        <div class="contend-tabla">            
            <div  class="header-div">
                <section class="buscar-tabla" >
                    <button  title="BtnBuscar"  name="BtnBuscar" id="BtnBuscar"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                    <input type="text" name="Buscar" placeholder="Buscar" id="Buscar" onkeyup="filterTable()">                
                </section>

                <section class="filter-paginator">
                    <div class="row-selector">
                        <label for="rows"> Mostrar:</label>
                        <select id="rows" onchange="updateRows()">
                            <option value="5">5 Filas</option>
                            <option value="10">10 Filas</option>
                            <option value="20">20 Filas</option>
                        </select>
                    </div>
                        
                    <section class="paginador">
                        <div class="btn-pager">
                            <button id="prevPage" onclick="changePage(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                            <span id="pageInfo" class="page-info"></span>
                            <button id="nextPage" onclick="changePage(1)"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </section>
    
                </section>

                <section class="contend-PDf">
                    <button class="btn-descargar" title="Descargar" type="button" onclick="window.open('../fpdf186/gen_pdf_prestamos.php', '_blank')">
                        <span class="btn-span">Exportar Registros</span> <!---->
                        <i class="fa-solid fa-file-pdf"></i>                    
                    </button> 
                </section>
            </div>
            
            <!-- tabla de registros -->
            <section class="tabla-section">
                <table class="tabla-A">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cota Del Libro</th>
                            <th>Titulo</th>
                            <th>C.I Persona</th>
                            <th>Nombre</th>
                            <th>Fecha Prestamo</th>
                            <th>Fecha Devolución</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tabla-B">
                        <?php foreach ($prestamos as $index => $prestamo): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($prestamo['prestamo_id']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['libro_cota']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['libro_titulo']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['persona_cedula']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['persona_nombre']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['fecha_prestamo']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['fecha_entrega']); ?></td>
                                <td><?php echo htmlspecialchars($prestamo['estado']); ?></td>
                                <td>
                                    <button class="editBtn" title="Editar" onclick="editPerson()"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                    
                                    <form action="../php/elimprest.php" method="POST">
                                        <input type="hidden" name="prestamo_id" value="<?php echo htmlspecialchars($prestamo['prestamo_id']); ?>">
                                        <input type="hidden" name="estado" value="<?php echo htmlspecialchars($prestamo['estado']); ?>">
                                    <button class="deleteBtn" title="Cambiar Estado"><i class="fa-solid fa-toggle-on"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <!-- Paginador -->
            <section class="paginator-dos">
                <div class="btn-pager">
                <div class="btn-pager">
                    <button id="prevPage" onclick="changePage(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                    <button id="nextPage" onclick="changePage(1)"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
                </div>
            </section> 
        </div>
        
    </main>
    
    <footer>
        <?php include "footer.php" ?> 
    </footer>

    <script src="../js/mover_menu.js"></script>
    <script src="../js/pager.js"></script>
    <script src="../js/modal-persona.js"></script>
    <script src="../js/rotar-icono-menu.js"></script>
    <script src="../js/notificaciones.js"></script>
    <!-- <script src="../js/pagina-hover.js"></script> -->
    <script src="../js/header.js"></script>

</body>
</html>