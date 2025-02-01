<?php
include 'connection.php';
// Get the person ID from the request
$person_id = $_POST['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM prestamos WHERE id = ?");
$stmt->bind_param("i", $person_id);

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