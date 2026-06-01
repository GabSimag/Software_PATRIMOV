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
    <title>Movimentações - Sistema Patrimonial</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>
    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Movimentações</h1>
                <p class="page-subtitle">Histórico de movimentações patrimoniais.</p>
            </div>
        </header>

        <div class="toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="campoBuscaMovimentacao" placeholder="Buscar movimentação...">
            </div>
            <a href="movimentacao_cadastrar.php"
                class="btn-toolbar btn-new"
                style="text-decoration:none;">
                <i class="fas fa-plus"></i>
                Nova Movimentação
            </a>
        </div>

        <table class="service-table">
            <thead>
                <tr>
                    <th>Patrimônio</th>
                    <th>Tipo</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Data</th>
                    <th>Observação</th>
                </tr>
            </thead>

            <tbody id="tabelaMovimentacoes">
                <tr>
                    <td colspan="6">Carregando movimentações...</td>
                </tr>
            </tbody>
        </table>
        <div id="paginacaoMovimentacoes" class="pagination"></div>
    </div>

    <script src="assets/js/movimentacoes.js"></script>
    <?php include 'includes/footer.php'; ?>