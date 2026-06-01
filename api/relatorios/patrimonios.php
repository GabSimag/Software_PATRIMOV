<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $status = $_GET['status'] ?? null;
    $id_unidade = $_GET['id_unidade'] ?? null;
    $id_categoria = $_GET['id_categoria'] ?? null;

    $stmt = $pdo->prepare("
        CALL sp_relatorio_patrimonios(
            :status,
            :id_unidade,
            :id_categoria
        )
    ");

    $stmt->bindValue(':status', $status ?: null);
    $stmt->bindValue(':id_unidade', $id_unidade ?: null, PDO::PARAM_INT);
    $stmt->bindValue(':id_categoria', $id_categoria ?: null, PDO::PARAM_INT);

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