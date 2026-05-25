<?php
require_once '../../config/database.php';

header('Content-Type: application/json; charset=utf-8');

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido.');
    }

    $id = $_POST['id'] ?? null;

    $id_ug = $_POST['id_ug'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $responsavel = trim($_POST['responsavel'] ?? '');
    $gps_coords = trim($_POST['gps_coords'] ?? '');

    if (!$id) {
        throw new Exception('ID não informado.');
    }

    if ($id_ug === '' || $nome === '') {
        throw new Exception('Preencha os campos obrigatórios.');
    }

    $stmt = $pdo->prepare("
        UPDATE unidades SET
            id_ug = :id_ug,
            nome = :nome,
            endereco = :endereco,
            telefone = :telefone,
            responsavel = :responsavel,
            gps_coords = :gps_coords
        WHERE id = :id
    ");

    $stmt->execute([
        ':id_ug' => $id_ug,
        ':nome' => $nome,
        ':endereco' => $endereco,
        ':telefone' => $telefone,
        ':responsavel' => $responsavel,
        ':gps_coords' => $gps_coords,
        ':id' => $id
    ]);

    echo json_encode([
        'sucesso' => true
    ]);

} catch (Exception $e) {

    echo json_encode([
        'sucesso' => false,
        'erro' => $e->getMessage()
    ]);

}