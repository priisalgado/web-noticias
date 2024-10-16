<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['user_id'];

    $query = "INSERT INTO news (title, content, author_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $title, $content, $author_id);
    
    if ($stmt->execute()) {
        echo "Noticia agregada exitosamente.";
    } else {
        echo "Error al agregar la noticia.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Noticias</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="add_news.php" method="POST">
        <h2>Agregar Nueva Noticia</h2>
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Contenido:</label>
        <textarea id="content" name="content" required></textarea>

        <button type="submit">Agregar Noticia</button>
    </form>
</body>
</html>

