<?php
session_start();
require '../config/db.php';

try {
    $stmt = $pdo->query("SELECT user_id, username, COUNT(*) AS message_count FROM chat_messages GROUP BY user_id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'فشل جلب المستخدمين']);
}
?>