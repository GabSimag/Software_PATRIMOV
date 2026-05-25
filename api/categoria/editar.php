<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if ($nome === '') {
        throw new Exception('Informe o nome da categoria.');
    }

    $stmt = $pdo->prepare("
        UPDATE categorias SET
            nome = :nome,
            descricao = :descricao
        WHERE id = :id
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':id' => $id
    ]);

    echo json_encode(['sucesso' => true]);
} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
