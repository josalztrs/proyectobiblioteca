<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['edit-cedula'] ?? '';
    $cota = $_POST['edit-cota'] ?? '';
    $fechaPrest = $_POST['edit-fecha_prest'] ?? '';
    $fechaPrest = $_POST['edit-fecha_dev'] ?? '';


    $query = "UPDATE prestamos SET cota = ?, fechaPrest = ?, fechaDev = ? WHERE cedula = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $cota, $fechaPrest, $fechaDev, $cedula);
    if ($stmt->execute()) {

        header("Location: ../html/prestamos.php");
        exit();
    } else {
        echo 'Query failed: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}



?>