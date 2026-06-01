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
    <title>Auditoria - PATRIMOV</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <div class="toolbar">

            <div class="search-box">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    id="campoBuscaAuditoria"
                    placeholder="Buscar ação, usuário ou tabela...">
            </div>

        </div>

        <table class="service-table">

            <thead>
                <tr>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Tabela</th>
                    <th>Registro</th>
                    <th>Detalhes</th>
                </tr>
            </thead>

            <tbody id="tabelaAuditoria">

                <tr>
                    <td colspan="6">
                        Carregando registros...
                    </td>
                </tr>

            </tbody>

        </table>
        <div id="paginacaoAuditoria" class="pagination"></div>
    </div>

    <script src="assets/js/auditoria.js"></script>

    <?php include 'includes/footer.php'; ?>

</body>

</html>