<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    $stmt = $pdo->prepare("SELECT status FROM unidades WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);

    $unidade = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$unidade) {
        throw new Exception('Unidade não encontrada.');
    }

    $novoStatus = $unidade['status'] === 'ATIVO' ? 'INATIVO' : 'ATIVO';

    $update = $pdo->prepare("UPDATE unidades SET status = :status WHERE id = :id");
    $update->execute([
        ':status' => $novoStatus,
        ':id' => $id
    ]);

    echo json_encode(['sucesso' => true]);
} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}