<?php
session_start();

require_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    
    header("Location: ../../public/index.php");
    exit();
}

$usuario = trim($_POST['usuario'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($usuario === '' || $senha === '') {
    header("Location: ../../public/index.php?erro=dados_invalidos");
    exit();
}

$stmt = $pdo->prepare("
    SELECT
        u.id,
        u.nome,
        u.usuario,
        u.senha_hash,
        u.status,
        p.nome AS perfil
    FROM usuarios u
    INNER JOIN perfis p ON u.id_perfil = p.id
    WHERE u.usuario = :usuario
    LIMIT 1
");

$stmt->execute([
    ':usuario' => $usuario
]);

$usuarioBanco = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuarioBanco) {
    header("Location: ../../public/index.php?erro=dados_invalidos");
    exit();
}

if ($usuarioBanco['status'] !== 'ATIVO') {
    header("Location: ../../public/index.php?erro=usuario_inativo");
    exit();
}

if (!password_verify($senha, $usuarioBanco['senha_hash'])) {
    header("Location: ../../public/index.php?erro=dados_invalidos");
    exit();
}

$_SESSION['usuario_id'] = $usuarioBanco['id'];
$_SESSION['usuario_nome'] = $usuarioBanco['nome'];
$_SESSION['usuario_login'] = $usuarioBanco['usuario'];
$_SESSION['usuario_perfil'] = $usuarioBanco['perfil'];
registrarAuditoria(
    $pdo,
    $usuarioBanco['id'],
    'LOGIN',
    'usuarios',
    $usuarioBanco['id'],
    'Login realizado com sucesso.'
);
header("Location: ../../public/home.php");
exit();
