<?php
/* 
   =========================================================================
   MÓDULO OPERACIONAL: MOVIMENTAÇÃO DE PATRIMÔNIO
   =========================================================================
*/
require_once '../config/database.php';
require_once '../api/auth/check.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentação - Sistema Patrimonial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/css.php"> 
    <style>
        body { background-color: var(--azul-suave ) !important; }
        .mov-container { max-width: 900px; margin: 20px auto; background: var(--branco); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-mov { background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #eee; }
        .input-mov { width:100%; padding:10px; border-radius: 8px; border: 1px solid #ddd; margin-top: 5px; }
    </style>
</head>

<body class="logado">
    <?php include 'includes/sidebar.php';?>

    <div class="main-content">
        <div class="mov-container">
            <h2 style="color: var(--azul-primario);"><i class="fas fa-exchange-alt"></i> Movimentação de Patrimônio</h2>
            <p style="color: var(--cinza-secundario);">Transfira itens entre unidades ou registre baixas de equipamentos.</p>
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

            <form action="../api/movimentacoes/transfer.php" method="POST" class="form-mov">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    <div>
                        <label style="font-weight: bold; font-size: 14px;">Item para Movimentar:</label>
                        <input type="text" name="patrimonio_id" class="input-mov" placeholder="Código ou Placa do Patrimônio" required>
                    </div>
                    <div>
                        <label style="font-weight: bold; font-size: 14px;">Destino (UG):</label>
                        <select name="ug_destino" class="input-mov">
                            <option value="">Selecione a Unidade Destino</option>
                            <?php
                            // Busca as UGs reais do banco para preencher o select
                            try {
                                $stmt = $pdo->query("SELECT id, nome_fantasia FROM ugs ORDER BY nome_fantasia");
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='{$row['id']}'>{$row['nome_fantasia']}</option>";
                                }
                            } catch (PDOException $e) {
                                echo "<option value=''>Erro ao carregar UGs</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div style="margin-top: 15px;">
                    <label style="font-weight: bold; font-size: 14px;">Observação / Motivo:</label>
                    <textarea name="observacao" class="input-mov" style="height: 80px;" placeholder="Descreva o motivo da movimentação..."></textarea>
                </div>

                <button type="submit" class="btn-acessar" style="margin-top: 20px; width: auto; padding: 12px 40px;">Confirmar Movimentação</button>
            </form>
        </div>
    </div>

    <script>
        function toggleMenu() { document.getElementById('sidebar').classList.toggle('active'); }
    </script>
</body>
</html>
