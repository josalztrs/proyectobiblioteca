<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'] ?? '';
    $cota = $_POST['cota'] ?? '';
    $fechaPrest = $_POST['fechaPrest'] ?? date('Y-m-d');
    $fechaDev = date('Y-m-d', strtotime('+ 3 days'));

    $query = "INSERT INTO prestamos (cedula, cota, fechaPrest, fechaDev) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $cedula, $cota, $fechaPrest, $fechaDev);
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