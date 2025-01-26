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
    
    if($tipo_cargo==""){
        $stmt = $conn->prepare("UPDATE personas SET nombre = ?, tipo = ?, carrera = ?, telefono = ?, correo = ?, direccion = ? WHERE cedula = ?");
        $stmt->bind_param('sssssss', $nombre, $tipo_persona, $tipo_carrera, $telefono, $email, $direccion, $cedula);
        if ($stmt->execute()) {
            header("Location: ../html/Personas.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }
    else if ($tipo_carrera==""){
        $stmt = $conn->prepare("UPDATE personas SET nombre = ?, tipo = ?, cargo = ?, telefono = ?, correo = ?, direccion = ? WHERE cedula = ?");
        $stmt->bind_param('sssssss', $nombre, $tipo_persona, $tipo_cargo, $telefono, $email, $direccion, $cedula);
        if ($stmt->execute()) {
            header("Location: ../html/Personas.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }
}
?>
