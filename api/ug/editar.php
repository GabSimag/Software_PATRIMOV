<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;

    $codigo = trim($_POST['codigo'] ?? '');
    $sigla = trim($_POST['sigla'] ?? '');
    $nome_fantasia = trim($_POST['nome_fantasia'] ?? '');
    $origem = trim($_POST['origem'] ?? '');

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if (
        $codigo === '' ||
        $sigla === '' ||
        $nome_fantasia === '' ||
        $origem === ''
    ) {
        throw new Exception('Preencha todos os campos obrigatórios.');
    }

    $stmt = $pdo->prepare("
        UPDATE ugs SET
            codigo = :codigo,
            sigla = :sigla,
            nome_fantasia = :nome_fantasia,
            origem = :origem
        WHERE id = :id
    ");

    $stmt->execute([
        ':codigo' => $codigo,
        ':sigla' => $sigla,
        ':nome_fantasia' => $nome_fantasia,
        ':origem' => $origem,
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