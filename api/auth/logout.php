<?php
// Localização: include/logout.php
// Este arquivo garante que nenhum dado do usuário permaneça na memória do servidor.

session_start();

// 1. Limpa todas as variáveis de sessão da memória (O que você solicitou)
session_unset();

// 2. Remove os dados da superglobal $_SESSION
$_SESSION = array();

// 3. Destrói o cookie de sessão no navegador do usuário
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Destrói a sessão no servidor
session_destroy();

// 5. Redireciona para a raiz (index.php) com um parâmetro de sucesso
header("Location: ../../public/index.php?status=logoff");
exit();
?>