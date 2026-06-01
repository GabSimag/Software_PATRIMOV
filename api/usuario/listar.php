<?php

require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $stmt = $pdo->query("
        SELECT
            u.id,
            u.nome,
            u.usuario,
            u.email,
            u.status,
            p.nome AS perfil
        FROM usuarios u
        INNER JOIN perfis p
            ON p.id = u.id_perfil
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