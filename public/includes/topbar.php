<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);

$titulos = [
    'home.php' => 'Dashboard',
    'patrimonios.php' => 'Patrimônios',
    'servicos.php' => 'Serviços',
    'movimentacoes.php' => 'Movimentações',
    'categorias.php' => 'Categorias',
    'unidades.php' => 'Unidades',
    'ugs.php' => 'UGs',
    'cadastros.php' => 'Usuários',
    'relatorios.php' => 'Relatórios'
];

$tituloPagina = $titulos[$paginaAtual] ?? 'PATRIMOV';
$usuarioNome = $_SESSION['usuario_nome'] ?? 'Usuário';
?>

<header class="topbar">
    <div class="topbar-left">
        <h2><?= htmlspecialchars($tituloPagina) ?></h2>
    </div>

    <div class="topbar-right">
        <button id="btnTheme" class="topbar-btn" type="button" title="Alterar tema">
            <i id="iconTheme" class="fas fa-moon"></i>
        </button>
        <div class="topbar-notifications">

            <button id="btnNotificacoes" class="notification-btn">

                <i class="fas fa-bell"></i>

                <span id="notificationCount" class="notification-badge">
                    0
                </span>

            </button>

            <div id="notificationDropdown" class="notification-dropdown">

                <div class="notification-header">
                    Notificações
                </div>

                <div id="notificationList">

                    <div class="notification-empty">
                        Carregando...
                    </div>

                </div>

            </div>

        </div>
        <div class="topbar-user-wrapper">
            <button class="topbar-user" id="btnUserMenu" type="button">
                <div class="topbar-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div class="topbar-user-info">
                    <span><?= htmlspecialchars($usuarioNome) ?></span>
                    <small>Administrador</small>
                </div>

                <i class="fas fa-chevron-down topbar-arrow"></i>
            </button>

            <div class="topbar-dropdown" id="userDropdown">
                <a href="perfil.php">
                    <i class="fas fa-user-circle"></i>
                    Meu Perfil
                </a>

                <a href="alterar_senha.php">
                    <i class="fas fa-key"></i>
                    Alterar Senha
                </a>

                <a href="configuracoes.php">
                    <i class="fas fa-gear"></i>
                    Configurações
                </a>

                <hr>

                <a href="../api/auth/logout.php" class="danger">
                    <i class="fas fa-right-from-bracket"></i>
                    Sair
                </a>
            </div>
        </div>
    </div>
</header>