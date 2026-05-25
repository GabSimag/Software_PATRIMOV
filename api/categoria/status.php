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

    $stmt = $pdo->prepare("
        SELECT status
        FROM categorias
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);

    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$categoria) {
        throw new Exception('Categoria não encontrada.');
    }

    $novoStatus =
        $categoria['status'] === 'ATIVO'
        ? 'INATIVO'
        : 'ATIVO';

    $update = $pdo->prepare("
        UPDATE categorias
        SET status = :status
        WHERE id = :id
    ");

    $update->execute([
        ':status' => $novoStatus,
        ':id' => $id
    ]);

    echo json_encode([
        'sucesso' => true
    ]);

} catch (Exception $e) {

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);

}