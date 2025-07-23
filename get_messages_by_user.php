<?php
session_start();
require 'config/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM chat_messages ORDER BY created_at ASC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch messages']);
}
?>