<?php

function registrarAuditoria(
    $pdo,
    $id_usuario,
    $acao,
    $tabela_afetada = null,
    $registro_id = null,
    $detalhes = null
) {

    $ip = $_SERVER['REMOTE_ADDR'] ?? null;

    $stmt = $pdo->prepare("
        INSERT INTO logs_auditoria (
            id_usuario,
            acao,
            tabela_afetada,
            registro_id,
            detalhes,
            ip_origem
        ) VALUES (
            :id_usuario,
            :acao,
            :tabela_afetada,
            :registro_id,
            :detalhes,
            :ip_origem
        )
    ");

    $stmt->execute([
        ':id_usuario' => $id_usuario,
        ':acao' => $acao,
        ':tabela_afetada' => $tabela_afetada,
        ':registro_id' => $registro_id,
        ':detalhes' => $detalhes,
        ':ip_origem' => $ip
    ]);
}