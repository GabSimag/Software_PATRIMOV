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
    WHERE status != 'BAIXADO'
    ORDER BY descricao
")->fetchAll(PDO::FETCH_ASSOC);

$categorias = $pdo->query("
    SELECT id, nome
    FROM categorias
    WHERE status = 'ATIVO'
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);

$unidades = $pdo->query("
    SELECT id, nome
    FROM unidades
    WHERE status = 'ATIVO'
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Serviço</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/topbar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Novo Serviço</h1>
                <p class="page-subtitle">
                    Cadastre uma nova ordem de serviço.
                </p>
            </div>
        </header>

        <form id="formServico" class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>Tipo de vínculo</label>
                    <div class="form-input-icon">
                        <i class="fas fa-link"></i>
                        <select id="tipoVinculo" name="tipo_vinculo" required>
                            <option value="existente">Patrimônio existente</option>
                            <option value="novo">Novo patrimônio</option>
                        </select>
                    </div>
                </div>

                <div id="blocoPatrimonioExistente" class="form-group">
                    <label>Patrimônio</label>
                    <div class="form-input-icon">
                        <i class="fas fa-box-archive"></i>
                        <select name="id_patrimonio">
                            <option value="">Selecione...</option>

                            <?php foreach ($patrimonios as $patrimonio): ?>
                                <option value="<?= $patrimonio['id'] ?>">
                                    <?= htmlspecialchars($patrimonio['codigo_patrimonial'] . ' - ' . $patrimonio['descricao']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div id="blocoNovoPatrimonio" style="display:none; grid-column: 1 / -1;">

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Código Patrimonial</label>
                            <div class="form-input-icon">
                                <i class="fas fa-barcode"></i>
                                <input type="text" name="codigo_patrimonial">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Item</label>
                            <div class="form-input-icon">
                                <i class="fas fa-box"></i>
                                <input type="text" name="item">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Descrição do Patrimônio</label>
                            <div class="form-input-icon">
                                <i class="fas fa-align-left"></i>
                                <input type="text" name="descricao_patrimonio">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Marca</label>
                            <div class="form-input-icon">
                                <i class="fas fa-tag"></i>
                                <input type="text" name="marca">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Modelo</label>
                            <div class="form-input-icon">
                                <i class="fas fa-cube"></i>
                                <input type="text" name="modelo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Categoria</label>
                            <div class="form-input-icon">
                                <i class="fas fa-tags"></i>
                                <select name="id_categoria">
                                    <option value="">Selecione...</option>

                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>">
                                            <?= htmlspecialchars($categoria['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Unidade / Local</label>
                            <div class="form-input-icon">
                                <i class="fas fa-school"></i>
                                <select name="id_unidade">
                                    <option value="">Selecione...</option>

                                    <?php foreach ($unidades as $unidade): ?>
                                        <option value="<?= $unidade['id'] ?>">
                                            <?= htmlspecialchars($unidade['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Número da Nota</label>
                            <div class="form-input-icon">
                                <i class="fas fa-file-invoice"></i>
                                <input type="text" name="numero_nota">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Série</label>
                            <div class="form-input-icon">
                                <i class="fas fa-hashtag"></i>
                                <input type="text" name="serie">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Data da Nota</label>
                            <div class="form-input-icon">
                                <i class="fas fa-calendar-days"></i>
                                <input type="date" name="data_nota">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Data do Empenho</label>
                            <div class="form-input-icon">
                                <i class="fas fa-calendar-check"></i>
                                <input type="date" name="data_empenho">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Número do Empenho</label>
                            <div class="form-input-icon">
                                <i class="fas fa-file-signature"></i>
                                <input type="text" name="numero_empenho">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Processo Administrativo</label>
                            <div class="form-input-icon">
                                <i class="fas fa-folder-open"></i>
                                <input type="text" name="numero_processo_administrativo">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <label>Tipo de Serviço</label>
                    <div class="form-input-icon">
                        <i class="fas fa-screwdriver-wrench"></i>
                        <select name="tipo_servico" required>
                            <option value="MANUTENÇÃO">Manutenção</option>
                            <option value="REPARO">Reparo</option>
                            <option value="PATRIMONIAÇÃO">Patrimoniação</option>
                            <option value="INSPEÇÃO">Inspeção</option>
                            <option value="OUTRO">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Valor do Patrimônio</label>
                    <div class="form-input-icon">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="number" name="valor" step="0.01" min="0" value="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="form-input-icon">
                        <i class="fas fa-circle-check"></i>
                        <select name="status">
                            <option value="SOLICITADO">Solicitado</option>
                            <option value="EM_ANDAMENTO">Em andamento</option>
                            <option value="CONCLUIDO">Concluído</option>
                            <option value="CANCELADO">Cancelado</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group" style="margin-top:20px;">
                <label>Descrição</label>

                <div class="form-input-icon textarea-icon">
                    <i class="fas fa-align-left"></i>
                    <textarea
                        class="form-textarea"
                        name="descricao"
                        rows="5"
                        required></textarea>
                </div>
            </div>

            <div class="form-actions">
                <a href="servicos.php" class="btn-secondary">
                    Cancelar
                </a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Salvar Serviço
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/servico-cadastro.js"></script>

    <?php include 'includes/footer.php'; ?>