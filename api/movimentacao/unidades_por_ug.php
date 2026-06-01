<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $id_ug = $_GET['id_ug'] ?? null;

    if (!$id_ug) {
        throw new Exception('UG não informada.');
    }

    $stmt = $pdo->prepare("
        SELECT id, nome
        FROM unidades
        WHERE id_ug = :id_ug
          AND status = 'ATIVO'
        ORDER BY nome
    ");

    $stmt->execute([':id_ug' => $id_ug]);

    echo json_encode([
        'sucesso' => true,
        'dados' => $stmt->fetchAll(PDO::FETCH_ASSOC)
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}