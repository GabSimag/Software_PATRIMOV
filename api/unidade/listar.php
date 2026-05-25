<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->query("
        SELECT
            u.id,
            u.nome,
            u.endereco,
            u.telefone,
            u.status,
            ug.nome_fantasia AS ug
        FROM unidades u
        INNER JOIN ugs ug ON u.id_ug = ug.id
        ORDER BY u.nome
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