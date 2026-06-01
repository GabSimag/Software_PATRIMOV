<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $unidades = $pdo->query("
        SELECT id, nome
        FROM unidades
        WHERE status = 'ATIVO'
        ORDER BY nome
    ")->fetchAll(PDO::FETCH_ASSOC);

    $categorias = $pdo->query("
        SELECT id, nome
        FROM categorias
        WHERE status = 'ATIVO'
        ORDER BY nome
    ")->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'sucesso' => true,
        'unidades' => $unidades,
        'categorias' => $categorias
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}