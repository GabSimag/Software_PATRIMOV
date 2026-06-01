<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        throw new Exception('Patrimônio não informado.');
    }

    $stmt = $pdo->prepare("
        SELECT
            p.id,
            p.codigo_patrimonial,
            p.descricao,
            p.id_unidade,
            u.nome AS unidade,
            ug.id AS id_ug,
            ug.sigla AS ug_sigla,
            ug.nome_fantasia AS ug_nome
        FROM patrimonios p
        INNER JOIN unidades u ON u.id = p.id_unidade
        INNER JOIN ugs ug ON ug.id = u.id_ug
        WHERE p.id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);
    $patrimonio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patrimonio) {
        throw new Exception('Patrimônio não encontrado.');
    }

    echo json_encode([
        'sucesso' => true,
        'dados' => $patrimonio
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}