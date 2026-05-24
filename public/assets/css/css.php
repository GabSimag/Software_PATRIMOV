<?php
header("Content-type: text/css; charset=UTF-8");

$parts = ['global.css', 'sidebar.css', 'login.css', 'home.css', 'servicos.css','forms.css','modals.css'];
foreach ($parts as $p) {
    $file = __DIR__ . '/' . $p;
    if (is_file($file)) {
        // readfile envia o conteúdo bruto, sem reprocessar o header() de cada parcial
        readfile($file);
        echo "\n";
    }
}
