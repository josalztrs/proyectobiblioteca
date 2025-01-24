<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'] ?? '';
    $nombre = strtoupper($_POST['nombre'] ?? '');
    $tipo_persona = strtoupper($_POST['tipo-persona'] ?? '');
    $tipo_carrera = strtoupper($_POST['tipo-carrera'] ?? '');
    $telefono = strtoupper($_POST['telefono'] ?? '');
    $email = strtoupper($_POST['email'] ?? '');
    $direccion = strtoupper($_POST['direccion'] ?? '');
    $fechingreso = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO personas (cedula, nombre, tipo, carrera, telefono, correo, direccion, fechingreso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $cedula, $nombre, $tipo_persona, $tipo_carrera, $telefono, $email, $direccion, $fechingreso);

    if ($stmt->execute()) {

        header("Location: ../html/Personas.php");
        exit();
    } else {
        echo 'Query failed: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
