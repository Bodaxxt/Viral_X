<?php
session_start();
require 'config/db.php';

// --- (اختياري ولكن مهم) تأكد من أن المستخدم هو مساعد ---
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'assistant') {
//     die("الوصول غير مسموح به.");
// }

// 1. التحقق من أن البيانات المطلوبة مرسلة
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['payment_id']) || !isset($_POST['action'])) {
    die("طلب غير صحيح.");
}

// 2. تنظيف البيانات
$payment_id = (int)$_POST['payment_id'];
$action = htmlspecialchars($_POST['action']);
$notes = htmlspecialchars($_POST['notes']);

// 3. تحديد الحالة الجديدة بناءً على الإجراء
$new_status = '';
if ($action === 'approved') {
    $new_status = 'approved'; // مقبول
} elseif ($action === 'rejected') {
    $new_status = 'rejected'; // مرفوض
} else {
    die("إجراء غير صالح.");
}

// 4. تحديث قاعدة البيانات باستخدام Prepared Statement للحماية
try {
    $stmt = $conn->prepare("UPDATE payments SET status = ?, assistant_notes = ? WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("ssi", $new_status, $notes, $payment_id);
    $stmt->execute();
    
    // (اختياري) يمكنك هنا إرسال إشعار للعميل لإبلاغه بالنتيجة
    // send_notification($user_id, 'payment_processed', $payment_id, "تمت مراجعة دفعتك. الحالة: $new_status");
    
    // 5. إعادة التوجيه إلى لوحة التحكم مرة أخرى
    header("Location: assistant-dashboard.php?update=success");
    exit();

} catch (Exception $e) {
    error_log("Failed to update payment status: " . $e->getMessage());
    header("Location: assistant-dashboard.php?update=error");
    exit();
}
?>