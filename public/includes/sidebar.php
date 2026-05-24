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
                    <span>1. Home</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'patrimonios.php' ? 'active' : '' ?>">
                <a href="patrimonios.php">
                    <i class="fas fa-boxes"></i>
                    <span>2. Patrimônios</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'servicos.php' ? 'active' : '' ?>">
                <a href="servicos.php">
                    <i class="fas fa-tools"></i>
                    <span>3. Serviços</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'categorias.php' ? 'active' : '' ?>">
                <a href="categorias.php">
                    <i class="fas fa-tags"></i>
                    <span>Categorias</span>
                </a>
            </li>
            <li class="<?= $paginaAtual == 'cadastros.php' ? 'active' : '' ?>">
                <a href="cadastros.php">
                    <i class="fas fa-user-plus"></i>
                    <span>3. Cadastros</span>
                </a>
            </li>

            <li class="<?= $paginaAtual == 'movimentacao.php' ? 'active' : '' ?>">
                <a href="movimentacao.php">
                    <i class="fas fa-exchange-alt"></i>
                    <span>4. Movimentação</span>
                </a>
            </li>

            <li class="<?= $paginaAtual == 'relatorios.php' ? 'active' : '' ?>">
                <a href="relatorios.php">
                    <i class="fas fa-file-invoice"></i>
                    <span>5. Relatórios</span>
                </a>
            </li>

            <div class="sidebar-hr"></div>

            <li>
                <a href="../api/auth/logout.php" style="color:#ffbaba;">
                    <i class="fas fa-power-off" style="color:#ffbaba;"></i>
                    <span>Sair do Sistema</span>
                </a>
            </li>

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