<?php
session_start();
include 'db.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Contraseña en texto plano

    // Consulta para verificar el usuario
    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar si la contraseña en texto plano coincide
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: panel.php');
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

