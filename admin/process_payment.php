<?php
session_start();
// المسار الصحيح لملف الاتصال هو خطوة للخلف
require '../config/db.php'; 

// التحقق من الصلاحيات
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'assistant') {
//     die("صلاحيات غير كافية");
// }

// التحقق من البيانات المرسلة
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['payment_id']) || !isset($_POST['action'])) {
    header("Location: assistant-dashboard.php?error=invalid_request"); // <-- تم التصحيح هنا
    exit();
}

$payment_id = (int)$_POST['payment_id'];
$action = $_POST['action'];
$notes = $_POST['notes'] ?? ''; // تم تصحيح اسم الحقل ليطابق النموذج

// تحديد الحالة الجديدة
$new_status = '';
if ($action === 'approved') {
    $new_status = 'approved';
} elseif ($action === 'rejected') {
    $new_status = 'rejected';
} else {
    header("Location: assistant-dashboard.php?error=invalid_action"); // <-- تم التصحيح هنا
    exit();
}

try {
    // تحديث حالة الدفع والملاحظات
    $stmt = $conn->prepare("UPDATE payments SET status = ?, assistant_notes = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_status, $notes, $payment_id);
    $stmt->execute();
    
    // (اختياري) يمكنك إضافة إشعارات هنا إذا أردت
    
    // إعادة التوجيه إلى لوحة التحكم بالاسم الصحيح
    header("Location: assistant-dashboard.php?success=processed"); // <-- تم التصحيح هنا
    exit();
    
} catch (Exception $e) {
    $conn->rollback();
    error_log("Payment Processing Error: " . $e->getMessage());
    // إعادة التوجيه إلى لوحة التحكم بالاسم الصحيح
    header("Location: assistant-dashboard.php?error=processing_failed"); // <-- تم التصحيح هنا
    exit();
}
?>