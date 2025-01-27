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
    $cargo = strtoupper($_POST['tipo-cargo'] ?? '');

    $query = "SELECT COUNT(*) as count FROM personas WHERE cedula = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("s", $cedula);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            if ($row['count'] > 0) {
                                echo "<script>alert('La cédula ya está registrada.');</script>";
                                echo "<script>window.history.back();</script>";
                                exit;
                            }

    if ($tipo_persona == 'INTERNO') {
        $stmt = $conn->prepare("INSERT INTO personas (cedula, nombre, tipo, telefono, correo, direccion, fechingreso, cargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssss', $cedula, $nombre, $tipo_persona, $telefono, $email, $direccion, $fechingreso, $cargo);
        if ($stmt->execute()) {

            header("Location: ../html/Personas.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }
    if($tipo_persona == 'ESTUDIANTE') {
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
    if($tipo_persona=='EXTERNO'){
        $stmt = $conn->prepare("INSERT INTO personas (cedula, nombre, tipo, telefono, correo, direccion, fechingreso) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $cedula, $nombre, $tipo_persona, $telefono, $email, $direccion, $fechingreso);
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
