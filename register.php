<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Guardar contraseña en texto plano

    // Verifica si el nombre de usuario ya existe
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está en uso.";
    } else {
        // Guardar el nuevo usuario en la base de datos
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente. <a href='login.html'>Iniciar sesión</a>";
        } else {
            echo "Error al registrar el usuario.";
        }
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
