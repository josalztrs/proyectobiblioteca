<!DOCTYPE html>
<html lang="en">
<?php
include '../php/connection.php';

$personas = [];
$query = "SELECT * FROM personas";
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $personas[] = $row;
    }
    $result->free();
} else {
    echo 'Query failed: ' . $conn->error;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/pager.css">
    <link rel="stylesheet" href="../css/modal.css">
    <script src="../js/cargadatosedit.js"></script>
    <script src="../js/busquedadinamica.js"></script>
    <link rel="stylesheet" href="/fontawasome/fontawesome-free-6.7.2-web/css/all.css">
    <script src="https://kit.fontawesome.com/96ea2d2ec6.js" crossorigin="anonymous"></script>

</head>
   
<body id="body" > 
    
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
    
    <!-- menu late -->
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
                    <i class="fa-solid fa-hourglass-half" title="Prestamos"></i>
                    <h4>Prestamos</h4>
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
            
    <div class="titulo">
        <div>
            <h1>
                <i class="fa-solid fa-gauge"></i>
                Personas Registradas
            </h1>
        </div>
    </div>

    <main>
        <button class="btn-agregar" type="button" onclick="openModal()" title="Resgistrar">
            <i class="fa-solid fa-plus"></i>
            <span class="btn-text">Registrar Persona</span>
        </button> 
     <!-- modal registrar -->
        <section class="modal "  id="modal">
            <div class="modal_container">  
                <section class="modal-header">
                    <h2 class="modal_title"> Registrando Persona</h2>
                    <button class="modal_close" id="cancelar"> <i class="fa-solid fa-xmark"></i></button>
                </section>
                    
                <section class="modal-body">
                    <form action="../php/nuevpers.php" method="POST" class="form-Persona" id="formPersona">    
                        <section>
                            <label for="">Cedula</label>
                            <input type="text" name='cedula' placeholder="xxxxxxxx" pattern="\d{7,8}" title="La cedula debe tener al menos 7 digitos" required>
                            <label for="">Nombres</label>
                            <input type="text" name='nombre' placeholder="Nombre Completo">
                                <section class="section-A">                                    
                                    <select id="tipo-persona" name="tipo-persona" onchange="toggleInput()">
                                        <option value="" disabled selected>Tipo</option>
                                        <option value="estudiante">Estudiante</option>
                                        <option value="interno">Interno</option>
                                        <option value="externo">Externo</option>
                                    </select>
                                    <select id="tipo-carrera" name="tipo-carrera" disabled >
                                        <option value="" disabled selected> Carrera</option>
                                        <option value="Administracion">Administracion</option>
                                        <option value="Enfermeria">Enfermeria</option>
                                        <option value="Ing Civil">Ing Civil</option>
                                        <option value="Ing Sistemas">Ing Sistemas</option>                                   
                                        <option value="Turismo">Turismo</option>
                                        <option value="Maestria">Maestria</option>
                                        <option value="Postgrado">Postgrado</option>
                                        <option value="Doctorado">Doctorado</option>
                                    </select>
                                    <select id="tipo-cargo" name="tipo-cargo" disabled >
                                        <option value="" disabled selected>cargo</option>
                                        <option value="Administrativo">Administrativo</option>
                                        <option value="Directivo">Directivo</option>
                                        <option value="Docente">Docente</option>
                                        <option value="Obrero">Obrero</option>                                    
                                    </select>

                                </section>

                            <label for="">Telefono</label>
                            <input type="text" name='telefono' placeholder="Telf" pattern="\d{11}" title="El teléfono debe tener 11 dígitos" required>
                            <label for="">Email</label>
                            <input type="email" name='email' placeholder="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Ingrese un correo electrónico válido" required>
                            <label for="">Direccion</label>
                            <input type="text" name='direccion' placeholder="Direccion" required>                                
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
                    <h2 class="modal_title"> Editando Persona 
                        <!-- <button id="cancelar-edit" class="modal_close"> <i class="fa-solid fa-xmark"></i></button> -->
                    </h2>
                </section>                    
                <section class="modal-body">
                    <form action="../php/editpers.php" method="POST" class="form-Persona">    
                        <section>
                            <label for="">Cedula</label>
                            <input type="text" id="edit-cedula" placeholder="12345687">
                            <label for="">Nombres</label>
                            <input type="text" id="edit-nombres" placeholder="Nombre Completo">
                            <section class="section-A">                                    
                                <select id="edit-tipo" name="editar-tipo" onchange="toggleInput()">
                                    <option value="" disabled selected>Tipo</option>
                                    <option value="ESTUDIANTE">Estudiante</option>
                                    <option value="INTERNO">Interno</option>
                                    <option value="EXTERNO">Externo</option>
                                </select>

                                <select id="edit-carrera" name="editar-carrera" disabled >
                                    <option value="" disabled selected> Carrera</option>
                                    <option value="ADMINISTRACION">Administracion</option>
                                    <option value="ENFERMERIA">Enfermeria</option>
                                    <option value="ING CIVIL">Ing Civil</option>
                                    <option value="ING SISTEMAS">Ing Sistemas</option>                                   
                                    <option value="TURISMO">Turismo</option>
                                    <option value="MAESTRIA">Maestria</option>
                                    <option value="POSTGRADO">Postgrado</option>
                                    <option value="DOCTORADO">Doctorado</option>
                                </select>

                                <select id="edit-cargo" name="editar-cargo" disabled >
                                    <option value="" disabled selected>cargo</option>
                                    <option value="ADMINISTRATIVO">Administrativo</option>
                                    <option value="DIRECTIVO">Directivo</option>
                                    <option value="DOCENTE">Docente</option>
                                    <option value="OBRERO">Obrero</option>                                    
                                </select>

                            </section>
                            <label for="">Telefono</label>
                            <input type="text" id="edit-telefono" placeholder="Telf">
                            <label for="">Email</label>
                            <input type="email" id="edit-email" placeholder="email">
                            <label for="">Direccion</label>
                            <input type="text" id="edit-direccion" placeholder="Direccion">
                        </section>
                        <div class="btn">
                            <button type="reset" id="cancelar-edit" class="modal_close">Cancelar</button>
                            <button type="submit">Guardar Cambios</button>
                        </div>
                    </form>
                </section>                 
            </div>
        </section>
            
     <!-- Modal Eliminar  -->
        <section class="modal " id="modal-Delete">        
            <div class="modal_container-Delet">                    
                <h4 class="modal_title">¿Quiere Eliminar  El Registro?</h4>
                <div class="btn">
                    <button type="reset" id="cancelar-delete" class="modal_close">Cancelar</button>
                    <button type="submit">Confirmar</button>
                </div>
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
                    <button class="btn-descargar" title="Descargar" type="button">
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
                            <th>Codigo</th>
                            <th>Nombres</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            <th>Carrera</th>
                            <th>Direccion</th>
                            <th>Cargo</th>
                            <th>Fecha de Ingreso</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tabla-B">
                        <?php foreach ($personas as $index => $persona): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($persona['id']); ?></td>
                                <td><?php echo htmlspecialchars($persona['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($persona['cedula']); ?></td>
                                <td><?php echo htmlspecialchars($persona['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($persona['correo']); ?></td>
                                <td><?php echo htmlspecialchars($persona['tipo']); ?></td>
                                <td><?php echo htmlspecialchars($persona['carrera']); ?></td>
                                <td><?php echo htmlspecialchars($persona['direccion']); ?></td>
                                <td><?php echo htmlspecialchars($persona['cargo']); ?></td>
                                <td><?php echo htmlspecialchars($persona['fechingreso']); ?></td>
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

    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
        const btnDescargar = document.querySelector('.btn-descargar');
        const lista = document.querySelector('.contend-PDf-list');

            btnDescargar.addEventListener('click', function() {
            lista.classList.toggle('show'); // Alterna la clase 'show' para mostrar/ocultar la lista
            });
        }); 
    </script> -->
    <script src="../js/mover_menu.js"></script>
    <script src="../js/pager.js"></script>
    <script src="../js/modal-persona.js"></script>
    <script src="../js/rotar-icono-menu.js"></script>
</body>
</html>
