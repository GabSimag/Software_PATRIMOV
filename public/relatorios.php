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
    <title>Relatórios - PATRIMOV</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <div class="toolbar relatorio-toolbar">

            <div class="toolbar-actions">
                <select id="filtroUnidade" class="form-control">
                    <option value="">Todas as Unidades</option>
                </select>

                <select id="filtroCategoria" class="form-control">
                    <option value="">Todas as Categorias</option>
                </select>

                <select id="filtroStatus" class="form-control">
                    <option value="">Todos os Status</option>
                    <option value="ATIVO">Ativos</option>
                    <option value="BAIXADO">Baixados</option>
                </select>

                <button id="btnFiltrar" class="btn-toolbar btn-new">
                    <i class="fas fa-filter"></i>
                    Filtrar
                </button>
                <button id="btnExportarPdf" class="btn-toolbar btn-filter">
                    <i class="fas fa-file-pdf"></i>
                    Exportar PDF
                </button>
            </div>

        </div>

        <div class="dashboard-grid relatorio-cards">
            <div class="card-info card-primary">
                <div class="card-body">
                    <div class="card-top">
                        <div class="card-left">
                            <div class="card-main-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <div>
                                <div class="card-title">Total de Patrimônios</div>
                                <div class="card-value">
                                    <span id="totalPatrimoniosRelatorio">0</span>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-chart-line card-side-icon"></i>
                    </div>
                    <div class="card-description">
                        Quantidade de patrimônios encontrados no relatório.
                    </div>
                </div>
            </div>

            <div class="card-info card-success">
                <div class="card-body">
                    <div class="card-top">
                        <div class="card-left">
                            <div class="card-main-icon">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div>
                                <div class="card-title">Valor Total</div>
                                <div class="card-value money-value">
                                    <span id="valorTotalRelatorio">R$ 0,00</span>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-wallet card-side-icon"></i>
                    </div>
                    <div class="card-description">
                        Soma dos valores dos patrimônios filtrados.
                    </div>
                </div>
            </div>
        </div>

        <table class="service-table">

            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Unidade</th>
                    <th>Status</th>
                    <th>Valor</th>
                </tr>
            </thead>

            <tbody id="tabelaRelatorio">

                <tr>
                    <td colspan="6">
                        Carregando...
                    </td>
                </tr>

            </tbody>

        </table>
        <div id="paginacaoRelatorios" class="pagination"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script src="assets/js/relatorios.js"></script>

    <?php include 'includes/footer.php'; ?>

</body>

</html>