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
    $id_logado = $_SESSION['usuario_id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $id_perfil = $_POST['id_perfil'] ?? '';

    if (!$id) {
        throw new Exception('Usuário não informado.');
    }

    if (
        $nome === '' ||
        $usuario === '' ||
        $email === '' ||
        $id_perfil === ''
    ) {
        throw new Exception('Preencha todos os campos.');
    }
    if ($id == $id_logado) {
        $stmtAtual = $pdo->prepare("
        SELECT id_perfil
        FROM usuarios
        WHERE id = :id
        LIMIT 1
    ");

        $stmtAtual->execute([':id' => $id]);
        $usuarioAtual = $stmtAtual->fetch(PDO::FETCH_ASSOC);

        if ($usuarioAtual && $usuarioAtual['id_perfil'] != $id_perfil) {
            throw new Exception('Você não pode alterar o próprio perfil.');
        }
    }
    $stmt = $pdo->prepare("
        UPDATE usuarios
        SET
            nome = :nome,
            usuario = :usuario,
            email = :email,
            id_perfil = :id_perfil
        WHERE id = :id
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':usuario' => $usuario,
        ':email' => $email,
        ':id_perfil' => $id_perfil,
        ':id' => $id
    ]);
    registrarAuditoria(
        $pdo,
        $_SESSION['usuario_id'],
        'USUARIO_EDITADO',
        'usuarios',
        $id,
        'Dados do usuário atualizados.'
    );
    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Usuário atualizado com sucesso.'
    ]);
} catch (Exception $e) {
    if ($e->getCode() == 23000) {
        echo json_encode([
            'sucesso' => false,
            'erro' => 'Usuário ou e-mail já cadastrado.'
        ]);
        exit();
    }

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
