<?php
require_once('../bd/conect-mysql.php');

function existsEmail(string $email): bool
{
    $query = query();
    $sql = "SELECT COUNT(*) FROM user WHERE email = :email";

    $stmt = $query->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function create(string $name, string $email, string $password): void
{
    $query = query();
    $sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";

    $stmt = $query->prepare($sql);

    $senha_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $senha_hashed);
    $stmt->execute();
}

function getUserByEmail(string $email): bool|array
{
    $query = query();

    $sql = "SELECT id, name, email, password, admin, created_at FROM user WHERE email = :email";

    $stmt = $query->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePassword(int $id, string $novaSenha): void
{
    $query = query();
    $sql = "UPDATE user SET password = :senha WHERE id = :id";
    $stmt = $query->prepare($sql);
    $stmt->bindParam(':senha', password_hash($novaSenha, PASSWORD_DEFAULT));
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

function updateUser($conn, $id, $nome, $email, $tipo, $senha = null): bool
{
    try {
        $isAdmin = ($tipo === 'admin') ? 1 : 0;

        if ($senha !== null && !empty($senha)) {
            // Se uma nova senha foi fornecida, atualiza todos os campos incluindo a senha
            $sql = "UPDATE user SET name = :nome, email = :email, admin = :tipo, password = :senha WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindParam(':senha', $senhaHash);
        } else {
            // Se não foi fornecida senha, atualiza apenas os outros campos
            $sql = "UPDATE user SET name = :nome, email = :email, admin = :tipo WHERE id = :id";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo', $isAdmin);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function getAllUsers(): array
{
    $query = query();
    $sql = "SELECT id, name, email, admin, created_at FROM user";
    $stmt = $query->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteUserById(int $id): void
{
    $query = query();
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = $query->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

/**
 * Retorna as perguntas (id, text) que o usuário respondeu.
 */
function getUserQuestions($conn, $userId): array {
    try {
        $sql = "SELECT q.question_id, q.question_text
                FROM questions q
                JOIN answers a ON a.question_id = q.question_id
                WHERE a.user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Verifica se a resposta fornecida para uma pergunta corresponde àquela armazenada para o usuário.
 * A comparação é feita em lowercase e sem espaços extras.
 */
function checkUserAnswer($conn, $userId, $questionId, $answer): bool {
    try {
        $sql = "SELECT answer_text FROM answers WHERE user_id = :user_id AND question_id = :question_id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':question_id', $questionId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return false;

        $stored = trim(mb_strtolower($row['answer_text']));
        $given = trim(mb_strtolower($answer));
        return $stored === $given;
    } catch (PDOException $e) {
        return false;
    }
}
