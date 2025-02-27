<?php
$host = 'localhost';
$db = 'formation';
$user = 'root';
$pass = '';

// Conexão com o banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}
?>