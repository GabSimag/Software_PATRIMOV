<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;
    $codigo = trim($_POST['codigo_patrimonial'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $id_categoria = $_POST['id_categoria'] ?? '';
    $id_unidade = $_POST['id_unidade'] ?? '';
    $estado = $_POST['estado_conservacao'] ?? '';
    $status = $_POST['status'] ?? 'ativo';

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if ($codigo === '' || $descricao === '' || $id_categoria === '' || $id_unidade === '') {
        throw new Exception('Preencha os campos obrigatórios.');
    }

    $sql = "
        UPDATE patrimonios SET
            codigo_patrimonial = :codigo_patrimonial,
            descricao = :descricao,
            marca = :marca,
            modelo = :modelo,
            id_categoria = :id_categoria,
            id_unidade = :id_unidade,
            estado_conservacao = :estado_conservacao,
            status = :status
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':codigo_patrimonial' => $codigo,
        ':descricao' => $descricao,
        ':marca' => $marca,
        ':modelo' => $modelo,
        ':id_categoria' => $id_categoria,
        ':id_unidade' => $id_unidade,
        ':estado_conservacao' => $estado,
        ':status' => $status,
        ':id' => $id
    ]);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Patrimônio atualizado com sucesso.'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}