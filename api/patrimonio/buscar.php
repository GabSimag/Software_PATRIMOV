<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    $sql = "SELECT * FROM patrimonios WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
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