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
    die("ID do usuário não informado.");
}

$stmt = $pdo->prepare("
    SELECT id, id_perfil, nome, usuario, email, status
    FROM usuarios
    WHERE id = :id
    LIMIT 1
");

$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

$perfis = $pdo->query("
    SELECT id, nome
    FROM perfis
    ORDER BY nome
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário - Sistema Patrimonial</title>
    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div class="main-content">
    <form id="formUsuarioEditar" class="form-card">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

        <div class="form-grid">
            <div class="form-group">
                <label>Nome</label>
                <div class="form-input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Usuário</label>
                <div class="form-input-icon">
                    <i class="fas fa-id-badge"></i>
                    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <div class="form-input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Perfil</label>
                <div class="form-input-icon">
                    <i class="fas fa-user-shield"></i>
                    <select name="id_perfil" required>
                        <?php foreach ($perfis as $perfil): ?>
                            <option value="<?= $perfil['id'] ?>" <?= $perfil['id'] == $usuario['id_perfil'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($perfil['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="usuarios.php" class="btn-secondary">Cancelar</a>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Salvar Alterações
            </button>
        </div>
    </form>
</div>

<script src="assets/js/usuario-editar.js"></script>
<?php include 'includes/footer.php'; ?>