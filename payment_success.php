<?php
session_start();
require 'config/db.php';

// 1. التأكد من أن المستخدم مسجل دخوله
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. جلب رقم الطلب من الرابط والتأكد من أنه رقم
$payment_id = filter_input(INPUT_GET, 'payment_id', FILTER_VALIDATE_INT);
if (!$payment_id) {
    // إذا لم يكن هناك رقم طلب، أعده للصفحة الرئيسية
    header("Location: index.php");
    exit();
}

// 3. جلب تفاصيل الطلب من قاعدة البيانات بشكل آمن
// نتأكد أن الطلب يخص المستخدم الحالي لمنع الآخرين من رؤيته
$stmt = $conn->prepare("SELECT * FROM payments WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $payment_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();

// إذا لم يتم العثور على الطلب، أعده للصفحة الرئيسية
if (!$payment) {
    header("Location: index.php");
    exit();
}

// 4. تحديد لون وشكل حالة الطلب
$status_text = '';
$status_class = '';
switch ($payment['status']) {
    case 'pending':
        $status_text = 'قيد المراجعة';
        $status_class = 'badge bg-warning text-dark'; // أصفر
        break;
    case 'approved':
        $status_text = 'مقبول';
        $status_class = 'badge bg-success'; // أخضر
        break;
    case 'rejected':
        $status_text = 'مرفوض';
        $status_class = 'badge bg-danger'; // أحمر
        break;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبك بنجاح</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Cairo', sans-serif;
        }
        .success-container {
            max-width: 700px;
            margin-top: 50px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #28a745;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            text-align: center;
            padding: 20px;
        }
        .card-header i {
            font-size: 50px;
        }
        .list-group-item {
            border: none;
            padding: 15px 20px;
        }
        .list-group-item strong {
            color: #333;
        }
    </style>
</head>
<body>

<div class="container success-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-check-circle"></i>
            <h2 class="mt-3 mb-0">تم استلام طلبك بنجاح!</h2>
        </div>
        <div class="card-body p-4">
            <p class="lead text-center text-muted mb-4">
                شكرًا لك. سيقوم فريقنا بمراجعة إثبات الدفع والرد عليك في أقرب وقت ممكن.
            </p>
            
            <h5 class="mb-3">ملخص الطلب:</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>رقم الطلب:</strong>
                    <span>#<?php echo htmlspecialchars($payment['id']); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>الباقة:</strong>
                    <span><?php echo htmlspecialchars(ucfirst($payment['package'])); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>المبلغ المدفوع:</strong>
                    <span>$<?php echo htmlspecialchars($payment['paid_amount']); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>تاريخ الطلب:</strong>
                    <span><?php echo date('d M Y, H:i', strtotime($payment['created_at'])); ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>حالة الطلب:</strong>
                    <span class="<?php echo $status_class; ?> p-2"><?php echo $status_text; ?></span>
                </li>
            </ul>

            <div class="text-center mt-4">
                <a href="property-details.php" class="btn btn-primary">العودة لصفحة الباقات</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>