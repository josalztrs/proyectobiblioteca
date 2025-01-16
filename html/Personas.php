<!DOCTYPE html>
<html lang="en">
<?php
include '../php/connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM personas");
    $stmt->execute();
    $personas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Query failed: ' . $e->getMessage();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/96ea2d2ec6.js" crossorigin="anonymous"></script>
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
                Personas Registradas
            </h1>
        </div>
    </div>

    <main>
        <button class="btn-agregar" type="button" onclick="openModal()" title="Resgistrar"><i class="fa-solid fa-plus"></i></button>  
        <!-- modal registrar -->
        <section class="modal "  id="modal">
                <div class="modal_container">
                   
                    <section class="modal-header">
                        <h2 class="modal_title"> Registrando Persona</h2>
                    </section>
                    
                   <section class="modal-body">

                        <form action="" class="form-Persona">    
                            <section>
                                <label for="">Cedula</label>
                                <input type="text" placeholder="xxxxxxxx">
                                <label for="">Nombres</label>
                                <input type="text" placeholder="Nombre Completo">

                                <section class="section-A">
                                    
                                    <select id="tipo-persona" name="tipo-persona" onchange="toggleInput()">
                                        <option value="" disabled selected>Selecione el  Tipo</option>
                                        <option value="estudiante">Estudiante</option>
                                        <option value="profesor">Personal UNEFA</option>
                                        <option value="externo">Externo</option>
                                    </select>

                                    <select id="tipo-carrera" name="tipo-carrera" disabled >
                                        <option value="" disabled selected>Selecione La Carrera</option>
                                        <option value="Ing Sistemas">Ing Sistemas</option>
                                        <option value="Ing Civil">Ing Civil</option>
                                        <option value="Enfermeria">Enfermeria</option>
                                        <option value="Administracion">Administracion</option>
                                        <option value="Turismo">Turismo</option>
                                        <option value="Postgrado">Postgrado</option>
                                        
                                    </select>

                                </section>

                                <label for="">Telefono</label>
                                <input type="text" placeholder="Telf">
                                <label for="">Email</label>
                                <input type="email" placeholder="email">
                                <label for="">Direccion</label>
                                <input type="text" placeholder="Direccion">
                                
                            </section>

                            <div class="btn">
                                    <button type="reset" id="cancelar" class="modal_close">Cancelar</button>
                                    <button type="submit">Registrar</button>
                                    <!-- <button type="reset" id="cancelar">Cancelar</button> -->
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
                        <form action="" class="form-Persona">    
                            <section>
                                <label for="">Cedula</label>
                                <input type="text" id="edit-cedula" placeholder="12345687">
                                <label for="">Nombres</label>
                                <input type="text" id="edit-nombres" placeholder="Nombre Completo">
                                <section class="section-A">
                                    <select id="edit-tipo-persona" name="tipo-persona" onchange="toggleInput()">
                                        <option value="" disabled selected>Selecione el Tipo</option>
                                        <option value="estudiante">Estudiante</option>
                                        <option value="profesor">Profesor</option>
                                        <option value="externo">Externo</option>
                                    </select>
                                    <select id="edit-tipo-carrera" name="tipo-carrera" disabled>
                                        <option value="" disabled selected>Selecione La Carrera</option>
                                        <option value="Ing Sistemas">Ing Sistemas</option>
                                        <option value="Ing Civil">Ing Civil</option>
                                        <option value="Enfermeria">Enfermeria</option>
                                        <option value="Administracion">Administracion</option>
                                        <option value="Turismo">Turismo</option>
                                        <option value="Postgrado">Postgrado</option>
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

                <section class="contend-PDf">
                    <button  title="PDF"> <i class="fa-solid fa-file-pdf"></i> </button>
                    <button  title="Excel"> <i class="fa-solid fa-file-excel"></i> </button>
                    <button  title="Word"> <i class="fa-solid fa-file-word"></i> </button>
                </section>

                <section class="buscar-tabla">
                    <input type="text" name="Buscar" placeholder="Buscar" id="Buscar" onkeyup="filterTable()">
                    <button title="Buscar" name="BuscarBtn" id="BuscarBtn" onclick="filterTable()"> <i class="fa-solid fa-magnifying-glass"></i> </button>
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
                                    <button class="deleteBtn" title="Eliminar" onclick="deletePerson(this.closest('tr'))"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
<script>
function filterTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("Buscar");
    filter = input.value.toUpperCase();
    table = document.querySelector(".tabla-A");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}
</script>
</section>
            
        </div>
        
    </main>
    <script src="../js/modal-persona.js"></script>
</body>
</html>
