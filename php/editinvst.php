<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['edit-id'] ?? '';
    $titulo = strtoupper($_POST['titulo'] ?? '');
    $autor = strtoupper($_POST['autor'] ?? '');
    $anioedic = $_POST['anio_edic'] ?? '';
    $tipo = strtoupper($_POST['tipo'] ?? '');
    $materia = strtoupper($_POST['materia'] ?? '');
    $tipodoc = strtoupper($_POST['tipo_doc'] ?? '');
    $stmt = $conn->prepare("UPDATE otrosmateriales SET titulo = ?, autor = ?, semestr_exp = ?, area_conoc = ?, tipo = ?, tipo_metodologia = ? WHERE id = ?");   
        $stmt->bind_param('sssssss', $titulo, $autor, $anioedic, $materia, $tipo, $tipodoc, $id);
        if ($stmt->execute()) {

            header("Location: ../html/tesis.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
}
?>