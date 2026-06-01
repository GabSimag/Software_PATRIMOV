<?php

$paginaAtual = basename($_SERVER['PHP_SELF']);

?>

<div id="btn-menu" onclick="toggleMenu()" title="Menu">
    <div class="sanduiche-puro">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<div class="sidebar" id="sidebar">

    <?php if (isset($_SESSION['usuario_id'])): ?>

        <div class="sidebar-logo">
            <img src="assets/img/logo.png" alt="Logo Empresa">
        </div>

    <?php endif; ?>

    <ul class="sidebar-menu">

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li class="<?= $paginaAtual == 'home.php' ? 'active' : '' ?>">
                <a href="home.php">
                    <i class="fas fa-tools"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'patrimonios.php' ? 'active' : '' ?>">
                <a href="patrimonios.php">
                    <i class="fas fa-boxes"></i>
                    <span>Patrimônios</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'servicos.php' ? 'active' : '' ?>">
                <a href="servicos.php">
                    <i class="fas fa-tools"></i>
                    <span>Serviços</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'categorias.php' ? 'active' : '' ?>">
                <a href="categorias.php">
                    <i class="fas fa-tags"></i>
                    <span>Categorias</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'unidades.php' ? 'active' : '' ?>">
                <a href="unidades.php">
                    <i class="fas fa-building"></i>
                    <span>Unidades</span>
                </a>
            </li>
            <li>
                <a href="ugs.php">
                    <i class="fas fa-building-columns"></i>
                    <span>UGs</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'movimentacoes.php' ? 'active' : '' ?>">
                <a href="movimentacoes.php">
                    <i class="fas fa-right-left"></i>
                    <span>Movimentações</span>
                </a>
            </li>
            <li>
                <a href="relatorios.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Relatórios</span>
                </a>
            </li>
            <li>
                <a href="usuarios.php">
                    <i class="fas fa-users"></i>
                    <span>Usuários</span>
                </a>
            </li>
            <li>
                <a href="auditoria.php">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Auditoria</span>
                </a>
            </li>
            <div class="sidebar-hr"></div>

        <?php else: ?>

            <li style="margin-top:20px">
                <a href="#" onclick="openModal('quem-somos')">
                    <i class="fas fa-info-circle"></i>
                    <span>Quem Somos</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="openModal('visao')">
                    <i class="fas fa-eye"></i>
                    <span>Visão da Empresa</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="openModal('valores')">
                    <i class="fas fa-gem"></i>
                    <span>Valores</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="openModal('missao')">
                    <i class="fas fa-bullseye"></i>
                    <span>Nossa Missão</span>
                </a>
            </li>

            <div class="sidebar-hr"></div>

        <?php endif; ?>

    </ul>

</div>

<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('active');
    }
</script>