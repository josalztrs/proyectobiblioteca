<?php
include '../php/connection.php';

$PrestamosPendientes = array();
$FechaAct = date('Y-m-d');

$query = "SELECT * FROM prestamos WHERE fecha_entrega < '$FechaAct' AND estado = 'EN PRESTAMO'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $PrestamosPendientes[] = $row;
    }
}

$conn->close();

?>

<div class="icono__menu" id="btn-open">
            <i class="fa-solid fa-bars"></i>
    </div>

    <ul >
        <li>
            <a href="prestamos.php" id="notificaciones">
                <i class="fa-solid fa-bell" title="Notificaciones"></i>
            </a>
            <ul class="notificaciones-list" id="notificaciones-list">
                <?php foreach ($PrestamosPendientes as $prestamo): ?>
                <li><?php echo htmlspecialchars("El prestamo ".$prestamo['id']." Ha vencido el plazo de devolucion"); ?></li>
                <?php endforeach; ?>
                <li><a href="prestamos.php">Ver todas</a></li>
            </ul>
        </li>
        <li>
            <a href="#" id="salir">
                <i class="fa-solid fa-right-from-bracket" title="Salir"></i>
            </a>
        </li>
    </ul>