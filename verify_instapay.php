<?php
session_start();
require 'config/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- 1. التحقق من البيانات ---
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("الوصول غير مسموح به.");
}

$package = $_POST['package'] ?? '';
if (empty($package) || empty($_POST['expected_price']) || empty($_POST['paid_amount']) || empty($_POST['transaction_id']) || $_FILES['screenshot']['error'] != 0) {
    header("Location: instapay.php?error=missing_fields&package=" . urlencode($package));
    exit();
}

$package        = htmlspecialchars($_POST['package']);
$paid_amount    = floatval($_POST['paid_amount']);
$expected_price = floatval($_POST['expected_price']);
$transaction_id = htmlspecialchars($_POST['transaction_id']);

if ($paid_amount != $expected_price) {
    header("Location: instapay.php?error=price_mismatch&package=" . urlencode($package));
    exit();
}

// --- 2. معالجة الصورة ---
$target_dir = "uploads/payments/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$file_info    = pathinfo($_FILES['screenshot']['name']);
$extension    = strtolower($file_info['extension']);
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($extension, $allowed_types)) {
    header("Location: instapay.php?error=upload_failed&package=" . urlencode($package));
    exit();
}

$new_filename = 'payment_' . $_SESSION['user_id'] . '_' . time() . '.' . $extension;
$target_file  = $target_dir . $new_filename;

if (!move_uploaded_file($_FILES['screenshot']['tmp_name'], $target_file)) {
    header("Location: instapay.php?error=upload_failed&package=" . urlencode($package));
    exit();
}

// --- 3. حفظ البيانات في قاعدة البيانات ---
try {
    $conn->begin_transaction();

    // إدخال الدفعة
    $stmt_payment = $conn->prepare("INSERT INTO payments (user_id, package, expected_amount, paid_amount, transaction_id, screenshot_path, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt_payment->bind_param("isddss", $_SESSION['user_id'], $package, $expected_price, $paid_amount, $transaction_id, $target_file);
    $stmt_payment->execute();
    $payment_id = $conn->insert_id;

    // إرسال إشعار للمساعد
    $assistant_id_in_db = 1; // رقم المساعد في جدول users (عدله حسب الحاجة)
    $notification_type  = 'payment_review';
    $message            = "طلب دفع جديد للمراجعة، رقم الطلب: #$payment_id";

    $stmt_notification = $conn->prepare("INSERT INTO notifications (user_id, payment_id, type, message) VALUES (?, ?, ?, ?)");
    $stmt_notification->bind_param("siss", $assistant_id_in_db, $payment_id, $notification_type, $message);
    $stmt_notification->execute();

    $conn->commit();

    // إعادة المستخدم إلى صفحة النجاح
    header("Location: payment_success.php?payment_id=$payment_id");
    exit();

} catch (Exception $e) {
    // عرض رسالة الخطأ مباشرة للمطور
    echo '<div style="color:red;direction:ltr;text-align:left;padding:20px;font-size:18px;background:#fff3f3;border:1px solid #f00;margin:30px auto;max-width:700px;">';
    echo '<b>Database Error:</b><br>';
    echo nl2br(htmlspecialchars($e->getMessage()));
    echo '<br><br><b>Stack Trace:</b><br>';
    echo nl2br(htmlspecialchars($e->getTraceAsString()));
    echo '</div>';
    exit();
}
?>