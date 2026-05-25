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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.php">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">

    <div class="home-grid">

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

                <div class="dashboard-grid">

                    <div class="card-info card-primary">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Patrimônios</div>

                                        <div class="card-value">
                                            <span id="totalPatrimonios">0</span>
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
                            <a href="patrimonios.php" class="card-link">
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
                                        <i class="fas fa-check-circle"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Patrimônios Ativos</div>

                                        <div class="card-value">
                                            <span id="patrimoniosAtivos">0</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-box-open card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Patrimônios atualmente ativos no sistema.
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="patrimonios.php" class="card-link">
                                Ver detalhes
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-info card-danger">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-box-archive"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Patrimônios Baixados</div>

                                        <div class="card-value">
                                            <span id="patrimoniosBaixados">0</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-ban card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Patrimônios baixados do sistema.
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="patrimonios.php" class="card-link">
                                Ver detalhes
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-info card-warning">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Serviços Pendentes</div>

                                        <div class="card-value">
                                            <span id="servicosSolicitados">0</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-tools card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Serviços aguardando conclusão.
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="servicos.php" class="card-link">
                                Ver detalhes
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-info card-primary">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-check"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Serviços Concluídos</div>

                                        <div class="card-value">
                                            <span id="servicosConcluidos">0</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-clipboard-check card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Patrimoniações concluídas.
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="servicos.php" class="card-link">
                                Ver detalhes
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-info card-primary">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-coins"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Valor Total</div>

                                        <div class="card-value money-value">
                                            <span id="valorTotal">R$ 0,00</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-coins card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Soma total dos patrimônios cadastrados.
                            </div>

                        </div>
                    </div>

                    <div class="card-info card-success">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Valor Ativo</div>

                                        <div class="card-value money-value">
                                            <span id="valorAtivo">R$ 0,00</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-chart-line card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Valor patrimonial atualmente ativo.
                            </div>

                        </div>
                    </div>

                    <div class="card-info card-danger">
                        <div class="card-body">
                            <div class="card-top">

                                <div class="card-left">

                                    <div class="card-main-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>

                                    <div>
                                        <div class="card-title">Valor Baixado</div>

                                        <div class="card-value money-value">
                                            <span id="valorBaixado">R$ 0,00</span>
                                        </div>
                                    </div>

                                </div>

                                <i class="fas fa-arrow-down card-side-icon"></i>

                            </div>

                            <div class="card-description">
                                Valor total de patrimônios baixados.
                            </div>

                        </div>
                    </div>

                </div>

            </div>

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

                    <tbody id="tabelaUltimasMovimentacoes">
                        <tr>
                            <td colspan="4">Carregando movimentações...</td>
                        </tr>
                    </tbody>

                </table>

            </div>

        </div>

        <div>

            <div class="home-panel">

                <h2 class="page-title">
                    Acesso Rápido
                </h2>

                <div class="quick-actions">

                    <a href="cadastros.php" class="quick-card">

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

                    <a href="movimentacoes.php" class="quick-card">

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

                    <a href="relatorios.php" class="quick-card">

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

<script src="assets/js/home.js"></script>
<?php include 'includes/footer.php'; ?>