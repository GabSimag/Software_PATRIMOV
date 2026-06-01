<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $notificacoes = [];

    $servicosSolicitados = $pdo->query("
        SELECT COUNT(*)
        FROM servicos
        WHERE status = 'SOLICITADO'
    ")->fetchColumn();

    if ($servicosSolicitados > 0) {
        $notificacoes[] = [
            'tipo' => 'servico',
            'icone' => 'fa-tools',
            'titulo' => 'Serviços pendentes',
            'descricao' => $servicosSolicitados . ' serviço(s) aguardando conclusão.',
            'link' => 'servicos.php'
        ];
    }

    $servicosAndamento = $pdo->query("
        SELECT COUNT(*)
        FROM servicos
        WHERE status = 'EM_ANDAMENTO'
    ")->fetchColumn();

    if ($servicosAndamento > 0) {
        $notificacoes[] = [
            'tipo' => 'andamento',
            'icone' => 'fa-clock',
            'titulo' => 'Serviços em andamento',
            'descricao' => $servicosAndamento . ' serviço(s) em andamento.',
            'link' => 'servicos.php'
        ];
    }

    $patrimoniosBaixados = $pdo->query("
        SELECT COUNT(*)
        FROM patrimonios
        WHERE status = 'BAIXADO'
          AND data_baixa >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ")->fetchColumn();

    if ($patrimoniosBaixados > 0) {
        $notificacoes[] = [
            'tipo' => 'baixa',
            'icone' => 'fa-box-archive',
            'titulo' => 'Baixas recentes',
            'descricao' => $patrimoniosBaixados . ' patrimônio(s) baixado(s) nos últimos 7 dias.',
            'link' => 'patrimonios.php'
        ];
    }

    echo json_encode([
        'sucesso' => true,
        'total' => count($notificacoes),
        'dados' => $notificacoes
    ]);

} catch (Exception $e) {
    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}