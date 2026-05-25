<?php
/* 
   =========================================================================
   MÓDULO OPERACIONAL: RELATÓRIOS GERAIS (REFATORADO PDO)
   =========================================================================
*/
require_once '../config/database.php';
require_once '../api/auth/check.php';

// BUSCA DE DADOS REAIS PARA O RELATÓRIO
try {
    // Contagem de Itens
    $stmtCount = $pdo->query("SELECT COUNT(*) as total, SUM(CASE WHEN status = 'ATIVO' THEN 1 ELSE 0 END) as ativos FROM patrimonios");
    $resCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $total_itens = $resCount['total'] ?? 0;
    $total_ativos = $resCount['ativos'] ?? 0;

    // Busca da lista de patrimônios com o nome da Unidade (JOIN)
    $query = "SELECT p.*, u.nome as unidade_nome 
              FROM patrimonios p 
              LEFT JOIN unidades u ON p.id_unidade = u.id 
              ORDER BY p.id DESC LIMIT 50";
    $stmtLista = $pdo->query($query);
    $patrimonios = $stmtLista->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $total_itens = $total_ativos = 0;
    $patrimonios = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - Sistema Patrimonial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.php">
    <style>
        body {
            background-color: var(--azul-suave) !important;
        }

        .rel-container {
            max-width: 1000px;
            margin: 20px auto;
            background: var(--branco);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        @media print {

            .sidebar,
            #btn-menu,
            .btn-print {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }

            .rel-container {
                box-shadow: none;
                width: 100%;
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body class="logado">
    <?php include 'includes/sidebar.php';?>

    <div class="main-content">
        <div class="rel-container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 style="color: var(--azul-primario);"><i class="fas fa-file-invoice"></i> Relatórios Gerais</h2>
                <button onclick="window.print()" class="btn-print" style="background: var(--cinza-texto); color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer;">
                    <i class="fas fa-print"></i> Imprimir
                </button>
            </div>

            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <span class="badge" style="background: var(--azul-suave); color: var(--azul-primario);">Total de Itens: <?php echo $total_itens; ?></span>
                <span class="badge" style="background: var(--verde-sucesso); color: white;">Ativos: <?php echo $total_ativos; ?></span>
            </div>

            <div class="table-container" style="margin-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background: var(--azul-primario); color: white; text-align: left;">
                            <th style="padding: 12px;">Cód/Placa</th>
                            <th style="padding: 12px;">Equipamento</th>
                            <th style="padding: 12px;">Unidade</th>
                            <th style="padding: 12px;">Estado</th>
                            <th style="padding: 12px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($patrimonios) > 0): ?>
                            <?php foreach ($patrimonios as $item): ?>
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 12px;"><?php echo $item['codigo_patrimonial'] . " / " . $item['placa']; ?></td>
                                    <td style="padding: 12px;"><strong><?php echo $item['modelo']; ?></strong>
                                        <small><?php echo $item['marca']; ?></small>
                                    </td>
                                    <td style="padding: 12px;"><?php echo $item['unidade_nome'] ?? 'Não Alocado'; ?></td>
                                    <td style="padding: 12px;"><?php echo $item['estado_conservacao']; ?></td>
                                    <td style="padding: 12px;">
                                        <?php
                                        $cor = ($item['status'] == 'ATIVO') ? 'var(--verde-sucesso)' : (($item['status'] == 'EM_MANUTENCAO') ? 'var(--amarelo-alerta)' : 'var(--vermelho-erro)');
                                        ?>
                                        <span style="color: <?php echo $cor; ?>; font-weight: bold;"><?php echo $item['status']; ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="padding: 20px; text-align: center; color: var(--cinza-secundario);">Nenhum patrimônio cadastrado no sistema.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
<?php include 'includes/footer.php'; ?>