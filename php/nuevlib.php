<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cota = strtoupper($_POST['cota'] ?? '');
    $titulo = strtoupper($_POST['titulo'] ?? '');
    $autor = strtoupper($_POST['autor'] ?? '');
    $anioedic = $_POST['anio_edic'] ?? '';
    $materia = strtoupper($_POST['materia'] ?? '');
    $editorial = strtoupper($_POST['editorial'] ?? '');
    $descripcion = strtoupper($_POST['descripcion'] ?? '');
        $stmt = $conn->prepare("INSERT INTO libros (cota, titulo, autor, anio_edic, materia, editorial, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss',$cota, $titulo, $autor, $anioedic, $materia, $editorial, $descripcion);
        // if ($stmt->execute()) {

        //     header("Location: ../html/libros.php");
        //     exit();
        // } else {
        //     echo 'Query failed: ' . $stmt->error;
        // }
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Libro registrado exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar el libro.']);
        }
        $stmt->close();
        $conn->close();
}
?>