<?php
require_once '../config/database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrimônio - Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.php">
</head>

<body>

    <?php if (!isset($_SESSION['usuario_id'])): ?>

        <main class="login-wrapper">

            <div class="login-logo">
                <img src="assets/img/logo.png" alt="Logo Patrimov">

                <h1>PATRIMOV</h1>

                <p>SISTEMA DE GESTÃO PATRIMONIAL</p>
            </div>

            <section class="login-container">

                <div class="login-header">

                    <div class="login-icon">
                        <i class="fas fa-user-lock"></i>
                    </div>

                    <h2>Acesse sua conta</h2>

                    <p>Informe suas credenciais para continuar</p>

                </div>

                <form class="login-form" action="../api/auth/login.php" method="POST">

                    <div class="input-group">
                        <label>Usuário</label>

                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="usuario" placeholder="Digite seu usuário" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Senha</label>

                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                            <i class="fas fa-eye" id="toggleIcon" onclick="toggleSenha()"></i>
                        </div>
                    </div>

                    <div class="login-extra">
                        <a href="#">Esqueceu sua senha?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-right-to-bracket"></i>
                        Entrar
                    </button>

                </form>

            </section>

            <footer class="login-footer">
                Segurança, transparência e eficiência na gestão patrimonial.
            </footer>

        </main>

    <?php else: ?>

        <main class="login-wrapper">

            <section class="login-container">

                <div class="login-header">

                    <div class="login-icon">
                        <i class="fas fa-circle-check"></i>
                    </div>

                    <h2>Você já está autenticado</h2>

                    <p>Continue para o painel principal do sistema.</p>

                </div>

                <button onclick="location.href='home.php'" class="btn-login">
                    <i class="fas fa-chart-line"></i>
                    Ir para o painel
                </button>

            </section>

        </main>

    <?php endif; ?>

    <script>
        function toggleSenha() {
            const input = document.getElementById("senha");
            const icon = document.getElementById("toggleIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
<?php include 'includes/footer.php'; ?>