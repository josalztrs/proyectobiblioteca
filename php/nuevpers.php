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
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo_persona', $tipo_persona);
        $stmt->bindParam(':tipo_carrera', $tipo_carrera);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->execute();

        // Redirect to the Personas page after successful insertion
        header("Location: ../html/Personas.php");
        exit();
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
    }
}
?>