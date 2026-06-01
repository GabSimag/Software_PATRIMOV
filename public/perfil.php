<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

$id_usuario = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("
    SELECT
        u.id,
        u.nome,
        u.usuario,
        u.email,
        u.status,
        u.data_cadastro,
        p.nome AS perfil
    FROM usuarios u
    INNER JOIN perfis p ON u.id_perfil = p.id
    WHERE u.id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - Sistema Patrimonial</title>
    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <div class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nome</label>
                    <div class="form-input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Usuário</label>
                    <div class="form-input-icon">
                        <i class="fas fa-id-badge"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['usuario'] ?? '') ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="form-input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Perfil</label>
                    <div class="form-input-icon">
                        <i class="fas fa-user-shield"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['perfil'] ?? 'Administrador') ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="form-input-icon">
                        <i class="fas fa-circle-check"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['status'] ?? 'ATIVO') ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>Data de Cadastro</label>
                    <div class="form-input-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="text" value="<?= htmlspecialchars($usuario['data_cadastro'] ?? '-') ?>" disabled>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="alterar_senha.php" class="btn-primary">
                    <i class="fas fa-key"></i>
                    Alterar Senha
                </a>
            </div>

        </div>

    </div>

    <?php include 'includes/footer.php'; ?>