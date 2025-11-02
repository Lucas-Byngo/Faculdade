<?php
header('Content-Type: application/json');
require_once('../repository/user.php');

try {
    $userId = isset($_GET['id']) && is_numeric($_GET['id']) 
        ? (int) $_GET['id'] 
        : null;

    if (!$userId) {
        throw new \Exception("ID de usuário inválido.");
    }

    deleteUserById($userId);

    echo json_encode([
        'sucess' => true
    ]);
} catch (\Exception $th) {
    echo json_encode([
        'mensagem' => "Erro ao deletar usuário: " . $th->getMessage(),
        'sucess' => false
    ]);
}
