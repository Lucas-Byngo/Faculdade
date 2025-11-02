<?php
header('Content-Type: application/json');
require_once('../repository/user.php');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['user_id']) || !isset($data['question_id']) || !isset($data['answer'])) {
    echo json_encode(['mensagem' => 'Dados incompletos', 'sucess' => false]);
    exit;
}

$userId = $data['user_id'];
$questionId = $data['question_id'];
$answer = $data['answer'];

$conn = query();
$ok = checkUserAnswer($conn, $userId, $questionId, $answer);

if (!$ok) {
    echo json_encode(['mensagem' => 'Resposta incorreta', 'sucess' => false]);
    exit;
}

// se válido, buscar dados do usuário e retornar objeto de sessão
try {
    $stmt = $conn->prepare("SELECT id, name, email, admin, created_at FROM user WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo json_encode(['mensagem' => 'Usuário não encontrado', 'sucess' => false]);
        exit;
    }

    echo json_encode([
        'mensagem' => 'Verificação 2FA bem sucedida',
        'sucess' => true,
        'usuario' => [
            'id' => $usuario['id'],
            'nome' => $usuario['name'],
            'email' => $usuario['email'],
            'admin' => $usuario['admin'],
            'data_criacao' => $usuario['created_at']
        ]
    ]);
} catch (PDOException $e) {
    echo json_encode(['mensagem' => 'Erro interno', 'sucess' => false]);
}
?>