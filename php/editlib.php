<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edit-id'] ?? '';
    $cota = $_POST['cota'] ?? '';
    $titulo = strtoupper($_POST['titulo'] ?? '');
    $autor = strtoupper($_POST['autor'] ?? '');
    $anioedic = $_POST['anio_edic'] ?? '';
    $materia = strtoupper($_POST['materia'] ?? '');
    $editorial = strtoupper($_POST['editorial'] ?? '');
    $descripcion = strtoupper($_POST['descripcion'] ?? '');
        $stmt = $conn->prepare("UPDATE libros SET cota = ?, titulo = ?, autor = ?, anio_edic = ?, materia = ?, editorial = ?, descripcion = ? WHERE id = ?");
        $stmt->bind_param('sssssssi', $cota, $titulo, $autor, $anioedic, $materia, $editorial, $descripcion, $id);
        if ($stmt->execute()) {

            header("Location: ../html/libros.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
}
?>