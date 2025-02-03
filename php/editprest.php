<?php
include "../php/connection.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edit-id'] ?? ''; 
    $cedula = $_POST['edit-cedula'] ?? '';
    $cota = $_POST['edit-cota'] ?? '';
    $cotavieja = $_POST['placeholder'] ?? '';
    $fechaPrest = $_POST['edit-fechaprest'] ?? '';
    $fechaDev = $_POST['edit-fechaent'] ?? '';
    $estado = $_POST['edit-estado'] ?? '';

    if ($estado == 'EN PRESTAMO') {
        $query = "UPDATE libros SET estado = 'EN STOCK' where cota = ? AND estado = 'PRESTADO' LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $cotavieja);
        $stmt->execute();
        $stmt->close();
    }
    $query = "UPDATE prestamos SET cota = ?, fecha_prestamo = ?, fecha_entrega = ?, cedula = ? where id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $cota, $fechaPrest, $fechaDev, $cedula, $id);

    if ($stmt->execute()) {
        header("Location: ../html/prestamos.php");
        exit;
    } else {
        echo 'Query failed: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>