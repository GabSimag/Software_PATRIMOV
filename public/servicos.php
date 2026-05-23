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
                    placeholder="Buscar serviço...">

            </div>

            <!-- BOTÕES -->
            <div class="toolbar-actions">

                <button class="btn-toolbar btn-filter">

                    <i class="fas fa-filter"></i>

                    Filtrar

                </button>

                <button class="btn-toolbar btn-new">

                    <i class="fas fa-plus"></i>

                    Novo Serviço

                </button>

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

                <tbody>

                    <tr>

                        <td>#102</td>

                        <td>TI - MATRIZ</td>

                        <td>Formatação</td>

                        <td>

                            <span class="badge badge-warning">
                                Pendente
                            </span>

                        </td>

                        <td>

                            <button class="btn-manage">

                                <i class="fas fa-gear"></i>

                                Gerenciar

                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>#103</td>

                        <td>Financeiro</td>

                        <td>Troca de Hardware</td>

                        <td>

                            <span class="badge badge-primary">
                                Em andamento
                            </span>

                        </td>

                        <td>

                            <button class="btn-manage">

                                <i class="fas fa-gear"></i>

                                Gerenciar

                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>#104</td>

                        <td>RH</td>

                        <td>Instalação</td>

                        <td>

                            <span class="badge badge-success">
                                Finalizado
                            </span>

                        </td>

                        <td>

                            <button class="btn-manage">

                                <i class="fas fa-gear"></i>

                                Gerenciar

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>