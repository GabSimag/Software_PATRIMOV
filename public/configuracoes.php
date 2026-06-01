<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require_once '../api/auth/check.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Configurações - PATRIMOV</title>
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
                <label>Nome do Sistema</label>
                <div class="form-input-icon">
                    <i class="fas fa-boxes"></i>
                    <input type="text" value="PATRIMOV" disabled>
                </div>
            </div>

            <div class="form-group">
                <label>Versão</label>
                <div class="form-input-icon">
                    <i class="fas fa-code-branch"></i>
                    <input type="text" value="1.0.0" disabled>
                </div>
            </div>

            <div class="form-group">
                <label>Ambiente</label>
                <div class="form-input-icon">
                    <i class="fas fa-server"></i>
                    <input type="text" value="Docker / PHP / MariaDB" disabled>
                </div>
            </div>

            <div class="form-group">
                <label>Tema</label>
                <div class="form-input-icon">
                    <i class="fas fa-moon"></i>
                    <input id="temaAtual" type="text" value="Claro" disabled>
                </div>
            </div>

        </div>

        <div class="form-actions">
            <button type="button" id="btnLimparTema" class="btn-secondary">
                <i class="fas fa-rotate-left"></i>
                Restaurar tema padrão
            </button>
        </div>

    </div>

</div>

<script src="assets/js/configuracoes.js"></script>
<?php include 'includes/footer.php'; ?>