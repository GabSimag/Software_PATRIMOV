<?php
session_start();

require_once '../../config/database.php';
require_once '../helpers/auditoria.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    if (!isset($_SESSION['usuario_id'])) {
        throw new Exception('Usuário não autenticado.');
    }

    $id_patrimonio = $_POST['id_patrimonio'] ?? null;
    $id_unidade_destino = $_POST['id_unidade_destino'] ?? null;
    $tipo_movimentacao = $_POST['tipo_movimentacao'] ?? 'TRANSFERENCIA';
    $observacao = trim($_POST['observacao'] ?? '');

    if (!$id_patrimonio || !$id_unidade_destino) {
        throw new Exception('Informe o patrimônio e a unidade de destino.');
    }

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        SELECT id_unidade
        FROM patrimonios
        WHERE id = :id
          AND status = 'ATIVO'
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $id_patrimonio
    ]);

    $patrimonio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patrimonio) {
        throw new Exception('Patrimônio não encontrado ou não está ativo.');
    }

    $id_unidade_origem = $patrimonio['id_unidade'];

    if ($id_unidade_origem == $id_unidade_destino) {
        throw new Exception('A unidade de destino deve ser diferente da unidade atual.');
    }

    $stmtMov = $pdo->prepare("
        INSERT INTO movimentacoes (
            id_patrimonio,
            id_unidade_origem,
            id_unidade_destino,
            id_usuario,
            tipo_movimentacao,
            observacao
        ) VALUES (
            :id_patrimonio,
            :id_unidade_origem,
            :id_unidade_destino,
            :id_usuario,
            :tipo_movimentacao,
            :observacao
        )
    ");

    $stmtMov->execute([
        ':id_patrimonio' => $id_patrimonio,
        ':id_unidade_origem' => $id_unidade_origem,
        ':id_unidade_destino' => $id_unidade_destino,
        ':id_usuario' => $_SESSION['usuario_id'],
        ':tipo_movimentacao' => $tipo_movimentacao,
        ':observacao' => $observacao
    ]);

    $id_movimentacao = $pdo->lastInsertId();

    $stmtUpdate = $pdo->prepare("
        UPDATE patrimonios
        SET id_unidade = :id_unidade_destino
        WHERE id = :id_patrimonio
    ");

    $stmtUpdate->execute([
        ':id_unidade_destino' => $id_unidade_destino,
        ':id_patrimonio' => $id_patrimonio
    ]);

    registrarAuditoria(
        $pdo,
        $_SESSION['usuario_id'],
        'MOVIMENTACAO_CADASTRADA',
        'movimentacoes',
        $id_movimentacao,
        'Movimentação registrada e unidade do patrimônio atualizada.'
    );

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Movimentação registrada com sucesso.'
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