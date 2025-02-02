<?php
include 'connection.php';
// Get the person ID from the request
$person_id = $_POST['prestamo_id']; 

if($_POST['estado'] == "DEVUELTO") {
    $estado = "EN PRESTAMO";} 
    else {
        $estado = "DEVUELTO";}

// Prepare and bind
$stmt = $conn->prepare("UPDATE prestamos SET estado = ? WHERE id = ?");
$stmt->bind_param("si", $estado ,$person_id);

if ($stmt->execute()) {

    header("Location: ../html/prestamos.php");
    exit();
} else {
    echo 'Query failed: ' . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>