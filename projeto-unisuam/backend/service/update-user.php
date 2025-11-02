<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once '../bd/conect-mysql.php';
require_once '../repository/user.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['nome']) && isset($data['email']) && isset($data['tipo'])) {
    $id = $data['id'];
    $nome = $data['nome'];
    $email = $data['email'];
    $tipo = $data['tipo'];
    $senha = isset($data['senha']) ? $data['senha'] : null;

    $conn = query();
    $result = updateUser($conn, $id, $nome, $email, $tipo, $senha);

    if ($result) {
        echo json_encode(['message' => 'Usuário atualizado com sucesso']);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar usuário']);
    }
} else {
    echo json_encode(['error' => 'Dados incompletos']);
}
?>