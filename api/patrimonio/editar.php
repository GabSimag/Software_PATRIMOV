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
    $item = trim($_POST['item'] ?? '');
    $numero_nota = trim($_POST['numero_nota'] ?? '');
    $serie = trim($_POST['serie'] ?? '');
    $data_nota = $_POST['data_nota'] ?? null;
    $data_empenho = $_POST['data_empenho'] ?? null;
    $numero_empenho = trim($_POST['numero_empenho'] ?? '');
    $numero_processo = trim($_POST['numero_processo_administrativo'] ?? '');

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
        status = :status,
        item = :item,
        numero_nota = :numero_nota,
        serie = :serie,
        data_nota = :data_nota,
        data_empenho = :data_empenho,
        numero_empenho = :numero_empenho,
        numero_processo_administrativo = :numero_processo
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
        ':id' => $id,
        ':item' => $item,
        ':numero_nota' => $numero_nota,
        ':serie' => $serie,
        ':data_nota' => $data_nota ?: null,
        ':data_empenho' => $data_empenho ?: null,
        ':numero_empenho' => $numero_empenho,
        ':numero_processo' => $numero_processo
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
