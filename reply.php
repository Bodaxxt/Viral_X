<?php
session_start();
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'], $_POST['user_id'])) {
    $message = htmlspecialchars(trim($_POST['message']));
    $userId = intval($_POST['user_id']);
    $username = $_POST['username'] ?? 'الدعم الفني';

    try {
        $sql = "INSERT INTO chat_messages (user_id, username, message, is_admin_reply) VALUES (?, ?, ?, 1)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $username, $message]);
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        error_log("reply.php: Database error: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'فشل إرسال الرد']);
    }
}
?>