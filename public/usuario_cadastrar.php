<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?erro=acesso_negado");
    exit();
}

require_once '../api/auth/check.php';
require_once '../config/database.php';

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
    <title>Novo Usuário - Sistema Patrimonial</title>
    <link rel="stylesheet" href="assets/css/css.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="logado">

<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div class="main-content">
    <form id="formUsuario" class="form-card">
        <div class="form-grid">
            <div class="form-group">
                <label>Nome</label>
                <div class="form-input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" required>
                </div>
            </div>

            <div class="form-group">
                <label>Usuário</label>
                <div class="form-input-icon">
                    <i class="fas fa-id-badge"></i>
                    <input type="text" name="usuario" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <div class="form-input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <label>Perfil</label>
                <div class="form-input-icon">
                    <i class="fas fa-user-shield"></i>
                    <select name="id_perfil" required>
                        <option value="">Selecione...</option>

                        <?php foreach ($perfis as $perfil): ?>
                            <option value="<?= $perfil['id'] ?>">
                                <?= htmlspecialchars($perfil['nome']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <div class="form-input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" required>
                </div>
            </div>

            <div class="form-group">
                <label>Confirmar Senha</label>
                <div class="form-input-icon">
                    <i class="fas fa-check"></i>
                    <input type="password" name="confirmar_senha" required>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="usuarios.php" class="btn-secondary">Cancelar</a>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Salvar Usuário
            </button>
        </div>
    </form>
</div>

<script src="assets/js/usuario-cadastro.js"></script>
<?php include 'includes/footer.php'; ?>