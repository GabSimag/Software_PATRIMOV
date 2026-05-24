<?php
// Inicia a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// CONFIGURAÇÃO PARA XAMPP LOCAL
$host = "localhost";
$db   = "patrimov"; // O nome do banco que você criou no phpMyAdmin
$user = "root";
$pass = ""; // Senha padrão do XAMPP é vazia

try {
    // Criamos a conexão PDO apontando para o seu computador (localhost)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    
    // Configuramos o PDO para avisar se houver qualquer erro de SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Se ainda der erro, ele vai dizer exatamente o que houve
    die("Erro na conexão local: " . $e->getMessage());
}
?>
