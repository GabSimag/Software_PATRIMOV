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
        FROM ugs
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);

    $ug = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ug) {
        throw new Exception('UG não encontrada.');
    }

    $novoStatus =
        $ug['status'] === 'ATIVO'
        ? 'INATIVO'
        : 'ATIVO';

    $update = $pdo->prepare("
        UPDATE ugs
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