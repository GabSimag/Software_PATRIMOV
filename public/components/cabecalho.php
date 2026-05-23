<?php
// Localização: include/cabecalho.php
// Este arquivo é incluído no topo de todas as páginas internas para manter o padrão.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- O caminho do CSS usa ../ pois as páginas que chamam estão em /src/ -->
    <link rel="stylesheet" href="../css/css.php">
    <link rel="stylesheet" href="https://cloudflare.com">
</head>
<body>
<header style="background: var(--azul-primario); padding: 15px; color: white; display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center;">
        <!-- Logo principal em JPEG vindo da pasta /img/ -->
        <img src="../img/logo.jpeg" alt="Logo" style="height: 40px; margin-right: 15px; border-radius: 4px;">
        <span style="font-weight: 700;">Sistema de Gestão Patrimonial</span>
    </div>
    <nav>
        <a href="../index.php" style="color: white; text-decoration: none; margin-left: 20px;"><i class="fas fa-home"></i> Início</a>
        <a href="logout.php" style="color: #ffbaba; text-decoration: none; margin-left: 20px;"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </nav>
</header>
<main style="padding: 20px;">