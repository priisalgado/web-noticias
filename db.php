<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto si usas otra contraseña
$dbname = "news_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
