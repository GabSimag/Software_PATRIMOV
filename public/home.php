<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

require_once '../config/database.php';
require_once '../api/auth/check.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema Patrimonial</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/css.php">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <div class="home-grid">

            <!-- COLUNA PRINCIPAL -->

            <div>

                <div class="home-panel">

                    <div class="home-header">

                        <div class="home-user">

                            <h1>Bem-vindo ao Sistema</h1>

                            <p>
                                Gerencie patrimônios, usuários,
                                movimentações e relatórios.
                            </p>

                        </div>

                        <div class="home-badge">

                            Sistema Online

                        </div>

                    </div>

                    <!-- CARDS -->

                    <div class="dashboard-grid">

                        <div class="card-info card-primary">

                            <div class="card-body">

                                <div class="card-top">

                                    <div class="card-left">

                                        <div class="card-main-icon">
                                            <i class="fas fa-boxes"></i>
                                        </div>

                                        <div>

                                            <div class="card-title">
                                                Patrimônios
                                            </div>

                                            <div class="card-value">
                                                248
                                            </div>

                                        </div>

                                    </div>

                                    <i class="fas fa-chart-line card-side-icon"></i>

                                </div>

                                <div class="card-description">
                                    Total de patrimônios cadastrados no sistema.
                                </div>

                            </div>

                            <div class="card-footer">

                                <a href="cadastros.php" class="card-link">

                                    Ver detalhes

                                    <i class="fas fa-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                        <div class="card-info card-success">

                            <div class="card-body">

                                <div class="card-top">

                                    <div class="card-left">

                                        <div class="card-main-icon">
                                            <i class="fas fa-users"></i>
                                        </div>

                                        <div>

                                            <div class="card-title">
                                                Usuários
                                            </div>

                                            <div class="card-value">
                                                32
                                            </div>

                                        </div>

                                    </div>

                                    <i class="fas fa-user-check card-side-icon"></i>

                                </div>

                                <div class="card-description">
                                    Usuários ativos no sistema operacional.
                                </div>

                            </div>

                            <div class="card-footer">

                                <a href="cadastros.php" class="card-link">

                                    Ver detalhes

                                    <i class="fas fa-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- TABELA -->

                <div class="table-container section-spacing">

                    <h2 class="page-title">
                        Últimas Movimentações
                    </h2>

                    <table class="table-modern">

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Patrimônio</th>
                                <th>Responsável</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>#102</td>

                                <td>Notebook Dell</td>

                                <td>Gabriel</td>

                                <td>
                                    <span class="status-success">
                                        Finalizado
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>#103</td>

                                <td>Monitor LG</td>

                                <td>Carlos</td>

                                <td>
                                    <span class="status-warning">
                                        Pendente
                                    </span>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- LATERAL -->

            <div>

                <div class="home-panel">

                    <h2 class="page-title">
                        Acesso Rápido
                    </h2>

                    <div class="quick-actions">

                        <a href="cadastros.php"
                            class="quick-card">

                            <div class="quick-icon quick-primary">
                                <i class="fas fa-user-plus"></i>
                            </div>

                            <div class="quick-title">
                                Cadastros
                            </div>

                            <div class="quick-description">
                                Gerencie usuários e patrimônios.
                            </div>

                        </a>

                        <a href="movimentacao.php"
                            class="quick-card">

                            <div class="quick-icon quick-warning">
                                <i class="fas fa-exchange-alt"></i>
                            </div>

                            <div class="quick-title">
                                Movimentação
                            </div>

                            <div class="quick-description">
                                Controle entradas e saídas.
                            </div>

                        </a>

                        <a href="relatorios.php"
                            class="quick-card">

                            <div class="quick-icon quick-success">
                                <i class="fas fa-chart-bar"></i>
                            </div>

                            <div class="quick-title">
                                Relatórios
                            </div>

                            <div class="quick-description">
                                Visualize relatórios completos.
                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function toggleMenu() {

            document
                .getElementById('sidebar')
                .classList
                .toggle('active');
        }
    </script>

</body>

</html>