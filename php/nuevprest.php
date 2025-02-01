<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'] ?? '';
    $cota = $_POST['cota'] ?? '';
    $fecha_prest = $_POST['fecha_prest'] ?? '';
    $fecha_ent = $_POST['fecha_ent'] ?? '';

    // Check if cedula exists in personas table
    $checkCedulaQuery = "SELECT 1 FROM personas WHERE cedula = ? LIMIT 1";
    $checkCedulaStmt = $conn->prepare($checkCedulaQuery);
    $checkCedulaStmt->bind_param('s', $cedula);
    $checkCedulaStmt->execute();
    $checkCedulaStmt->store_result();

    // Check if cota exists in libros table
    $checkCotaQuery = "SELECT 1 FROM libros WHERE cota = ? LIMIT 1";
    $checkCotaStmt = $conn->prepare($checkCotaQuery);
    $checkCotaStmt->bind_param('s', $cota);
    $checkCotaStmt->execute();
    $checkCotaStmt->store_result();

    if ($checkCedulaStmt->num_rows > 0) {
        if ($checkCotaStmt->num_rows > 0) {
            $query = "INSERT INTO prestamos (cedula, cota, fecha_prestamo, fecha_entrega) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssss', $cedula, $cota, $fecha_prest, $fecha_ent);
            if ($stmt->execute()) {
                $updateQuery = "UPDATE libros SET estado = 'prestado' WHERE cota = ? LIMIT 1";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param('s', $cota);
                if (!$updateStmt->execute()) {
                    echo 'Update failed: ' . $updateStmt->error;
                }
                $updateStmt->close();
                header("Location: ../html/prestamos.php");
                exit();
            } else {
                echo 'Query failed: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>alert('La cota no existe en la base de datos. Por favor, añadela.'); window.location.href='../html/prestamos.php';</script>";
        }
    } else {
        echo "<script>alert('La cota no existe en la base de datos. Por favor, añadela.'); window.location.href='../html/prestamos.php';</script>";
    }

    $checkCedulaStmt->close();
    $checkCotaStmt->close();
    $conn->close();
}



?>