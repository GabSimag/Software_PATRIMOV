<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->query("
        SELECT
            m.id,
            m.tipo_movimentacao,
            m.data_movimentacao,
            m.observacao,
            p.codigo_patrimonial,
            p.descricao AS patrimonio,
            uo.nome AS unidade_origem,
            ud.nome AS unidade_destino
        FROM movimentacoes m
        INNER JOIN patrimonios p ON m.id_patrimonio = p.id
        LEFT JOIN unidades uo ON m.id_unidade_origem = uo.id
        LEFT JOIN unidades ud ON m.id_unidade_destino = ud.id
        ORDER BY m.data_movimentacao DESC
        LIMIT 5
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