<?php
session_start();
require_once '../../config/database.php';
require_once '../helpers/auditoria.php';
header('Content-Type: application/json; charset=utf-8');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;

    if (!$id) {
        throw new Exception('Usuário não informado.');
    }
    $id_logado = $_SESSION['usuario_id'] ?? null;

    if ($id == $id_logado) {
        throw new Exception('Você não pode inativar o próprio usuário logado.');
    }
    $stmt = $pdo->prepare("
        SELECT status
        FROM usuarios
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        ':id' => $id
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        throw new Exception('Usuário não encontrado.');
    }

    $novoStatus =
        $usuario['status'] === 'ATIVO'
        ? 'INATIVO'
        : 'ATIVO';

    $update = $pdo->prepare("
        UPDATE usuarios
        SET status = :status
        WHERE id = :id
    ");

    $update->execute([
        ':status' => $novoStatus,
        ':id' => $id
    ]);
    registrarAuditoria(
        $pdo,
        $_SESSION['usuario_id'],
        'USUARIO_STATUS',
        'usuarios',
        $id,
        'Status alterado para ' . $novoStatus
    );
    echo json_encode([
        'sucesso' => true
    ]);
} catch (Exception $e) {

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
