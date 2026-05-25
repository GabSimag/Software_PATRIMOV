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

                    <select id="tipoVinculo" name="tipo_vinculo" required>
                        <option value="existente">Patrimônio existente</option>
                        <option value="novo">Novo patrimônio</option>
                    </select>
                </div>
                <div id="blocoPatrimonioExistente" class="form-group">
                    <label>Patrimônio</label>

                    <select name="id_patrimonio">
                        <option value="">Selecione...</option>

                        <?php foreach ($patrimonios as $patrimonio): ?>
                            <option value="<?= $patrimonio['id'] ?>">
                                <?= htmlspecialchars($patrimonio['codigo_patrimonial'] . ' - ' . $patrimonio['descricao']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="blocoNovoPatrimonio" style="display:none; grid-column: 1 / -1;">

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Código Patrimonial</label>
                            <input type="text" name="codigo_patrimonial">
                        </div>

                        <div class="form-group">
                            <label>Item</label>
                            <input type="text" name="item">
                        </div>

                        <div class="form-group">
                            <label>Descrição do Patrimônio</label>
                            <input type="text" name="descricao_patrimonio">
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
                            <select name="id_categoria">
                                <option value="">Selecione...</option>

                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>">
                                        <?= htmlspecialchars($categoria['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Unidade / Local</label>
                            <select name="id_unidade">
                                <option value="">Selecione...</option>

                                <?php foreach ($unidades as $unidade): ?>
                                    <option value="<?= $unidade['id'] ?>">
                                        <?= htmlspecialchars($unidade['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Número da Nota</label>
                            <input type="text" name="numero_nota">
                        </div>

                        <div class="form-group">
                            <label>Série</label>
                            <input type="text" name="serie">
                        </div>

                        <div class="form-group">
                            <label>Data da Nota</label>
                            <input type="date" name="data_nota">
                        </div>

                        <div class="form-group">
                            <label>Data do Empenho</label>
                            <input type="date" name="data_empenho">
                        </div>

                        <div class="form-group">
                            <label>Número do Empenho</label>
                            <input type="text" name="numero_empenho">
                        </div>

                        <div class="form-group">
                            <label>Processo Administrativo</label>
                            <input type="text" name="numero_processo_administrativo">
                        </div>

                    </div>

                </div>
                <div class="form-group">

                    <label>Tipo de Serviço</label>

                    <select name="tipo_servico" required>

                        <option value="MANUTENÇÃO">Manutenção</option>

                        <option value="REPARO">Reparo</option>

                        <option value="PATRIMONIAÇÃO">Patrimoniação</option>

                        <option value="INSPEÇÃO">Inspeção</option>

                        <option value="OUTRO">Outro</option>

                    </select>

                </div>

                <div class="form-group">
                    <label>Valor do Patrimônio</label>

                    <div class="form-input-icon">
                        <i class="fas fa-dollar-sign"></i>

                        <input
                            type="number"
                            name="valor"
                            step="0.01"
                            min="0"
                            value="0">
                    </div>
                </div>

                <div class="form-group">

                    <label>Status</label>

                    <select name="status">

                        <option value="SOLICITADO">
                            Solicitado
                        </option>

                        <option value="EM_ANDAMENTO">
                            Em andamento
                        </option>

                        <option value="CONCLUIDO">
                            Concluído
                        </option>

                        <option value="CANCELADO">
                            Cancelado
                        </option>

                    </select>

                </div>

            </div>

            <div class="form-group" style="margin-top:20px;">

                <label>Descrição</label>

                <textarea
                    name="descricao"
                    rows="5"
                    required></textarea>

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