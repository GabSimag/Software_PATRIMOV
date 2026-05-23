<?php 
// Referência: inicia a sessão e conecta ao banco
require_once '../config/database.php'; 
require_once '../api/auth/check.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrimônio - Login</title>
    
    <!-- Link oficial para os ícones funcionarem -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Estilização centralizada -->
    <link rel="stylesheet" href="assets/css/css.php"> 

    <style>
        body {
            background: url('assets/img/logo_background.jpeg' ) no-repeat center center fixed !important;
            background-size: cover !important;
            margin: 0;
            height: 100vh;
            overflow: hidden; 
        }
    </style>
</head>
<body>

    <?php include 'includes/sidebar.php';?>
    <?php if(!isset($_SESSION['usuario_id'])): ?>
    <div class="login-container">
        <img src="assets/img/logo.png" alt="Logo Empresa" style="width:180px; margin-bottom:15px; border-radius:8px;">
        <h2>Acesse sua conta</h2>
        <p style="color:var(--cinza-secundario); font-size:14px; margin-bottom:20px;">Informe suas credenciais para continuar</p>
        
        <form action="../api/auth/login.php" method="POST">
            <div class="input-group">
                <i class="fas fa-user-circle fas-input"></i>
                <input type="text" name="usuario" placeholder="Digite seu usuário" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock fas-input"></i>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <i class="fas fa-eye" id="toggleIcon" onclick="toggleSenha()"></i>
            </div>
            <a href="#" style="font-size:12px; color:var(--azul-primario); text-decoration:none; display:block; text-align:right; margin-bottom:15px; font-weight:500;">Esqueceu sua senha?</a>
            <button type="submit" class="btn-acessar">Entrar</button>
        </form>
        <p style="margin-top:25px; font-size:13px; color:var(--cinza-secundario); font-weight:500;">Segurança, Transparência e Eficiência na gestão patrimonial.</p>
    </div>
    <?php else: ?>
        <div class="login-container">
             <h1>Que bom ter você de volta!</h1>
             <p>Você já está autenticado no sistema.</p>
               

             <button onclick="location.href='servicos.php'" class="btn-acessar">Ir para Painel de Trabalho</button>

        </div>
    <?php endif; ?>

    <div id="modal-info" class="floating-page">
        <button onclick="closeModal()" style="float:right; border:none; background:var(--vermelho-erro); color:white; padding:8px 15px; cursor:pointer; border-radius:4px; font-weight:bold;">X Fechar</button>
        <div id="modal-content" style="margin-top:40px; color: #333;"></div>
    </div>

    <script>
        function toggleSenha() {
            var input = document.getElementById("senha");
            var icon = document.getElementById("toggleIcon");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
        function openModal(tipo) {
            const contents = {
                'quem-somos': '<h1>Quem Somos</h1><p>Somos uma empresa dedicada à organização e transparência de ativos fixos...</p>',
                'visao': '<h1>Visão da Empresa</h1><p>Nossa visão é ser o maior software de controle de UG do país...</p>',
                'valores': '<h1>Valores</h1><p>Comprometimento, integridade e foco no cliente...</p>',
                'missao': '<h1>Nossa Missão</h1><p>Facilitar a gestão de inventários complexos com tecnologia...</p>'
            };
            document.getElementById('modal-content').innerHTML = contents[tipo];
            document.getElementById('modal-info').style.display = 'block';
            document.getElementById('sidebar').classList.remove('active');
        }
        function closeModal() { document.getElementById('modal-info').style.display = 'none'; }
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('btn-menu');
            if (!sidebar.contains(event.target) && !btn.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>
