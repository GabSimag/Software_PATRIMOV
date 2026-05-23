<?php
/* 
   =========================================================================
   PROCESSAMENTO DE CADASTRO PATRIMONIAL
   =========================================================================
   Este arquivo captura as requisições POST do formulário de cadastros e 
   realiza a persistência dos dados no MySQL.
*/
session_start();
require_once 'config.php';

/* Validação de Segurança: Apenas usuários logados podem gravar dados */
if (!isset($_SESSION['usuario_id'])) {
    exit("Acesso negado.");
}

/* Verifica se os dados foram enviados via POST */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    /* Sanitização básica para evitar injeção de scripts */
    $nome_item = mysqli_real_escape_string($conn, $_POST['nome_item']);
    $setor     = mysqli_real_escape_string($conn, $_POST['setor']);
    $valor     = mysqli_real_escape_string($conn, $_POST['valor']);

    /* 
       QUERY DE INSERÇÃO
       Substitua 'patrimonio' pelo nome real da sua tabela no banco de dados.
    */
    $sql = "INSERT INTO patrimonio (nome_item, setor, valor) VALUES ('$nome_item', '$setor', '$valor')";

    if (mysqli_query($conn, $sql)) {
        /* Redireciona com sucesso para a tela de listagem */
        header("Location: ../src/cadastros.php?status=sucesso");
    } else {
        /* Em caso de erro técnico, retorna com falha */
        header("Location: ../src/cadastros.php?status=erro");
    }
} else {
    /* Bloqueia acesso direto ao arquivo */
    header("Location: ../src/cadastros.php");
}

mysqli_close($conn);
?>