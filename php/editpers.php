<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['edit-cedula'] ?? '';
    $nombre = strtoupper($_POST['edit-nombres'] ?? '');
    $tipo_persona = strtoupper($_POST['edit-tipo'] ?? '');
    $tipo_carrera = strtoupper($_POST['edit-carrera'] ?? '');
    $tipo_cargo = strtoupper($_POST['edit-cargo'] ?? '');
    $telefono = strtoupper($_POST['edit-telefono'] ?? '');
    $email = strtoupper($_POST['edit-email'] ?? '');
    $direccion = strtoupper($_POST['edit-direccion'] ?? '');

    $stmt = $conn->prepare("UPDATE personas SET nombre = ?, tipo = ?, carrera = ?, telefono = ?, correo = ?, direccion = ?, cargo = ? WHERE cedula = ?");
    $stmt->bind_param('ssssssss', $nombre, $tipo_persona, $tipo_carrera, $telefono, $email, $direccion, $tipo_cargo, $cedula);

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
