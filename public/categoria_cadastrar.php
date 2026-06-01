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
    <title>Nova Categoria</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Nova Categoria</h1>
                <p class="page-subtitle">Cadastre uma nova categoria patrimonial.</p>
            </div>
        </header>

        <form id="formCategoria" class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>Nome da Categoria</label>
                    <div class="form-input-icon">
                        <i class="fas fa-layer-group"></i>
                        <input type="text" name="nome" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Descrição</label>
                    <div class="form-input-icon textarea-icon">
                        <i class="fas fa-align-left"></i>
                        <textarea
                            class="form-textarea"
                            name="descricao"
                            placeholder="Descreva detalhadamente a finalidade desta categoria patrimonial..."></textarea>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="categorias.php" class="btn-secondary">Cancelar</a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Categoria
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/categoria-cadastro.js"></script>
    <?php include 'includes/footer.php'; ?>