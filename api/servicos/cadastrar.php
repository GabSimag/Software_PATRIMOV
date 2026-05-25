<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $tipo_vinculo = $_POST['tipo_vinculo'] ?? 'existente';

    $tipo_servico = $_POST['tipo_servico'] ?? null;
    $descricao = trim($_POST['descricao'] ?? '');
    $valor = $_POST['valor'] ?? 0;
    $status = $_POST['status'] ?? 'SOLICITADO';

    $id_usuario = $_SESSION['usuario_id'] ?? 1;

    if ($descricao === '') {
        throw new Exception('Informe a descrição.');
    }

    $pdo->beginTransaction();

    /*
    =========================================================
    PATRIMÔNIO EXISTENTE
    =========================================================
    */

    if ($tipo_vinculo === 'existente') {

        $id_patrimonio = $_POST['id_patrimonio'] ?? null;

        if (!$id_patrimonio) {
            throw new Exception('Selecione um patrimônio.');
        }
    }

    /*
    =========================================================
    NOVO PATRIMÔNIO
    =========================================================
    */

    else {

        $codigo = trim($_POST['codigo_patrimonial'] ?? '');
        $descricao_patrimonio = trim($_POST['descricao_patrimonio'] ?? '');

        $marca = trim($_POST['marca'] ?? '');
        $modelo = trim($_POST['modelo'] ?? '');

        $item = trim($_POST['item'] ?? '');

        $id_categoria = $_POST['id_categoria'] ?? null;
        $id_unidade = $_POST['id_unidade'] ?? null;

        $numero_nota = trim($_POST['numero_nota'] ?? '');
        $serie = trim($_POST['serie'] ?? '');

        $data_nota = $_POST['data_nota'] ?? null;
        $data_empenho = $_POST['data_empenho'] ?? null;

        $numero_empenho = trim($_POST['numero_empenho'] ?? '');

        $numero_processo =
            trim($_POST['numero_processo_administrativo'] ?? '');

        if (
            $codigo === '' ||
            $descricao_patrimonio === '' ||
            !$id_categoria ||
            !$id_unidade
        ) {
            throw new Exception(
                'Preencha os dados obrigatórios do patrimônio.'
            );
        }

        $sqlPatrimonio = "
            INSERT INTO patrimonios (
                codigo_patrimonial,
                descricao,
                marca,
                modelo,
                id_categoria,
                id_unidade,
                estado_conservacao,
                status,
                item,
                numero_nota,
                serie,
                data_nota,
                data_empenho,
                numero_empenho,
                numero_processo_administrativo,
                valor
            ) VALUES (
                :codigo,
                :descricao,
                :marca,
                :modelo,
                :id_categoria,
                :id_unidade,
                'novo',
                'ATIVO',
                :item,
                :numero_nota,
                :serie,
                :data_nota,
                :data_empenho,
                :numero_empenho,
                :numero_processo,
                :valor
            )
        ";

        $stmtPatrimonio = $pdo->prepare($sqlPatrimonio);

        $stmtPatrimonio->execute([

            ':codigo' => $codigo,
            ':descricao' => $descricao_patrimonio,

            ':marca' => $marca,
            ':modelo' => $modelo,

            ':id_categoria' => $id_categoria,
            ':id_unidade' => $id_unidade,

            ':item' => $item,

            ':numero_nota' => $numero_nota,
            ':serie' => $serie,

            ':data_nota' => $data_nota ?: null,
            ':data_empenho' => $data_empenho ?: null,

            ':numero_empenho' => $numero_empenho,
            ':numero_processo' => $numero_processo,
            ':valor' => $valor

        ]);

        $id_patrimonio = $pdo->lastInsertId();
    }

    /*
    =========================================================
    CADASTRAR SERVIÇO
    =========================================================
    */

    $sqlServico = "
    INSERT INTO servicos (
        id_patrimonio,
        id_usuario,
        tipo_servico,
        descricao,
        status
    ) VALUES (
        :id_patrimonio,
        :id_usuario,
        :tipo_servico,
        :descricao,
        :status
    )
";

    $stmtServico = $pdo->prepare($sqlServico);

    $stmtServico->execute([
    ':id_patrimonio' => $id_patrimonio,
    ':id_usuario' => $id_usuario,
    ':tipo_servico' => $tipo_servico,
    ':descricao' => $descricao,
    ':status' => $status
]);

    $pdo->commit();

    echo json_encode([
        'sucesso' => true
    ]);

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);
}