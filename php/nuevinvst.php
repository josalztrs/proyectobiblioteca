<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = strtoupper($_POST['titulo'] ?? '');
    $autor = strtoupper($_POST['autor'] ?? '');
    $anioedic = $_POST['anio_edic'] ?? '';
    $tipo = strtoupper($_POST['tipo'] ?? '');
    $materia = strtoupper($_POST['materia'] ?? '');
    $tipodoc = strtoupper($_POST['tipo_doc'] ?? '');
        $stmt = $conn->prepare("INSERT INTO otrosmateriales (titulo, autor, semestr_exp, area_conoc, tipo,tipo_metodologia) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param('ssssss', $titulo, $autor, $anioedic, $materia, $tipo, $tipodoc);
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