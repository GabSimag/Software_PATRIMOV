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
    die("ID do serviço não informado.");
}

$stmt = $pdo->prepare("
    SELECT
        s.*,
        p.codigo_patrimonial,
        p.descricao AS patrimonio,
        p.item,
        p.numero_nota,
        p.serie,
        p.data_nota,
        p.data_empenho,
        p.numero_empenho,
        p.numero_processo_administrativo,
        u.nome AS unidade
    FROM servicos s
    INNER JOIN patrimonios p ON s.id_patrimonio = p.id
    INNER JOIN unidades u ON p.id_unidade = u.id
    WHERE s.id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id]);
$servico = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$servico) {
    die("Serviço não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Realizar Patrimoniação</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Realizar Patrimoniação #<?= $servico['id'] ?></h1>
                <p class="page-subtitle">Revise e conclua o processo de patrimoniação.</p>
            </div>
        </header>

        <form id="formRealizarServico" class="form-card">

            <input type="hidden" name="id_servico" value="<?= $servico['id'] ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Patrimônio</label>
                    <input type="text" value="<?= htmlspecialchars($servico['codigo_patrimonial'] . ' - ' . $servico['patrimonio']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Unidade / Local</label>
                    <input type="text" value="<?= htmlspecialchars($servico['unidade']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Tipo de Serviço</label>
                    <input type="text" value="<?= htmlspecialchars($servico['tipo_servico']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Status Atual</label>
                    <input type="text" value="<?= htmlspecialchars($servico['status']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Item</label>
                    <input type="text" name="item" value="<?= htmlspecialchars($servico['item'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Número da Nota</label>
                    <input type="text" name="numero_nota" value="<?= htmlspecialchars($servico['numero_nota'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Série</label>
                    <input type="text" name="serie" value="<?= htmlspecialchars($servico['serie'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Data da Nota</label>
                    <input type="date" name="data_nota" value="<?= htmlspecialchars($servico['data_nota'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Data do Empenho</label>
                    <input type="date" name="data_empenho" value="<?= htmlspecialchars($servico['data_empenho'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Número do Empenho</label>
                    <input type="text" name="numero_empenho" value="<?= htmlspecialchars($servico['numero_empenho'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Processo Administrativo</label>
                    <input type="text" name="numero_processo_administrativo" value="<?= htmlspecialchars($servico['numero_processo_administrativo'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label>Custo</label>
                    <input type="number" name="custo" step="0.01" min="0" value="<?= htmlspecialchars($servico['custo'] ?? 0) ?>">
                </div>

            </div>

            <div class="form-group" style="margin-top:20px;">
                <label>Observação da Patrimoniação</label>
                <textarea name="descricao" rows="5" required><?= htmlspecialchars($servico['descricao']) ?></textarea>
            </div>

            <div class="form-actions">
                <a href="servicos.php" class="btn-secondary">Cancelar</a>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-check"></i>
                    Concluir Patrimoniação
                </button>
            </div>

        </form>

    </div>

    <script src="assets/js/realizar-servico.js"></script>
<?php include 'includes/footer.php'; ?>