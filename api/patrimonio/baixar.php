<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;
    $motivo = trim($_POST['motivo_baixa'] ?? '');
    $id_usuario = $_SESSION['usuario_id'] ?? 1;

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if ($motivo === '') {
        throw new Exception('Informe o motivo da baixa.');
    }

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("
        SELECT id_unidade
        FROM patrimonios
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);
    $patrimonio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patrimonio) {
        throw new Exception('Patrimônio não encontrado.');
    }

    $sql = "
        UPDATE patrimonios
        SET
            status = 'BAIXADO',
            motivo_baixa = :motivo,
            data_baixa = NOW()
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':motivo' => $motivo,
        ':id' => $id
    ]);

    $sqlMov = "
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
            NULL,
            :id_usuario,
            'BAIXA',
            :observacao
        )
    ";

    $stmtMov = $pdo->prepare($sqlMov);

    $stmtMov->execute([
        ':id_patrimonio' => $id,
        ':id_unidade_origem' => $patrimonio['id_unidade'],
        ':id_usuario' => $id_usuario,
        ':observacao' => $motivo
    ]);

    $pdo->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Patrimônio baixado e movimentação registrada.'
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
