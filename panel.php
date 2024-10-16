<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Obtener información del usuario desde la base de datos
$user_id = $_SESSION['user_id'];
$query = "SELECT username, role FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Usuario no encontrado.";
    exit();
}

$user = $result->fetch_assoc();

// Lógica para mostrar diferentes contenido según el rol
if ($user['role'] === 'admin') {
    echo "<h1>Panel de Control - Administrador</h1>";
    // Aquí puedes agregar contenido específico para administradores
    echo "<nav>
            <a href='add_news.php'>Agregar Noticias</a>
            <a href='manage_users.php'>Gestionar Usuarios</a>
            <a href='logout.php'>Cerrar Sesión</a>
          </nav>";
} elseif ($user['role'] === 'editor') {
    echo "<h1>Panel de Control - Editor</h1>";
    // Aquí puedes agregar contenido específico para editores
    echo "<nav>
            <a href='add_news.php'>Agregar Noticias</a>
            <a href='logout.php'>Cerrar Sesión</a>
          </nav>";
} else {
    echo "<h1>Panel de Control - Usuario Normal</h1>";
    echo "<nav>
            <a href='logout.php'>Cerrar Sesión</a>
          </nav>";
}

// Puedes continuar agregando más lógica según tus necesidades

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="panel">
        <h1>Bienvenido, <?php echo htmlspecialchars($user['username']); ?></h1>
        <!-- Más contenido para el panel -->
    </div>
</body>
</html>
