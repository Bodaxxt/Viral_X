<?php
session_start();
require 'config/db.php';

if (!isset($_GET['payment_id']) || !isset($_GET['status'])) {
    header("Location: instapay.php");
    exit();
}

$payment_id = $_GET['payment_id'];
$status = $_GET['status'];

$stmt = $conn->prepare("SELECT * FROM payments WHERE id = ?");
$stmt->bind_param("i", $payment_id);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();

if (!$payment) {
    header("Location: instapay.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حالة الدفع</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="alert alert-<?= $status === 'failed' ? 'danger' : 'warning' ?>">
        <h4>تم تسجيل طلبك</h4>
        <p>رقم الطلب: #<?= $payment_id ?></p>
        <p>الحالة: <?= $status === 'failed' ? 'طلب فاشل - سيتم مراجعته من قبل الدعم الفني' : 'معلق' ?></p>
    </div>

    <a href="dashboard.php" class="btn btn-primary">العودة إلى لوحة التحكم</a>

</body>
</html>