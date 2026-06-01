<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID da unidade não informado.");
}

$stmt = $pdo->prepare("
    SELECT *
    FROM unidades
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id]);

$unidade = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$unidade) {
    die("Unidade não encontrada.");
}

$ugs = $pdo->query("
    SELECT id, sigla, nome_fantasia
    FROM ugs
    ORDER BY nome_fantasia
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Unidade</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>
    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Editar Unidade</h1>
                <p class="page-subtitle">Atualize os dados da unidade.</p>
            </div>
        </header>

        <form id="formUnidadeEditar" class="form-card">

            <input type="hidden" name="id" value="<?= $unidade['id'] ?>">

            <div class="form-grid">

                <div class="form-group">

                    <label>UG</label>

                    <div class="form-input-icon">

                        <i class="fas fa-building-columns"></i>

                        <select name="id_ug" required>

                            <?php foreach ($ugs as $ug): ?>

                                <option
                                    value="<?= $ug['id'] ?>"
                                    <?= $ug['id'] == $unidade['id_ug'] ? 'selected' : '' ?>>

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

                        <input
                            type="text"
                            name="nome"
                            value="<?= htmlspecialchars($unidade['nome']) ?>"
                            required>

                    </div>

                </div>

                <div class="form-group full-width">

                    <label>Endereço</label>

                    <div class="form-input-icon">

                        <i class="fas fa-location-dot"></i>

                        <input
                            type="text"
                            name="endereco"
                            value="<?= htmlspecialchars($unidade['endereco'] ?? '') ?>">

                    </div>

                </div>

                <div class="form-group">

                    <label>Telefone</label>

                    <div class="form-input-icon">

                        <i class="fas fa-phone"></i>

                        <input
                            type="text"
                            name="telefone"
                            value="<?= htmlspecialchars($unidade['telefone'] ?? '') ?>">

                    </div>

                </div>

                <div class="form-group">

                    <label>Responsável</label>

                    <div class="form-input-icon">

                        <i class="fas fa-user-tie"></i>

                        <input
                            type="text"
                            name="responsavel"
                            value="<?= htmlspecialchars($unidade['responsavel'] ?? '') ?>">

                    </div>

                </div>

                <div class="form-group full-width">

                    <label>Coordenadas GPS</label>

                    <div class="form-input-icon">

                        <i class="fas fa-map-location-dot"></i>

                        <input
                            type="text"
                            name="gps_coords"
                            value="<?= htmlspecialchars($unidade['gps_coords'] ?? '') ?>"
                            placeholder="-22.357, -47.384">

                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a href="unidades.php" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">

                    <i class="fas fa-save"></i>

                    Salvar Alterações

                </button>

            </div>

        </form>

    </div>

    <script src="assets/js/unidade-editar.js"></script>
    <?php include 'includes/footer.php'; ?>