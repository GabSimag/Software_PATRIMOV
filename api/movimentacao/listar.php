<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->query("
        SELECT
            m.id,
            p.codigo_patrimonial,
            p.descricao AS patrimonio,
            m.tipo_movimentacao,
            uo.nome AS unidade_origem,
            ud.nome AS unidade_destino,
            us.nome AS usuario,
            m.observacao,
            m.data_movimentacao
        FROM movimentacoes m
        INNER JOIN patrimonios p ON m.id_patrimonio = p.id
        INNER JOIN unidades uo ON m.id_unidade_origem = uo.id
        LEFT JOIN unidades ud ON m.id_unidade_destino = ud.id
        INNER JOIN usuarios us ON m.id_usuario = us.id
        ORDER BY m.data_movimentacao DESC
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
