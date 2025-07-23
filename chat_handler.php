<?php
// ملف: chat_handler.php (النسخة الكاملة والوظيفية)
session_start();
include 'session.php'; // للتأكد من أن بيانات الجلسة متاحة
require 'config/db.php';

// التأكد من أن المستخدم مسجل دخوله
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// التأكد من وجود "action" في الطلب
$action = $_GET['action'] ?? null;
if (!$action) {
    echo json_encode(['status' => 'error', 'message' => 'No action specified.']);
    exit;
}

header('Content-Type: application/json');
$user_id = $_SESSION['user_id'];

switch ($action) {
    // ====================== [ حالة إرسال الرسالة ] ======================
    case 'sendMessage':
        $message = trim($_POST['message'] ?? '');

        if (empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
            exit;
        }

        // حفظ الرسالة في قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO chat_messages (user_id, message, sender_role) VALUES (?, ?, 'user')");
        $stmt->bind_param("is", $user_id, $message);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save message.']);
        }
        $stmt->close();
        break;

    // ====================== [ حالة جلب الرسائل ] ======================
    case 'getMessages':
        // جلب كل الرسائل الخاصة بالمستخدم الحالي، مرتبة بالأقدم أولاً
        $stmt = $conn->prepare("SELECT message, sender_role FROM chat_messages WHERE user_id = ? ORDER BY created_at ASC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $messages = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        echo json_encode(['status' => 'success', 'messages' => $messages]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
        break;
}

$conn->close();
