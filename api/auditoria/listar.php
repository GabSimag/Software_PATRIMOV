<?php

require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $stmt = $pdo->query("
        SELECT
            l.id,
            l.acao,
            l.tabela_afetada,
            l.registro_id,
            l.detalhes,
            l.ip_origem,
            l.data_hora,
            u.nome AS usuario
        FROM logs_auditoria l
        LEFT JOIN usuarios u
            ON u.id = l.id_usuario
        ORDER BY l.id DESC
        LIMIT 500
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