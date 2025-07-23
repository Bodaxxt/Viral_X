<?php
// --- النسخة المحدثة والنهائية للوحة تحكم المدير ---

session_start();
require '../config/db.php'; // تأكد من صحة المسار

// =========================================================================
// الخطوة 1: حماية الصفحة والتأكد من أن المستخدم هو مدير (Admin)
// =========================================================================
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// =========================================================================
// الخطوة 2: جلب البيانات الحقيقية لعرضها في لوحة التحكم
// =========================================================================

// أ) إجمالي عدد المستخدمين (هذا الجزء صحيح)
$result_users = $conn->query("SELECT COUNT(id) as total_users FROM users WHERE role = 'user'");
$total_users = $result_users->fetch_assoc()['total_users'];

// ب) إجمالي الأرباح [تعديل: من جدول payments للحالات المقبولة]
$result_revenue = $conn->query("SELECT SUM(paid_amount) as total_revenue FROM payments WHERE status = 'approved'");
$total_revenue = $result_revenue->fetch_assoc()['total_revenue'] ?? 0;

// ج) العدد الإجمالي للطلبات [تعديل: من جدول payments للحالات المقبولة]
$result_orders = $conn->query("SELECT COUNT(id) as total_orders FROM payments WHERE status = 'approved'");
$total_orders = $result_orders->fetch_assoc()['total_orders'];

// د) قائمة بأعلى 5 عملاء دفعاً [تعديل: من جدول payments و users]
$result_top_customers = $conn->query("
    SELECT u.username, COUNT(p.id) as order_count, SUM(p.paid_amount) as total_spent
    FROM payments p 
    JOIN users u ON p.user_id = u.id 
    WHERE p.status = 'approved' AND u.role = 'user'
    GROUP BY u.id, u.username 
    ORDER BY total_spent DESC 
    LIMIT 5
");
$top_customers = $result_top_customers->fetch_all(MYSQLI_ASSOC);

// هـ) جلب أحدث 10 رسائل من جدول الاتصال (هذا الجزء صحيح)
$result_messages = $conn->query("
    SELECT id, name, email, subject, message, received_at 
    FROM contact_messages ORDER BY received_at DESC LIMIT 10
");
$contact_messages = $result_messages->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>لوحة تحكم المدير - تحليلات</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Cairo', sans-serif; }
        .card-icon { font-size: 3.5rem; opacity: 0.15; position: absolute; left: 15px; top: 50%; transform: translateY(-50%); }
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.07); transition: transform 0.3s, box-shadow 0.3s; overflow: hidden; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .table { vertical-align: middle; }
        .table thead th { background-color: #343a40; color: #fff; border-bottom: 0; }
        .navbar-brand { font-weight: bold; }
        .card-header { font-weight: bold; }
        .message-box { background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef;}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand">
                <i class="fas fa-chart-pie"></i>
                لوحة التحكم | مرحباً يا مدير, <?php echo htmlspecialchars($_SESSION['username']); ?>
            </a>
            <div class="d-flex gap-2">
                <a href="discounts.php" class="btn btn-warning">
                    <i class="fas fa-percent"></i> إدارة الخصومات
                </a>
                <a href="../logout.php" class="btn btn-outline-light">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- صف الكروت للتحليلات السريعة -->
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-white bg-primary stat-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي المستخدمين</h5>
                        <h2 class="display-4 fw-bold"><?php echo $total_users; ?></h2>
                        <i class="fas fa-users card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-white bg-success stat-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي المكسب</h5>
                        <h2 class="display-4 fw-bold">$<?php echo number_format($total_revenue, 2); ?></h2>
                        <i class="fas fa-dollar-sign card-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card text-white bg-info stat-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي عدد الطلبات المقبولة</h5>
                        <h2 class="display-4 fw-bold"><?php echo $total_orders; ?></h2>
                        <i class="fas fa-shopping-cart card-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول أعلى المشترين -->
        <div class="card mt-3">
            <div class="card-header bg-dark text-white">
                <h4><i class="fas fa-trophy"></i> أعلى 5 عملاء إنفاقًا (طلبات مقبولة)</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr><th>#</th><th>اسم المستخدم</th><th>عدد الطلبات</th><th>إجمالي المبلغ</th></tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($top_customers)): ?>
                                <?php foreach ($top_customers as $index => $customer): ?>
                                    <tr>
                                        <th scope="row"><?php echo $index + 1; ?></th>
                                        <td><i class="fas fa-user-circle text-muted me-2"></i><?php echo htmlspecialchars($customer['username']); ?></td>
                                        <td><?php echo $customer['order_count']; ?></td>
                                        <td class="fw-bold text-success">$<?php echo number_format($customer['total_spent'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted p-4">لا توجد بيانات لعرضها.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- قسم الرسائل الجديدة -->
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h4><i class="fas fa-envelope-open-text"></i> أحدث الرسائل الواردة</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($contact_messages)): ?>
                    <?php foreach ($contact_messages as $msg): ?>
                        <div class="message-box p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($msg['subject']); ?></h5>
                                <small class="text-muted flex-shrink-0"><?php echo date('d M Y, H:i', strtotime($msg['received_at'])); ?></small>
                            </div>
                            <p class="mb-2"><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                            <small class="text-muted">
                                <strong>من:</strong> <?php echo htmlspecialchars($msg['name']); ?> | 
                                <strong>بريد:</strong> <?php echo htmlspecialchars($msg['email']); ?>
                            </small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted p-3">لا توجد رسائل جديدة لعرضها.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>