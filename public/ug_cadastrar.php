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
    <title>Nova UG</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">

    <header class="header-operacional">
        <div>
            <h1 class="page-title">Nova UG</h1>
            <p class="page-subtitle">Cadastre uma nova Unidade Gestora.</p>
        </div>
    </header>

    <form id="formUg" class="form-card">

        <div class="form-grid">

            <div class="form-group">
                <label>Código</label>

                <div class="form-input-icon">
                    <i class="fas fa-barcode"></i>
                    <input type="text" name="codigo" required>
                </div>
            </div>

            <div class="form-group">
                <label>Sigla</label>

                <div class="form-input-icon">
                    <i class="fas fa-signature"></i>
                    <input type="text" name="sigla" required>
                </div>
            </div>

            <div class="form-group">
                <label>Nome Fantasia</label>

                <div class="form-input-icon">
                    <i class="fas fa-building-columns"></i>
                    <input type="text" name="nome_fantasia" required>
                </div>
            </div>

            <div class="form-group">
                <label>Origem</label>

                <div class="form-input-icon">
                    <i class="fas fa-sitemap"></i>

                    <select name="origem" required>
                        <option value="">Selecione...</option>
                        <option value="Prefeitura">Prefeitura</option>
                        <option value="Educação">Educação</option>
                        <option value="Saúde">Saúde</option>
                        <option value="Assistência Social">Assistência Social</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="form-actions">

            <a href="unidades.php" class="btn-secondary">
                Cancelar
            </a>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Salvar UG
            </button>

        </div>

    </form>

</div>

<script src="assets/js/ug-cadastro.js"></script>
<?php include 'includes/footer.php'; ?>