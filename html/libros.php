<!DOCTYPE html>
<html lang="en">
<?php
include '../php/connection.php';

$libros = [];
$query = "SELECT libros.*, materia.nombremateria, 
          SUM(CASE WHEN libros.estado = 'EN STOCK' THEN 1 ELSE 0 END) AS CTotal, 
          SUM(CASE WHEN libros.estado = 'PRESTADO' THEN 1 ELSE 0 END) AS CPrest 
          FROM libros 
          INNER JOIN materia ON libros.materia = materia.id 
          GROUP BY libros.cota, libros.anio_edic";

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $libros[] = $row;
    }
    $result->free();
} else {
    echo 'Query failed: ' . $conn->error;
}

$materias = [];
$querydos = "SELECT * FROM materia";
if ($result = $conn->query($querydos)) {
    while ($row = $result->fetch_assoc()) {
        $materias[] = $row;
    }
    $result->free();
} else {
    echo 'Query failed: ' . $conn->error;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pager.css">
    <link rel="stylesheet" href="../css/modal.css">
    <script src="../js/editlib.js"></script>
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
                Registrar Libros
            </h1>
        </div>
    </div>

    <main>
        <button class="btn-agregar" type="button" onclick="openModal()" title="Resgistrar">
            <i class="fa-solid fa-plus"></i>
            <span class="btn-text">Registrar Libros</span>
        </button> 

     <!-- modal registrar -->
        <section class="modal "  id="modal">
            <div class="modal_container">  
                <section class="modal-header">
                    <h2 class="modal_title"> Registrando Libro</h2>
                    <button class="modal_close" id="cancelar"> <i class="fa-solid fa-xmark"></i></button>
                </section>
                    
                <section class="modal-body">
                    <form action="../php/nuevlib.php" method="POST" class="form-Persona" id="formPersona">    
                        <section>
                            <label for="">Cota</label>
                            <input type="text" name='cota' placeholder="xxxxxxxx" pattern="[A-Za-z0-9]{4}-[A-Za-z0-9]{4}" title="El formato del codigo es XXXX-XXXX" >
                            <label for="">Titulo</label>
                            <input type="text" name='titulo' placeholder="Titulo  del libro">
                            <label for="">Autor</label>
                            <input type="text" name='autor' placeholder="autor del libro">
                            <label for="">Editorial</label>
                            <input type="text" name='editorial' placeholder="editorial">
                            <label for="">Año de Edicion</label>
                            <input type="number" name='anio_edic' placeholder="Año de Edicion" min="1940" max="<?php echo date('Y'); ?>">
                            <label for="">Materia</label>
                            <select name="materia">
                                <option value="" disabled selected>Seleccione una materia</option>
                                <?php foreach ($materias as $materia): ?>
                                    <option value="<?php echo htmlspecialchars($materia['id']); ?>"><?php echo htmlspecialchars($materia['nombremateria']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="">Descripcion</label>
                            <input type="text" name='descripcion' placeholder="Descripcion">
                        </section>

                        <div class="btn">
                            <button type="reset"  >Limpiar</button>
                            <button type="submit">Registrar</button>
                        </div>                            
                    </form>
                </section>                                     
            </div>
        </section>
           
     
        <!-- Modal de editar -->
        <section class="modal" id="modal-edit">
            <div class="modal_container">
                <section class="modal-header">
                    <h2 class="modal_title"> Editando Persona</h2>
                </section>                    
                <section class="modal-body">
                    <form action="../php/editlib.php" method="POST" class="form-Persona">    
                        <section>
                            <label for="">Cota</label>
                            <input type="text" name='edit-cota' id='edit-cota' placeholder="xxxxxxxx" pattern="[A-Za-z0-9]{4}-[A-Za-z0-9]{4}" title="El formato del codigo es XXXX-XXXX" >
                            <label for="">Titulo</label>
                            <input type="text" name='edit-titulo' id='edit-titulo' placeholder="Titulo  del libro">
                            <label for="">Autor</label>
                            <input type="text" name='edit-autor' id='edit-autor' placeholder="autor del libro">
                            <label for="">Editorial</label>
                            <input type="text" name='edit-editorial' id ='edit-editorial' placeholder="editorial">
                            <label for="">Año de Edicion</label>
                            <input type="number" name='edit-anio_edic' id= 'edit-anio_edic' placeholder="Año de Edicion" min="1940" max="<?php echo date('Y'); ?>">
                            <label for="">Materia</label>
                            <select name="edit-materia" id="edit-materia">
                                <option value="" disabled selected>Seleccione una materia</option>
                                <?php foreach ($materias as $materia): ?>
                                    <option value="<?php echo htmlspecialchars($materia['id']); ?>"><?php echo htmlspecialchars($materia['nombremateria']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="">Descripcion</label>
                            <input type="text" name='edit-descripcion' id='edit-descripcion' placeholder="Descripcion">
                        </section>
                        <div class="btn">
                            <button type="reset" id="cancelar-edit" >Cancelar</button> <!--class="modal_close"-->
                            <button type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </section>                 
            </div>
        </section>
            
     <!-- Modal Eliminar  -->
        <section class="modal " id="modal-Delete">        
            <div class="modal_container-Delet">
                <form action="../php/elimpers.php" method="POST">                   
                <h4 class="modal_title">¿Quiere Eliminar El Registro?</h4>
                <div class="btn">
                    <button type="reset" id="cancelar-delete" >Cancelar</button> <!--class="modal_close"-->
                    <button type="submit">Confirmar</button>
                </div>
                </form>
            </div>        
        </section>

        <!-- Tabla de Libros  -->
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
                    <button class="btn-descargar" title="Descargar" type="button" onclick="window.open('../fpdf186/gen_pdf_libros.php', '_blank')">
                        <span class="btn-span">Exportar Registros</span>
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
                            <th>Cota</th>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Año de Edicion</th>
                            <th>Materia</th>
                            <th>Descripcion</th>
                            <th>Cantidad Total</th>
                            <th>Cantidad Prestados</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tabla-B">
                        <?php foreach ($libros as $index => $libro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($libro['id']); ?></td>
                                <td><?php echo htmlspecialchars($libro['cota']); ?></td>
                                <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                                <td><?php echo htmlspecialchars($libro['editorial']); ?></td>
                                <td><?php echo htmlspecialchars($libro['anio_edic']); ?></td>
                                <td><?php echo htmlspecialchars($libro['nombremateria']); ?></td>
                                <td><?php echo htmlspecialchars($libro['descripcion']); ?></td>
                                <td><?php echo htmlspecialchars($libro['CTotal']); ?></td>
                                <td><?php echo htmlspecialchars($libro['CPrest']); ?></td>
                                <td>
                                    <button class="editBtn" title="Editar" onclick="editPerson()"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                    <button class="deleteBtn" title="Eliminar" onclick="deletPerson(this.closest('tr'))"><i class="fa-solid fa-trash-can"></i></button>
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

    <script src="../js/mover_menu.js"></script>
    <script src="../js/pager.js"></script>
    <script src="../js/modal-persona.js"></script>
    <script src="../js/rotar-icono-menu.js"></script>
    <script src="../js/pagina-hover.js"></script>

</body>
</html>