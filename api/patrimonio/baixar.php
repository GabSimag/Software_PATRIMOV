<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;
    $motivo = trim($_POST['motivo_baixa'] ?? '');

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if ($motivo === '') {
        throw new Exception('Informe o motivo da baixa.');
    }

    $sql = "
        UPDATE patrimonios
        SET
            status = 'baixado',
            motivo_baixa = :motivo,
            data_baixa = NOW()
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':motivo' => $motivo,
        ':id' => $id
    ]);

    echo json_encode([
        'sucesso' => true
    ]);

} catch (Exception $e) {

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}