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
    die("ID do patrimônio não informado.");
}

$stmt = $pdo->prepare("
    SELECT * FROM patrimonios
    WHERE id = :id
");

$stmt->execute([':id' => $id]);

$patrimonio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patrimonio) {
    die("Patrimônio não encontrado.");
}

$categorias = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$unidades = $pdo->query("SELECT id, nome FROM unidades ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Patrimônio</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Editar Patrimônio</h1>
                <p class="page-subtitle">Atualize as informações do patrimônio.</p>
            </div>
        </header>

        <form id="formPatrimonio" class="form-card">
            <input type="hidden" name="id" value="<?= $patrimonio['id'] ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Código Patrimonial</label>
                    <div class="form-input-icon">
                        <i class="fas fa-barcode"></i>
                        <input type="text" name="codigo_patrimonial" value="<?= htmlspecialchars($patrimonio['codigo_patrimonial']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <div class="form-input-icon">
                        <i class="fas fa-align-left"></i>
                        <input type="text" name="descricao" value="<?= htmlspecialchars($patrimonio['descricao']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <div class="form-input-icon">
                        <i class="fas fa-tag"></i>
                        <input type="text" name="marca" value="<?= htmlspecialchars($patrimonio['marca']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Modelo</label>
                    <div class="form-input-icon">
                        <i class="fas fa-cube"></i>
                        <input type="text" name="modelo" value="<?= htmlspecialchars($patrimonio['modelo']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <div class="form-input-icon">
                        <i class="fas fa-tags"></i>
                        <select name="id_categoria" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $patrimonio['id_categoria'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($categoria['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Unidade</label>
                    <div class="form-input-icon">
                        <i class="fas fa-school"></i>
                        <select name="id_unidade" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($unidades as $unidade): ?>
                                <option value="<?= $unidade['id'] ?>" <?= $unidade['id'] == $patrimonio['id_unidade'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($unidade['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Estado de Conservação</label>
                    <div class="form-input-icon">
                        <i class="fas fa-toolbox"></i>
                        <select name="estado_conservacao" required>
                            <option value="novo" <?= $patrimonio['estado_conservacao'] == 'novo' ? 'selected' : '' ?>>
                                Novo
                            </option>

                            <option value="bom" <?= $patrimonio['estado_conservacao'] == 'bom' ? 'selected' : '' ?>>
                                Bom
                            </option>

                            <option value="regular" <?= $patrimonio['estado_conservacao'] == 'regular' ? 'selected' : '' ?>>
                                Regular
                            </option>

                            <option value="ruim" <?= $patrimonio['estado_conservacao'] == 'ruim' ? 'selected' : '' ?>>
                                Ruim
                            </option>

                            <option value="inservivel" <?= $patrimonio['estado_conservacao'] == 'inservivel' ? 'selected' : '' ?>>
                                Inservível
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="form-input-icon">
                        <i class="fas fa-circle-check"></i>
                        <select name="status" required>
                            <option value="ATIVO" <?= $patrimonio['status'] == 'ATIVO' ? 'selected' : '' ?>>
                                Ativo
                            </option>

                            <option value="MANUTENCAO" <?= $patrimonio['status'] == 'MANUTENCAO' ? 'selected' : '' ?>>
                                Manutenção
                            </option>

                            <option value="BAIXADO" <?= $patrimonio['status'] == 'BAIXADO' ? 'selected' : '' ?>>
                                Baixado
                            </option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="patrimonios.php" class="btn-secondary">Cancelar</a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Patrimônio
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/patrimonio-editar.js"></script>
    <?php include 'includes/footer.php'; ?>