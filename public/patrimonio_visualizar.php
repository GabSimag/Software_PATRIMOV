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
    SELECT
        p.*,
        c.nome AS categoria,
        u.nome AS unidade
    FROM patrimonios p
    INNER JOIN categorias c ON p.id_categoria = c.id
    INNER JOIN unidades u ON p.id_unidade = u.id
    WHERE p.id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id]);

$patrimonio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patrimonio) {
    die("Patrimônio não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Visualizar Patrimônio</title>

    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">

        <header class="header-operacional">
            <div>
                <h1 class="page-title">Visualizar Patrimônio</h1>
                <p class="page-subtitle">Detalhes completos do bem patrimonial.</p>
            </div>
        </header>

        <div class="form-card">

            <div class="form-grid">

                <div class="form-group">
                    <label>Código Patrimonial</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['codigo_patrimonial']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['descricao']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['marca'] ?? '-') ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['modelo'] ?? '-') ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['categoria']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Unidade</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['unidade']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Estado de Conservação</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['estado_conservacao']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" value="<?= htmlspecialchars($patrimonio['status']) ?>" disabled>
                </div>

                <?php if ($patrimonio['status'] === 'baixado'): ?>

                    <div class="form-group">
                        <label>Data da Baixa</label>
                        <input type="text" value="<?= htmlspecialchars($patrimonio['data_baixa'] ?? '-') ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Motivo da Baixa</label>
                        <input type="text" value="<?= htmlspecialchars($patrimonio['motivo_baixa'] ?? '-') ?>" disabled>
                    </div>

                <?php endif; ?>

            </div>

            <div class="form-actions">
                <a href="patrimonios.php" class="btn-secondary">Voltar</a>

                <a href="patrimonio_editar.php?id=<?= $patrimonio['id'] ?>" class="btn-primary">
                    <i class="fas fa-edit"></i>
                    Editar
                </a>
            </div>

        </div>

    </div>

</body>

</html>