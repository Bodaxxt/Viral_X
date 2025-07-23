<?php
session_start();

// التحقق من أن المستخدم مسجل دخوله وأنه مدير (admin)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // إذا لم يكن مدير، قم بإعادته إلى صفحة الدخول
    header('Location: ../login.php');
    exit;
}

// هنا يمكنك كتابة كود عرض بيانات لوحة تحكم المدير
require '../config/db.php';
$stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <title>لوحة تحكم المدير</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>مرحباً بك في لوحة تحكم المدير, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>هنا يمكنك إدارة المستخدمين والبيانات الأخرى.</p>
        <a href="../logout.php" class="btn btn-danger">تسجيل الخروج</a>
        <h3 class="mt-5">قائمة المستخدمين (العدد: <?php echo count($users); ?>)</h3>
        <!-- هنا جدول عرض المستخدمين الذي أنشأناه سابقاً -->
    </div>
</body>
</html>