<?php
/* 
   Fala, parceiro! Esse aqui é o motor do login. 
   Ele recebe o que você digitou e decide se te deixa entrar ou não.
*/
session_start(); // Fundamental! Sem isso o sistema não "lembra" que você logou.
require_once '../../config/database.php';
 // Conecta no banco pra gente conferir os dados.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    /* 
       Aqui eu fiz uma validação simples pra gente testar.
       Depois você pode trocar isso pela consulta real no seu banco de dados.
    */
    if ($usuario === 'admin' && $senha === 'admin123') {
        // Se deu bom, eu guardo os dados na sessão
        $_SESSION['usuario_id'] = 1;
        $_SESSION['usuario_nome'] = 'Administrador';
        
        // A MÁGICA AQUI: Manda o cara direto pros Serviços após logar
        header("Location: ../src/servicos.php");
        exit();
    } else {
        // Se a senha tiver errada, volta pro index com um aviso
        header("Location: ../index.php?erro=dados_invalidos");
        exit();
    }
} else {
    // Se tentarem acessar esse arquivo direto pelo navegador, eu mando de volta
    header("Location: ../../public/index.php");
    exit();
}
?>