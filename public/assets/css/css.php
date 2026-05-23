<?php
header("Content-type: text/css; charset=UTF-8");

$parts = ['global.php', 'sidebar.php', 'login.php', 'home.php', 'servicos.php'];
foreach ($parts as $p) {
    $file = __DIR__ . '/' . $p;
    if (is_file($file)) {
        // readfile envia o conteúdo bruto, sem reprocessar o header() de cada parcial
        readfile($file);
        echo "\n";
    }
}
