<?php
header('Content-Type: application/json');
require_once('../repository/user.php');

$dados = json_decode(file_get_contents('php://input'));

try {
    // Verifica se o e-mail já existe
    $isEmail = existsEmail($dados->email);
    if ($isEmail === true) {
        echo json_encode([
            'message' => 'Esse e-mail já existe.',
            'sucess' => false
        ]);
        exit;
    }

    // Cria o usuário
    create(
        name: $dados->name,
        email: $dados->email,
        password: $dados->password
    );

    echo json_encode([
        'message' => 'Cadastrado com sucesso.',
        'sucess' => true
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'message' => "Erro ao cadastrar: " . $th->getMessage(),
        'sucess' => false
    ]);
}
