<?php
session_start();
require 'config/db.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM chat_messages WHERE user_id = ? ORDER BY created_at ASC");
    $stmt->execute([$userId]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'فشل جلب الرسائل']);
}
?>