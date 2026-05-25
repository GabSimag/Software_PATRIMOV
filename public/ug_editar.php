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
    die("ID da UG não informado.");
}

$stmt = $pdo->prepare("
    SELECT *
    FROM ugs
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id]);

$ug = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ug) {
    die("UG não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar UG</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Editar UG</h1>
                <p class="page-subtitle">Atualize os dados da unidade gestora.</p>
            </div>
        </header>

        <form id="formUgEditar" class="form-card">

            <input type="hidden" name="id" value="<?= $ug['id'] ?>">

            <div class="form-grid">

                <div class="form-group">

                    <label>Código</label>

                    <div class="form-input-icon">

                        <i class="fas fa-barcode"></i>

                        <input
                            type="text"
                            name="codigo"
                            value="<?= htmlspecialchars($ug['codigo']) ?>"
                            required>

                    </div>

                </div>

                <div class="form-group">

                    <label>Sigla</label>

                    <div class="form-input-icon">

                        <i class="fas fa-signature"></i>

                        <input
                            type="text"
                            name="sigla"
                            value="<?= htmlspecialchars($ug['sigla']) ?>"
                            required>

                    </div>

                </div>

                <div class="form-group">

                    <label>Nome Fantasia</label>

                    <div class="form-input-icon">

                        <i class="fas fa-building-columns"></i>

                        <input
                            type="text"
                            name="nome_fantasia"
                            value="<?= htmlspecialchars($ug['nome_fantasia']) ?>"
                            required>

                    </div>

                </div>

                <div class="form-group">

                    <label>Origem</label>

                    <div class="form-input-icon">

                        <i class="fas fa-sitemap"></i>

                        <select name="origem" required>

                            <option value="Prefeitura" <?= $ug['origem'] === 'Prefeitura' ? 'selected' : '' ?>>
                                Prefeitura
                            </option>

                            <option value="Educação" <?= $ug['origem'] === 'Educação' ? 'selected' : '' ?>>
                                Educação
                            </option>

                            <option value="Saúde" <?= $ug['origem'] === 'Saúde' ? 'selected' : '' ?>>
                                Saúde
                            </option>

                            <option value="Assistência Social" <?= $ug['origem'] === 'Assistência Social' ? 'selected' : '' ?>>
                                Assistência Social
                            </option>

                            <option value="Outro" <?= $ug['origem'] === 'Outro' ? 'selected' : '' ?>>
                                Outro
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-actions">

                <a href="ugs.php" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">

                    <i class="fas fa-save"></i>

                    Salvar Alterações

                </button>

            </div>

        </form>

    </div>

    <script src="assets/js/ug-editar.js"></script>

<?php include 'includes/footer.php'; ?>