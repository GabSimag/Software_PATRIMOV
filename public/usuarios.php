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
    <title>Usuários - Sistema Patrimonial</title>
    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div class="main-content">
    <div class="toolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="campoBuscaUsuario" placeholder="Buscar usuário...">
        </div>

        <a href="usuario_cadastrar.php" class="btn-toolbar btn-new" style="text-decoration:none;">
            <i class="fas fa-plus"></i>
            Novo Usuário
        </a>
    </div>

    <table class="service-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody id="tabelaUsuarios">
            <tr>
                <td colspan="6">Carregando usuários...</td>
            </tr>
        </tbody>
    </table>
    <div id="paginacaoUsuarios" class="pagination"></div>
</div>
<script src="assets/js/usuarios.js"></script>
<?php include 'includes/footer.php'; ?>
