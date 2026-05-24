<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

$categorias = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$unidades = $pdo->query("SELECT id, nome FROM unidades ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Patrimônio</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Novo Patrimônio</h1>
                <p class="page-subtitle">Cadastre um novo bem patrimonial no sistema.</p>
            </div>
        </header>

        <form id="formPatrimonio" class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>Código Patrimonial</label>
                    <input type="text" name="codigo_patrimonial" required>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="descricao" required>
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="marca">
                </div>

                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="modelo">
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select name="id_categoria" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>">
                                <?= htmlspecialchars($categoria['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Unidade</label>
                    <select name="id_unidade" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($unidades as $unidade): ?>
                            <option value="<?= $unidade['id'] ?>">
                                <?= htmlspecialchars($unidade['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estado de Conservação</label>
                    <select name="estado_conservacao" required>
                        <option value="novo">Novo</option>
                        <option value="bom">Bom</option>
                        <option value="regular">Regular</option>
                        <option value="ruim">Ruim</option>
                        <option value="inservivel">Inservível</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="ativo">Ativo</option>
                        <option value="manutencao">Manutenção</option>
                        <option value="baixado">Baixado</option>
                    </select>
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

    <script src="assets/js/patrimonio-cadastro.js"></script>

</body>

</html>