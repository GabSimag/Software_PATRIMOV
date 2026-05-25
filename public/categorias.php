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
    <title>Categorias - Sistema Patrimonial</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Categorias</h1>
                <p class="page-subtitle">Gerencie as categorias dos patrimônios.</p>
            </div>
        </header>

        <div class="toolbar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="campoBuscaCategoria" placeholder="Buscar categoria...">
            </div>

            <div class="toolbar-actions">
                <a href="categoria_cadastrar.php"
                    class="btn-toolbar btn-new"
                    style="text-decoration:none;">
                    <i class="fas fa-plus"></i>

                    Nova Categoria
                </a>
            </div>
        </div>

        <table class="service-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody id="tabelaCategorias">
                <tr>
                    <td colspan="2">Carregando categorias...</td>
                </tr>
            </tbody>
        </table>

    </div>

    <script src="assets/js/categorias.js"></script>
<?php include 'includes/footer.php'; ?>