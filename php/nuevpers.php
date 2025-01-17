<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $tipo_persona = $_POST['tipo_persona'];
    $tipo_carrera = $_POST['tipo_carrera'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    try {
        $stmt = $conn->prepare("INSERT INTO personas (cedula, nombre, tipo_persona, tipo_carrera, telefono, email, direccion) VALUES (:cedula, :nombre, :tipo_persona, :tipo_carrera, :telefono, :email, :direccion)");
        $stmt->bind_Param(':cedula', $cedula);
        $stmt->bind_Param(':nombre', $nombre);
        $stmt->bind_Param(':tipo_persona', $tipo_persona);
        $stmt->bind_Param(':tipo_carrera', $tipo_carrera);
        $stmt->bind_Param(':telefono', $telefono);
        $stmt->bind_Param(':email', $email);
        $stmt->bind_Param(':direccion', $direccion);
        $stmt->execute();

        // Redirect to the Personas page after successful insertion
        header("Location: ../html/Personas.php");
        exit();
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
    }
}
?>