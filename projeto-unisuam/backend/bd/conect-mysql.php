<?php

function query()
{
    try {
        return new PDO("mysql:host=localhost;dbname=develop", "root", "");
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
}


// INSERT INTO answers (user_id, question_id, answer_text, answer_date) VALUES (5, 1, 'pompom', '2025-11-02 11:39:33')