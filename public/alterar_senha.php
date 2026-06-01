<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha - Sistema Patrimonial</title>
    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div class="main-content">
    <form id="formAlterarSenha" class="form-card">

        <div class="form-grid">
            <div class="form-group full-width">
                <label>Senha Atual</label>
                <div class="form-input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha_atual" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nova Senha</label>
                <div class="form-input-icon">
                    <i class="fas fa-key"></i>
                    <input type="password" name="nova_senha" required>
                </div>
            </div>

            <div class="form-group">
                <label>Confirmar Nova Senha</label>
                <div class="form-input-icon">
                    <i class="fas fa-check"></i>
                    <input type="password" name="confirmar_senha" required>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="perfil.php" class="btn-secondary">Cancelar</a>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Alterar Senha
            </button>
        </div>

    </form>
</div>

<script src="assets/js/alterar-senha.js"></script>
<?php include 'includes/footer.php'; ?>