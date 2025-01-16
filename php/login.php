<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :username AND contra = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../html/admin.php");
        exit();
    } else {

        header("Location: ../index.php?error=invalid_credentials");
        exit();
    }
}
?>