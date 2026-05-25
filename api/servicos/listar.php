<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->query("
        SELECT
            s.id,
            s.tipo_servico,
            s.descricao,
            s.data_solicitacao,
            s.data_execucao,
            s.custo,
            s.status,

            p.codigo_patrimonial,
            p.descricao AS patrimonio,

            u.nome AS unidade,

            us.nome AS usuario

        FROM servicos s

        INNER JOIN patrimonios p
            ON s.id_patrimonio = p.id

        INNER JOIN unidades u
            ON p.id_unidade = u.id

        INNER JOIN usuarios us
            ON s.id_usuario = us.id

        ORDER BY s.id DESC
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
