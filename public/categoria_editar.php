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
    die("ID da categoria não informado.");
}

$stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);

$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    die("Categoria não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Editar Categoria</h1>
                <p class="page-subtitle">Atualize os dados da categoria patrimonial.</p>
            </div>
        </header>

        <form id="formCategoriaEditar" class="form-card">

            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Nome da Categoria</label>
                    <div class="form-input-icon">
                        <i class="fas fa-layer-group"></i>
                        <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Descrição</label>
                    <div class="form-input-icon textarea-icon">
                        <i class="fas fa-align-left"></i>
                        <textarea
                            class="form-textarea"
                            name="descricao"
                            placeholder="Descreva detalhadamente a finalidade desta categoria patrimonial..."><?= htmlspecialchars($categoria['descricao'] ?? '') ?></textarea>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="categorias.php" class="btn-secondary">Cancelar</a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Alterações
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/categoria-editar.js"></script>
    <?php include 'includes/footer.php'; ?>