<?php
/* 
   =========================================================================
   MÓDULO OPERACIONAL: GERENCIAMENTO DE CADASTROS
   =========================================================================
*/

require_once '../config/database.php';
require_once '../api/auth/check.php';

/* =========================================================================
   BUSCA DE INDICADORES
========================================================================= */

try {

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM patrimonios");
    $total_patrimonios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
    $total_usuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM unidades");
    $total_unidades = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $stmt = $pdo->query("SELECT COUNT(*) as total FROM ugs");
    $total_ugs = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {

    $total_patrimonios = 0;
    $total_usuarios = 0;
    $total_unidades = 0;
    $total_ugs = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastros - Sistema Patrimonial</title>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    >

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="assets/css/css.php">

    <style>

        body {

            background: var(--azul-suave) !important;
        }

    </style>

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
                    Central de Cadastros
                </h1>

                <p class="page-subtitle">
                    Gerencie usuários, patrimônios, unidades e UGs.
                </p>

            </div>

        </header>

        <!-- GRID PRINCIPAL -->
        <div class="dashboard-grid">

            <!-- PATRIMÔNIOS -->
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
                                    <?php echo $total_patrimonios; ?>
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Total de patrimônios cadastrados no sistema.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Ver detalhes
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <!-- USUÁRIOS -->
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
                                    <?php echo $total_usuarios; ?>
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-user-check"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Operadores e administradores cadastrados.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Ver detalhes
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <!-- UNIDADES -->
            <div class="card-info card-warning">

                <div class="card-body">

                    <div class="card-top">

                        <div class="card-left">

                            <div class="card-main-icon">
                                <i class="fas fa-building"></i>
                            </div>

                            <div>

                                <div class="card-title">
                                    Unidades
                                </div>

                                <div class="card-value">
                                    <?php echo $total_unidades; ?>
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-city"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Unidades organizacionais registradas.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Ver detalhes
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <!-- UGS -->
            <div class="card-info card-purple">

                <div class="card-body">

                    <div class="card-top">

                        <div class="card-left">

                            <div class="card-main-icon">
                                <i class="fas fa-sitemap"></i>
                            </div>

                            <div>

                                <div class="card-title">
                                    UGs
                                </div>

                                <div class="card-value">
                                    <?php echo $total_ugs; ?>
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-network-wired"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Unidades gestoras disponíveis no sistema.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Ver detalhes
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

        <!-- GRID SECUNDÁRIO -->
        <div class="dashboard-grid section-spacing">

            <!-- CADASTRAR USUÁRIO -->
            <div
                class="card-info action-card card-primary"
                onclick="abrirModal('usuario')"
            >

                <div class="card-body">

                    <div class="card-top">

                        <div class="card-left">

                            <div class="card-main-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>

                            <div>

                                <div class="card-title">
                                    Novo Usuário
                                </div>

                                <div class="card-value">
                                    +
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-user"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Adicione novos operadores ao sistema.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Abrir cadastro
                        <i class="fas fa-arrow-right"></i>
                    </a>

                </div>

            </div>

            <!-- NOVO PATRIMÔNIO -->
            <div
                class="card-info action-card card-success"
                onclick="abrirModal('patrimonio')"
            >

                <div class="card-body">

                    <div class="card-top">

                        <div class="card-left">

                            <div class="card-main-icon">
                                <i class="fas fa-plus-square"></i>
                            </div>

                            <div>

                                <div class="card-title">
                                    Novo Patrimônio
                                </div>

                                <div class="card-value">
                                    +
                                </div>

                            </div>

                        </div>

                        <div class="card-side-icon">
                            <i class="fas fa-box-open"></i>
                        </div>

                    </div>

                    <div class="card-description">
                        Registre novos bens e equipamentos.
                    </div>

                </div>

                <div class="card-footer">

                    <a href="#" class="card-link">
                        Abrir cadastro
                        <i class="fas fa-arrow-right"></i>
                    </a>

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

        function abrirModal(tipo) {

            alert('Abrindo formulário de ' + tipo + '...');
        }

    </script>

</body>
</html>