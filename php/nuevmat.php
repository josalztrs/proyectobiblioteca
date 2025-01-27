<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=='POST'){
    $materia = strtoupper($_POST['nombre_materia']);
    $query = "INSERT INTO materia (nombremateria) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $materia);
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