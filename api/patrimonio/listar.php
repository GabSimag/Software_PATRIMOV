<?php

require_once '../../config/database.php';

header('Content-Type: application/json');

try {

    $sql = "
        SELECT
            p.id,
            p.codigo_patrimonial,
            p.descricao,
            p.marca,
            p.modelo,
            p.estado_conservacao,
            p.status,

            c.nome AS categoria,

            u.nome AS unidade

        FROM patrimonios p

        INNER JOIN categorias c
            ON p.id_categoria = c.id

        INNER JOIN unidades u
            ON p.id_unidade = u.id

        ORDER BY p.id DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'sucesso' => true,
        'dados' => $dados
    ]);

} catch (Exception $e) {

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}