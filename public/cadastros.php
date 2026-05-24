<?php
/* 
   =========================================================================
   MÓDULO OPERACIONAL: GERENCIAMENTO DE CADASTROS (REFATORADO PDO)
   =========================================================================
*/
require_once '../config/database.php';
require_once '../api/auth/check.php';

// BUSCA DE INDICADORES REAIS DO BANCO DE DADOS
try {
    // Contagem de Patrimônios
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM patrimonios");
    $total_patrimonios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Contagem de Usuários
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
    $total_usuarios = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Contagem de Unidades
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM unidades");
    $total_unidades = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Contagem de UGs
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM ugs");
    $total_ugs = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
} catch (PDOException $e) {
    $total_patrimonios = $total_usuarios = $total_unidades = $total_ugs = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastros - Sistema Patrimonial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.php">
    <style>
        body {
            background-color: var(--azul-suave) !important;
        }

        .header-operacional {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .header-operacional {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-operacional button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <header class="header-operacional">
            <div>
                <h1 class="page-title">Central de Cadastros</h1>
                <p style="color: var(--cinza-secundario);">Gerencie usuários, patrimônios, unidades e UGs.</p>
            </div>
        </header>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
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
                                    <div class="card-title">Patrimônios</div>
                                    <div class="card-value"><?php echo $total_patrimonios; ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="card-description">
                            Total de patrimônios cadastrados no sistema.
                        </div>
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
                                    <div class="card-title">Usuários</div>
                                    <div class="card-value"><?php echo $total_usuarios; ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="card-description">
                            Usuários cadastrados no sistema.
                        </div>
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
                                    <div class="card-title">Unidades</div>
                                    <div class="card-value"><?php echo $total_unidades; ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="card-description">
                            Unidades cadastradas no sistema.
                        </div>
                    </div>
                </div>

                <!-- UGs -->
                <div class="card-info card-purple">
                    <div class="card-body">
                        <div class="card-top">

                            <div class="card-left">
                                <div class="card-main-icon">
                                    <i class="fas fa-sitemap"></i>
                                </div>

                                <div>
                                    <div class="card-title">UGs</div>
                                    <div class="card-value"><?php echo $total_ugs; ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="card-description">
                            Unidades Gestoras cadastradas no sistema.
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div style="margin-top: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            <!-- Opções de Cadastro Rápido -->
            <div class="card-info" style="cursor:pointer; flex-direction:column; align-items:flex-start; padding:25px;" onclick="abrirModal('usuario')">
                <i class="fas fa-user-plus" style="font-size:30px; color:var(--azul-primario); margin-bottom:15px;"></i>
                <h3>Cadastrar Usuário</h3>
                <p style="font-size:13px; color:var(--cinza-secundario);">Adicione novos operadores ao sistema.</p>
            </div>
            <a href="patrimonio_cadastrar.php" class="card-info" style="cursor:pointer; flex-direction:column; align-items:flex-start; padding:25px; text-decoration:none;">
                <i class="fas fa-plus-square" style="font-size:30px; color:var(--verde-sucesso); margin-bottom:15px;"></i>
                <h3>Novo Patrimônio</h3>
                <p style="font-size:13px; color:var(--cinza-secundario);">Registre novos bens e equipamentos.</p>
            </a>
        </div>
        <script src="assets/js/cadastro.js"></script>
</body>

</html>