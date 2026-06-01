<?php
session_start();
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');
require_once '../helpers/auditoria.php';
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $nome = trim($_POST['nome'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $id_perfil = $_POST['id_perfil'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if ($nome === '' || $usuario === '' || $email === '' || $id_perfil === '' || $senha === '') {
        throw new Exception('Preencha todos os campos obrigatórios.');
    }

    if ($senha !== $confirmar_senha) {
        throw new Exception('As senhas não conferem.');
    }

    if (strlen($senha) < 6) {
        throw new Exception('A senha deve ter pelo menos 6 caracteres.');
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO usuarios (
            id_perfil,
            nome,
            usuario,
            email,
            senha_hash,
            status
        ) VALUES (
            :id_perfil,
            :nome,
            :usuario,
            :email,
            :senha_hash,
            'ATIVO'
        )
    ");

    $stmt->execute([
        ':id_perfil' => $id_perfil,
        ':nome' => $nome,
        ':usuario' => $usuario,
        ':email' => $email,
        ':senha_hash' => $senha_hash
    ]);
    registrarAuditoria(
        $pdo,
        $_SESSION['usuario_id'],
        'USUARIO_CRIADO',
        'usuarios',
        $pdo->lastInsertId(),
        'Novo usuário cadastrado.'
    );
    echo json_encode(['sucesso' => true]);
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
