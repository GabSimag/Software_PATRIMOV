<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrimônios - Sistema Patrimonial</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/css.php">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Gerenciar Patrimônios</h1>
                <p class="page-subtitle">
                    Consulte, filtre e gerencie os patrimônios cadastrados.
                </p>
            </div>
        </header>

        <div class="toolbar">

            <div class="search-box">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    id="campoBusca"
                    placeholder="Buscar patrimônio...">
            </div>

            <div class="toolbar-actions">

                <button class="btn-toolbar btn-filter">
                    <i class="fas fa-filter"></i>
                    Filtrar
                </button>

                <a href="patrimonio_cadastrar.php" class="btn-toolbar btn-new" style="text-decoration:none; display:flex; align-items:center;">
                    <i class="fas fa-plus"></i>
                    Novo Patrimônio
                </a>

            </div>

        </div>

        <table class="service-table">

            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Estado</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody id="tabelaPatrimonios">
                <tr>
                    <td colspan="7">Carregando patrimônios...</td>
                </tr>
            </tbody>

        </table>

    </div>
    <?php include 'includes/modals/modal_baixa_patrimonio.php'; ?>
    <script src="assets/js/patrimonios.js"></script>
<?php include 'includes/footer.php'; ?>