<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $totalPatrimonios = $pdo
        ->query("SELECT COUNT(*) FROM patrimonios")
        ->fetchColumn();

    $patrimoniosAtivos = $pdo
        ->query("SELECT COUNT(*) FROM patrimonios WHERE status = 'ATIVO'")
        ->fetchColumn();

    $patrimoniosBaixados = $pdo
        ->query("SELECT COUNT(*) FROM patrimonios WHERE status = 'BAIXADO'")
        ->fetchColumn();

    $servicosSolicitados = $pdo
        ->query("SELECT COUNT(*) FROM servicos WHERE status = 'SOLICITADO'")
        ->fetchColumn();

    $servicosAndamento = $pdo
        ->query("SELECT COUNT(*) FROM servicos WHERE status = 'EM_ANDAMENTO'")
        ->fetchColumn();

    $servicosConcluidos = $pdo
        ->query("SELECT COUNT(*) FROM servicos WHERE status = 'CONCLUIDO'")
        ->fetchColumn();
    $valorTotal = $pdo
        ->query("SELECT COALESCE(SUM(valor), 0) FROM patrimonios")
        ->fetchColumn();

    $valorAtivo = $pdo
        ->query("SELECT COALESCE(SUM(valor), 0) FROM patrimonios WHERE status = 'ATIVO'")
        ->fetchColumn();

    $valorBaixado = $pdo
        ->query("SELECT COALESCE(SUM(valor), 0) FROM patrimonios WHERE status = 'BAIXADO'")
        ->fetchColumn();
    echo json_encode([
        'sucesso' => true,
        'dados' => [
            'total_patrimonios' => $totalPatrimonios,
            'patrimonios_ativos' => $patrimoniosAtivos,
            'patrimonios_baixados' => $patrimoniosBaixados,
            'servicos_solicitados' => $servicosSolicitados,
            'servicos_andamento' => $servicosAndamento,
            'servicos_concluidos' => $servicosConcluidos,
            'valor_total' => $valorTotal,
            'valor_ativo' => $valorAtivo,
            'valor_baixado' => $valorBaixado
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}
