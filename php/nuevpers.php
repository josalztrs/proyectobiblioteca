<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $tipo_persona = $_POST['tipo-persona'] ?? '';
    $tipo_carrera = $_POST['tipo-carrera'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $direccion = $_POST['direccion'] ?? '';

    $stmt = $conn->prepare("INSERT INTO personas (cedula, nombre, tipo, carrera, telefono, correo, direccion) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $cedula, $nombre, $tipo_persona, $tipo_carrera, $telefono, $email, $direccion);

    if ($stmt->execute()) {
        // Redirect to the Personas page after successful insertion
        header("Location: ../html/Personas.php");
        exit();
    } else {
        echo 'Query failed: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
