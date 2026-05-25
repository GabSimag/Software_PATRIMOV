<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $stmt = $pdo->query("
        SELECT
            id,
            codigo,
            sigla,
            nome_fantasia,
            origem,
            status
        FROM ugs
        ORDER BY nome_fantasia
    ");

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