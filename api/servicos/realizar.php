<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id_servico = $_POST['id_servico'] ?? null;

    $item = trim($_POST['item'] ?? '');
    $numero_nota = trim($_POST['numero_nota'] ?? '');
    $serie = trim($_POST['serie'] ?? '');
    $data_nota = $_POST['data_nota'] ?? null;
    $data_empenho = $_POST['data_empenho'] ?? null;
    $numero_empenho = trim($_POST['numero_empenho'] ?? '');
    $numero_processo = trim($_POST['numero_processo_administrativo'] ?? '');
    $valor = str_replace(',', '.', $_POST['valor'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');

    if (!$id_servico) {
        throw new Exception('ID do serviço não informado.');
    }

    if ($descricao === '') {
        throw new Exception('Informe a observação da patrimoniação.');
    }

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        SELECT id_patrimonio
        FROM servicos
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id_servico]);
    $servico = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$servico) {
        throw new Exception('Serviço não encontrado.');
    }

    $id_patrimonio = $servico['id_patrimonio'];

    $stmtPatrimonio = $pdo->prepare("
        UPDATE patrimonios SET
            item = :item,
            numero_nota = :numero_nota,
            serie = :serie,
            data_nota = :data_nota,
            data_empenho = :data_empenho,
            numero_empenho = :numero_empenho,
            numero_processo_administrativo = :numero_processo,
            status = 'ATIVO',
            valor = :valor
        WHERE id = :id_patrimonio
    ");

    $stmtPatrimonio->execute([
        ':item' => $item,
        ':numero_nota' => $numero_nota,
        ':serie' => $serie,
        ':data_nota' => $data_nota ?: null,
        ':data_empenho' => $data_empenho ?: null,
        ':numero_empenho' => $numero_empenho,
        ':numero_processo' => $numero_processo,
        ':valor' => $valor,
        ':id_patrimonio' => $id_patrimonio
    ]);

    $stmtServico = $pdo->prepare("
        UPDATE servicos SET
            descricao = :descricao,
            status = 'CONCLUIDO',
            data_execucao = NOW()
        WHERE id = :id_servico
    ");

    $stmtServico->execute([
        ':descricao' => $descricao,
        ':id_servico' => $id_servico
    ]);

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Patrimoniação concluída com sucesso.'
    ]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
