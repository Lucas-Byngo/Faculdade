<?php
header('Content-Type: application/json');
require_once('../repository/user.php');

$dados = json_decode(file_get_contents('php://input'));

try {
    $users = getAllUsers();

    echo json_encode([
        'sucess' => true,
        'users' => $users
    ]);
} catch (\Exception $th) {
    echo json_encode([
        'mensagem' => "Erro ao listar usuários: " . $th->getMessage(),
        'sucess' => false
    ]);
}
