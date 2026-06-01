<?php
session_start();

require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    if (!isset($_SESSION['usuario_id'])) {
        throw new Exception('Usuário não autenticado.');
    }

    $id_usuario = $_SESSION['usuario_id'];

    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if ($senha_atual === '' || $nova_senha === '' || $confirmar_senha === '') {
        throw new Exception('Preencha todos os campos.');
    }

    if ($nova_senha !== $confirmar_senha) {
        throw new Exception('A nova senha e a confirmação não conferem.');
    }

    if (strlen($nova_senha) < 6) {
        throw new Exception('A nova senha deve ter pelo menos 6 caracteres.');
    }

    $stmt = $pdo->prepare("
        SELECT senha_hash
        FROM usuarios
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        throw new Exception('Usuário não encontrado.');
    }

    if (!password_verify($senha_atual, $usuario['senha_hash'])) {
        throw new Exception('Senha atual incorreta.');
    }

    $nova_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    $update = $pdo->prepare("
        UPDATE usuarios
        SET senha_hash = :senha_hash
        WHERE id = :id
    ");

    $update->execute([
        ':senha_hash' => $nova_hash,
        ':id' => $id_usuario
    ]);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Senha alterada com sucesso.'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
