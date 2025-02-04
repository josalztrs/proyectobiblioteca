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
    $tutor = strtoupper($_POST['tutor'] ?? '');

    $checkCedulaQuery = "SELECT 1 FROM personas WHERE cedula = ? AND tipo='ESTUDIANTE' LIMIT 1";
    $checkCedulaStmt = $conn->prepare($checkCedulaQuery);
    $checkCedulaStmt->bind_param('s', $cedula);
    $checkCedulaStmt->execute();
    $checkCedulaStmt->store_result();

    if($checkCedulaStmt->num_rows()>0){
        $stmt = $conn->prepare("INSERT INTO otrosmateriales (titulo, autor, semestr_exp, area_conoc, tipo,tipo_metodologia, tutor) VALUES (?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param('sssssss', $titulo, $autor, $anioedic, $materia, $tipo, $tipodoc, $tutor);
        if ($stmt->execute()) {

            header("Location: ../html/tesis.php");
            exit();
        } else {
            echo 'Query failed: ' . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
} else{
    echo "<script>alert('El usuario no es un estudiante, o no esta registrado en la base de datos.'); window.location.href='../html/tesis.php';</script>";
}
}
?>