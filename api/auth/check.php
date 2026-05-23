<?php
// Inicia a sessão se ainda não tiver sido iniciada por outro arquivo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Valida se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Como quem chama este arquivo são as páginas dentro de /public/,
    // o redirecionamento para o index.php (que também está em /public/) é direto.
    header("Location: index.php?erro=restrito");
    exit();
}
?>
