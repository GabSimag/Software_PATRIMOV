<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

$patrimonios = $pdo->query("
    SELECT id, codigo_patrimonial, descricao
    FROM patrimonios
    WHERE status = 'ATIVO'
    ORDER BY codigo_patrimonial
")->fetchAll(PDO::FETCH_ASSOC);

$ugs = $pdo->query("
    SELECT id, sigla, nome_fantasia
    FROM ugs
    WHERE status = 'ATIVO'
    ORDER BY sigla
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Nova Movimentação - PATRIMOV</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <form id="formMovimentacao" class="form-card">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Patrimônio</label>

                    <div class="form-input-icon">
                        <i class="fas fa-box"></i>

                        <select name="id_patrimonio" id="idPatrimonio" required>
                            <option value="">Selecione o patrimônio...</option>

                            <?php foreach ($patrimonios as $patrimonio): ?>
                                <option value="<?= $patrimonio['id'] ?>">
                                    <?= htmlspecialchars($patrimonio['codigo_patrimonial'] . ' - ' . $patrimonio['descricao']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Unidade Atual</label>

                    <div class="form-input-icon">
                        <i class="fas fa-building"></i>
                        <input type="text" id="unidadeAtual" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>UG Atual</label>

                    <div class="form-input-icon">
                        <i class="fas fa-landmark"></i>
                        <input type="text" id="ugAtual" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label>UG de Destino</label>

                    <div class="form-input-icon">
                        <i class="fas fa-landmark"></i>

                        <select name="id_ug_destino" id="idUgDestino" required>
                            <option value="">Selecione a UG...</option>

                            <?php foreach ($ugs as $ug): ?>
                                <option value="<?= $ug['id'] ?>">
                                    <?= htmlspecialchars($ug['sigla'] . ' - ' . $ug['nome_fantasia']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Unidade de Destino</label>

                    <div class="form-input-icon">
                        <i class="fas fa-school"></i>

                        <select name="id_unidade_destino" id="idUnidadeDestino" required>
                            <option value="">Selecione uma UG primeiro...</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tipo de Movimentação</label>

                    <div class="form-input-icon">
                        <i class="fas fa-exchange-alt"></i>

                        <select name="tipo_movimentacao" required>
                            <option value="TRANSFERENCIA">Transferência</option>
                            <option value="EMPRESTIMO">Empréstimo</option>
                            <option value="OUTRO">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Observação</label>

                    <div class="form-input-icon textarea-icon">
                        <i class="fas fa-align-left"></i>

                        <textarea
                            name="observacao"
                            class="form-textarea"
                            placeholder="Informe uma observação sobre a movimentação..."></textarea>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <a href="movimentacoes.php" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Movimentação
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/movimentacao-cadastro.js"></script>

    <?php include 'includes/footer.php'; ?>