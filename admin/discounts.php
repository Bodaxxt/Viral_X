<?php
session_start();
require '../config/db.php';

// حماية الصفحة
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// حذف الخصم
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $conn->query("DELETE FROM discounts WHERE id = $del_id");
    header('Location: discounts.php');
    exit;
}

// تعديل الخصم
if (isset($_POST['edit_id'])) {
    $id = intval($_POST['edit_id']);
    $discount_value = floatval($_POST['edit_discount_value']);
    $update = $conn->prepare("UPDATE discounts SET discount_value = ? WHERE id = ?");
    $update->bind_param("di", $discount_value, $id);
    $update->execute();
}

// إضافة أو تحديث خصم جديد
if (isset($_POST['package'], $_POST['months'], $_POST['discount_value']) && !isset($_POST['edit_id'])) {
    $package = $_POST['package'];
    $months = intval($_POST['months']);
    $discount_value = floatval($_POST['discount_value']);

    // تحقق إذا كان الخصم موجود مسبقاً
    $check = $conn->prepare("SELECT id FROM discounts WHERE package = ? AND months = ?");
    $check->bind_param("si", $package, $months);
    $check->execute();
    $res = $check->get_result();
    if ($res->num_rows > 0) {
        // تحديث
        $row = $res->fetch_assoc();
        $update = $conn->prepare("UPDATE discounts SET discount_value = ? WHERE id = ?");
        $update->bind_param("di", $discount_value, $row['id']);
        $update->execute();
    } else {
        // إضافة جديد
        $insert = $conn->prepare("INSERT INTO discounts (package, months, discount_value) VALUES (?, ?, ?)");
        $insert->bind_param("sid", $package, $months, $discount_value);
        $insert->execute();
    }
}

// جلب جميع الخصومات
$discounts = $conn->query("SELECT * FROM discounts ORDER BY package, months")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>إدارة الخصومات</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">إدارة خصومات الباقات</h2>
    <form method="post" class="row g-3 mb-4">
        <div class="col-md-3">
            <select name="package" class="form-control" required>
                <option value="">اختر الباقة</option>
                <option value="bronze">Bronze</option>
                <option value="silver">Silver</option>
                <option value="gold">Gold</option>
                <option value="platinum">Platinum</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="months" class="form-control" required>
                <option value="">اختر المدة</option>
                <option value="3">3 شهور</option>
                <option value="6">6 شهور</option>
                <option value="12">سنة</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" step="0.01" name="discount_value" class="form-control" placeholder="قيمة الخصم" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">حفظ الخصم</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الباقة</th>
                <th>المدة (شهور)</th>
                <th>قيمة الخصم</th>
                <th>تعديل</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discounts as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['package']); ?></td>
                    <td><?= $d['months']; ?></td>
                    <td>$<?= number_format($d['discount_value'], 2); ?></td>
                    <td>
                        <form method="post" class="d-flex gap-2 align-items-center">
                            <input type="hidden" name="edit_id" value="<?= $d['id']; ?>">
                            <input type="number" step="0.01" name="edit_discount_value" value="<?= $d['discount_value']; ?>" class="form-control form-control-sm" style="width:100px;">
                            <button type="submit" class="btn btn-sm btn-success">تعديل</button>
                        </form>
                    </td>
                    <td>
                        <a href="discounts.php?delete=<?= $d['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف الخصم؟');">حذف</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>