<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $codigo = trim($_POST['codigo'] ?? '');
    $nome_fantasia = trim($_POST['nome_fantasia'] ?? '');
    $sigla = trim($_POST['sigla'] ?? '');
    $origem = trim($_POST['origem'] ?? '');

    if ($codigo === '' || $nome_fantasia === '' || $sigla === '' || $origem === '') {
        throw new Exception('Preencha todos os campos obrigatórios.');
    }

    $stmt = $pdo->prepare("
        INSERT INTO ugs (
            codigo,
            nome_fantasia,
            sigla,
            origem
        ) VALUES (
            :codigo,
            :nome_fantasia,
            :sigla,
            :origem
        )
    ");

    $stmt->execute([
        ':codigo' => $codigo,
        ':nome_fantasia' => $nome_fantasia,
        ':sigla' => $sigla,
        ':origem' => $origem
    ]);

    echo json_encode(['sucesso' => true]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}