<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php
include '../php/connection.php';

$tesis = [];
$query = "SELECT 
    otrosmateriales.*, 
    materia.id AS materia_id, 
    materia.nombremateria AS nombremateria, 
    personas.carrera
FROM 
    otrosmateriales
INNER JOIN 
    materia ON otrosmateriales.area_conoc = materia.id
LEFT JOIN 
    personas ON personas.nombre = otrosmateriales.autor;";
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $tesis[] = $row;
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

$tutores=[];
$querytres = "SELECT nombre FROM personas WHERE cargo='DOCENTE'";
if ($result = $conn->query($querytres)) {
    while ($row = $result->fetch_assoc()) {
        $tutores[] = $row;
    }
    $result->free();
} else {
    echo 'Query failed: ' . $conn->error;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesis</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pager.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/editinvst.js"></script>
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
                Registro De Trabajos De Investigación
            </h1>
        </div>
    </div> 
   
    <main>

       <section class="botones">
            <button class="btn-agregar" type="button" onclick="openModal()" title="Resgistrar">
                <i class="fa-solid fa-plus"></i>
                <span class="btn-text">Registrar Trabajos</span>
            </button> 
        </section>

     <!-- modal registrar -->
        <section class="modal "  id="modal">
            <div class="modal_container">  
                <section class="modal-header">
                    <h2 class="modal_title"> Registrando Trabajo</h2>
                    <button class="modal_close" id="cancelar"> <i class="fa-solid fa-xmark"></i></button>
                </section>
                    
                <section class="modal-body">
                    <form action="../php/nuevinvst.php" method="POST" class="form-Persona" id="formTrabajo">    
                        <section>
                            <label for="">Titulo</label>
                            <input type="text" name='titulo' placeholder="Titulo  del libro" required>
                            <!-- <label for="">Tipo</label> -->
                             
                            <section class="section-A">
                                <select name="tipo" id="tipo" class="Select_Trabaj"  required>
                                    <option value="" disabled selected>Tipo De Dato</option>
                                    <optgroup label="Según el tipo de datos">
                                        <option value="cualitativa">Cualitativa</option>
                                        <option value="cuantitativa">Cuantitativa</option>
                                    </optgroup>

                                    <optgroup label="Según el objetivo">
                                        <option value="basica">Básica</option>
                                        <option value="aplicada">Aplicada</option>
                                    </optgroup>

                                    <optgroup label="Según la profundidad">
                                        <option value="descriptiva">Descriptiva</option>
                                        <option value="explicativa">Explicativa</option>
                                        <option value="exploratoria">Exploratoria</option>
                                    </optgroup>

                                    <optgroup label="Según la manipulación de variables">
                                        <option value="experimental">Experimental</option>
                                        <option value="cuasi-experimental">Cuasi-experimental</option>
                                        <option value="no-experimental">No experimental</option>
                                    </optgroup>

                                    <optgroup label="Según el diseño">
                                        <option value="deductiva">Deductiva</option>
                                        <option value="inductiva">Inductiva</option>
                                        <option value="hipotetico-deductiva">Hipotético-deductiva</option>
                                    </optgroup>

                                    <optgroup label="Según la temporalidad">
                                        <option value="longitudinal">Longitudinal</option>
                                        <option value="transversal">Transversal</option>
                                    </optgroup>
                                    <option value="hibrida">Hibrida</option>
                                </select>

                                <select name="tipo_doc" id="tipo_doc" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Trabajo</option>
                                    <option value="TRABAJO DE GRADO - PREGRADO">Trabajo de grado - pregrado</option>
                                    <option value="TRABAJO DE GRADO - POSGRADO">Trabajo de grado - posgrado</option>
                                    <option value="INFORME DE SERVICIO COMUNITARIO">Informe de servicio comunitario</option>
                                    <option value="INFORME DE PASANTIA">Informe de Pasantia</option>
                                </select>
                            </section>
                            
                            <section class="section-A">
                                <select name="materia" id="materia" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Area De Conocimiento</option>
                                    <?php foreach ($materias as $materia): ?>
                                        <option value="<?php echo htmlspecialchars($materia['id']); ?>"><?php echo htmlspecialchars($materia['nombremateria']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <select name="tutor"  id="tutor" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Tutor</option>
                                    <?php foreach ($tutores as $tutor): ?>
                                        <option value="<?php echo htmlspecialchars($tutor['nombre']); ?>"><?php echo htmlspecialchars($tutor['nombre']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </section>
                            <label for="">Autor</label>
                            <input type="text" name='autor' placeholder="autor" required>
                            <label for="">Año</label>
                            <input type="number" name='anio_edic' placeholder="Año de Edicion" min="1940" max="<?php echo date('Y'); ?>" required>
                            
                           
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
                    <h2 class="modal_title"> Editando Trabajo</h2>
                </section>                    
                <section class="modal-body">
                    <form action="../php/editinvst.php" method="POST" class="form-Persona">    
                        <section>
                            <input type="hidden" id="edit-id">
                            <label for="">Titulo</label>
                            <input type="text" name='edit-titulo' id='edit-titulo' placeholder="Titulo  del libro" required>
                            
                            <section class="section-A">
                                <select name="edit-tipo" id="edit-tipo" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                        <optgroup label="Según el tipo de datos">
                                            <option value="CUALITATIVA">Cualitativa</option>
                                            <option value="CUANTITATIVA">Cuantitativa</option>
                                        </optgroup>

                                        <optgroup label="Según el objetivo">
                                            <option value="BASICA">Básica</option>
                                            <option value="APLICADA">Aplicada</option>
                                        </optgroup>

                                        <optgroup label="Según la profundidad">
                                            <option value="DESCRIPTIVA">Descriptiva</option>
                                            <option value="EXPLICATIVA">Explicativa</option>
                                            <option value="EXPLORATORIA">Exploratoria</option>
                                        </optgroup>

                                        <optgroup label="Según la manipulación de variables">
                                            <option value="EXPERIMENTAAL">Experimental</option>
                                            <option value="CUASI-EXPERIMENTAL">Cuasi-experimental</option>
                                            <option value="NO-EXPERIMENTAL">No experimental</option>
                                        </optgroup>

                                        <optgroup label="Según el diseño">
                                            <option value="DEDUCTIVA">Deductiva</option>
                                            <option value="INDUCTIVA">Inductiva</option>
                                            <option value="HIPOTETICO-DEDUCTIVA">Hipotetico-deductiva</option>
                                        </optgroup>

                                        <optgroup label="Según la temporalidad">
                                            <option value="LONGITUDINAL">Longitudinal</option>
                                            <option value="TRANSVERSAL">Transversal</option>
                                        </optgroup>
                                </select>

                                <select name="edit-tipo_doc" id="edit-tipo_doc" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="TRABAJO DE GRADO">Trabajo de grado</option>
                                    <option value="INFORME DE SERVICIO COMUNITARIO">Informe de servicio comunitario</option>
                                    <option value="INFORME DE PASANTIA">Informe de Pasantia</option>
                                </select>

                            </section>

                            <section class="section-A">
                                <select name="materia" id="materia" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Area De Conocimiento</option>
                                    <?php foreach ($materias as $materia): ?>
                                        <option value="<?php echo htmlspecialchars($materia['id']); ?>"><?php echo htmlspecialchars($materia['nombremateria']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <select name="tutor"  id="tutor" class="Select_Trabaj" required>
                                    <option value="" disabled selected>Tutor</option>
                                    <?php foreach ($tutores as $tutor): ?>
                                        <option value="<?php echo htmlspecialchars($tutor['nombre']); ?>"><?php echo htmlspecialchars($tutor['nombre']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </section>
                            <label for="">Autor</label>
                            <input type="text" name='edit-autor' id='edit-autor' placeholder="autor del libro" required>
                            <label for="">Año de Edicion</label>
                            <input type="number" name='edit-anio_edic' id= 'edit-anio_edic' placeholder="Año de Edicion" min="1940" max="<?php echo date('Y'); ?>" required>
                            <label for="">Area De Conocimiento</label>
                        </section>
                        <div class="btn">
                            <button type="reset" id="cancelar-edit" >Cancelar</button> <!--class="modal_close"-->
                            <button type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </section>                 
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
                    <button class="btn-descargar" title="Descargar" type="button" onclick="window.open('../fpdf186/gen_pdf_tesis.php', '_blank')">
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
                            <!-- <th>ID</th> -->
                            <th>id</th>
                            <!-- <th>Carrera</th> -->
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Tutor</th>
                            <th>Año</th>
                            <th>Area De Conocimiento</th>
                            <th>Tipo de Documento</th>
                            <th>Metodología</th>
                            <th>Carrera</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tabla-B">
                        <?php foreach ($tesis as $index => $tes): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tes['id']);?></td>
                                <td><?php echo htmlspecialchars($tes['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($tes['autor']); ?></td>
                                <td><?php echo htmlspecialchars($tes['tutor']); ?></td>
                                <td><?php echo htmlspecialchars($tes['semestr_exp']); ?></td>
                                <td><?php echo htmlspecialchars($tes['nombremateria']); ?></td>
                                <td><?php echo htmlspecialchars($tes['tipo_metodologia']); ?></td>
                                <td><?php echo htmlspecialchars($tes['tipo']); ?></td>
                                <td><?php echo htmlspecialchars($tes['carrera']);?></td>
                                <td>
                                    <button class="editBtn" title="Editar" onclick="editPerson()"> <i class="fa-solid fa-pen-to-square"></i> </button>
                                    <button class="deleteBtn" title="Eliminar" onclick="confirmDelete('<?php echo htmlspecialchars($tes['id']); ?>', '../php/eliminvst.php')"><i class="fa-solid fa-toggle-on"></i></button>
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
    <script src="../js/header.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formTrabajo').on('submit', function(e) {
                e.preventDefault(); // Evita el envío normal del formulario

                $.ajax({
                    type: 'POST',
                    url: '../php/nuevinvst.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                confirmButtonText: 'Aceptar'
                            });
                        } else if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro exitoso',
                                text: response.message,
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '../html/tesis.php'; // Redirige a la página deseada
                                }
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al procesar la solicitud.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>