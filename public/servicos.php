<?php
/*
=========================================================================
MÓDULO OPERACIONAL: GERENCIAMENTO DE SERVIÇOS
=========================================================================
*/

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

    <title>Serviços - Sistema Patrimonial</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/css.php">

</head>

<body class="logado">

    <!-- SIDEBAR -->
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>
    <!-- CONTEÚDO -->
    <div class="main-content">

        <!-- HEADER -->
        <header class="header-operacional">

            <div>

                <h1 class="page-title">
                    Gerenciar Serviços
                </h1>

                <p class="page-subtitle">
                    Acompanhe, filtre e gerencie as ordens de serviço.
                </p>

            </div>

        </header>

        <!-- TOOLBAR -->
        <div class="toolbar">

            <!-- BUSCA -->
            <div class="search-box">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    id="campoBuscaServico"
                    placeholder="Buscar serviço...">

            </div>

            <!-- BOTÕES -->
            <div class="toolbar-actions">

                <button class="btn-toolbar btn-filter">

                    <i class="fas fa-filter"></i>

                    Filtrar

                </button>

                <a href="servico_cadastrar.php"
                    class="btn-toolbar btn-new"
                    style="text-decoration:none; display:flex; align-items:center;">

                    <i class="fas fa-plus"></i>

                    Novo Serviço

                </a>

            </div>

        </div>

        <!-- TABELA -->
        <table class="service-table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Unidade</th>

                    <th>Tipo de Serviço</th>

                    <th>Status</th>

                    <th>Ações</th>

                </tr>

            </thead>

            <tbody id="tabelaServicos">
                <tr>
                    <td colspan="5">Carregando serviços...</td>
                </tr>
            </tbody>

        </table>
        <div id="paginacaoServicos" class="pagination"></div>
    </div>

    <script src="assets/js/servico.js"></script>
<?php include 'includes/footer.php'; ?>