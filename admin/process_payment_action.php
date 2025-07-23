<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'assistant') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'غير مصرح']);
    exit;
}

require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = isset($_POST['payment_id']) ? intval($_POST['payment_id']) : 0;
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if (!$payment_id || !in_array($action, ['approve', 'reject'])) {
        echo json_encode(['status' => 'error', 'message' => 'بيانات غير صالحة']);
        exit;
    }

    // جلب بيانات الطلب
    $result = $conn->query("SELECT * FROM payments WHERE id = $payment_id AND status = 'pending'");
    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'الطلب غير موجود أو تم مراجعته بالفعل']);
        exit;
    }

    if ($action === 'approve') {
        $update = $conn->query("UPDATE payments SET status = 'approved', updated_at = NOW() WHERE id = $payment_id");
        if ($update) {
            // يمكن هنا إضافة إشعار للأدمن إذا أردت
            echo json_encode(['status' => 'success', 'new_status' => 'approved']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'فشل تحديث الحالة']);
        }
    } elseif ($action === 'reject') {
        $update = $conn->query("UPDATE payments SET status = 'rejected', updated_at = NOW() WHERE id = $payment_id");
        if ($update) {
            echo json_encode(['status' => 'success', 'new_status' => 'rejected']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'فشل تحديث الحالة']);
        }
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'طلب غير صالح']);
exit;
