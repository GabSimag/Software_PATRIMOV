<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    if ($nome === '') {
        throw new Exception('Informe o nome da categoria.');
    }

    $stmt = $pdo->prepare("
        INSERT INTO categorias (nome, descricao)
        VALUES (:nome, :descricao)
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao
    ]);

    echo json_encode(['sucesso' => true]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}