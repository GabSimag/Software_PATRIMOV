<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

$ugs = $pdo->query("
    SELECT id, nome_fantasia, sigla
    FROM ugs
    WHERE status = 'ATIVO'
    ORDER BY nome_fantasia
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Nova Unidade</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Nova Unidade</h1>
                <p class="page-subtitle">Cadastre uma nova unidade administrativa.</p>
            </div>
        </header>

        <form id="formUnidade" class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>UG</label>
                    <div class="form-input-icon">
                        <i class="fas fa-building-columns"></i>
                        <select name="id_ug" required>
                            <option value="">Selecione...</option>

                            <?php foreach ($ugs as $ug): ?>
                                <option value="<?= $ug['id'] ?>">
                                    <?= htmlspecialchars($ug['sigla'] . ' - ' . $ug['nome_fantasia']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nome da Unidade</label>
                    <div class="form-input-icon">
                        <i class="fas fa-building"></i>
                        <input type="text" name="nome" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Endereço</label>
                    <div class="form-input-icon">
                        <i class="fas fa-location-dot"></i>
                        <input type="text" name="endereco">
                    </div>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <div class="form-input-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="telefone">
                    </div>
                </div>

                <div class="form-group">
                    <label>Responsável</label>
                    <div class="form-input-icon">
                        <i class="fas fa-user-tie"></i>
                        <input type="text" name="responsavel">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Coordenadas GPS</label>
                    <div class="form-input-icon">
                        <i class="fas fa-map-location-dot"></i>
                        <input type="text" name="gps_coords" placeholder="-22.357, -47.384">
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="unidades.php" class="btn-secondary">Cancelar</a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Unidade
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/unidade-cadastro.js"></script>
    <?php include 'includes/footer.php'; ?>