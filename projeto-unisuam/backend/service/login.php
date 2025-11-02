<?php
header('Content-Type: application/json');
require_once('../repository/user.php');

$dados = json_decode(file_get_contents('php://input'));

try {
    $usuario = getUserByEmail($dados->email);
    if (!$usuario) {
        throw new Exception('Email ou senha incorretos!');
    }

    // Verifica senha
    $senhaValida = password_verify($dados->password, $usuario['password']);
    if (!$senhaValida) {
        throw new Exception('Email ou senha incorretos!');
    }

    // Se for admin, iniciar fluxo 2FA por pergunta de segurança
    if (isset($usuario['admin']) && intval($usuario['admin']) === 1) {
        $conn = query();
        $questions = getUserQuestions($conn, $usuario['id']);
        if (empty($questions)) {
            // Admin sem perguntas configuradas
            echo json_encode([
                'mensagem' => 'Conta admin sem perguntas de segurança configuradas. Contate o suporte.',
                'sucess' => false
            ]);
            return;
        }

        // escolher uma pergunta aleatória para 2FA
        $idx = array_rand($questions);
        $question = $questions[$idx];

        echo json_encode([
            'mensagem' => '2FA por pergunta exigida',
            'sucess' => true,
            'twofa_required' => true,
            'user_id' => $usuario['id'],
            'question' => [
                'id' => $question['question_id'],
                'text' => $question['question_text']
            ]
        ]);
        return;
    }

    // usuário não-admin -> login normal
    echo json_encode([
        'mensagem' => 'Login com sucesso.',
        'sucess' => true,
        'usuario' => [
            'id' => $usuario['id'],
            'nome' => $usuario['name'],
            'email' => $usuario['email'],
            'admin' => $usuario['admin'],
            'data_criacao' => $usuario['created_at']
        ]
    ]);
} catch (\Exception $th) {
    echo json_encode([
        'mensagem' => "Erro ao fazer login: " . $th->getMessage(),
        'sucess' => false
    ]);
}
