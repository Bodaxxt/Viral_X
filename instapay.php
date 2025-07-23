<?php
include 'session.php';
require 'config/db.php';

// تمكين عرض الأخطاء
error_reporting(E_ALL);
ini_set('display_errors', 1);

// التحقق من أن المستخدم مسجل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// الأسعار الرسمية
$package_prices = [
    'BRONZE'   => 199,
    'SILVER'   => 349,
    'GOLD'     => 499,
    'PLATINUM' => 799
];

// استقبال اسم الباقة والمدة والسعر النهائي
$selected_package_name_raw = $_POST['package'] ?? $_GET['package'] ?? null;
$selected_package_name = $selected_package_name_raw ? strtoupper($selected_package_name_raw) : null;
$selected_duration = $_POST['duration'] ?? $_GET['duration'] ?? null;
$final_price = $_POST['price'] ?? $_POST['paid_amount'] ?? null;

// التحقق من الباقة (بدون حساسية حالة الأحرف)
if (!$selected_package_name || !array_key_exists($selected_package_name, $package_prices)) {
    header("Location: property-details.php?error=" . urlencode("باقة غير صالحة أو لم يتم تحديدها."));
    exit();
}

$package_display_name = htmlspecialchars(ucfirst(strtolower($selected_package_name)));

// جلب السعر الرسمي
$secure_price = $package_prices[$selected_package_name];

// حساب السعر المتوقع حسب المدة
$expected_price = $secure_price;
if ($selected_duration) {
    if ($selected_duration == 3) {
        // جلب الخصم من قاعدة البيانات
        $discount_row = $conn->query("SELECT discount_value FROM discounts WHERE package = '" . $selected_package_name . "' AND months = 3")->fetch_assoc();
        $discount = $discount_row ? floatval($discount_row['discount_value']) : 0;
        $expected_price = $secure_price * 3 - $discount;
    } elseif ($selected_duration == 6) {
        $discount_row = $conn->query("SELECT discount_value FROM discounts WHERE package = '" . $selected_package_name . "' AND months = 6")->fetch_assoc();
        $discount = $discount_row ? floatval($discount_row['discount_value']) : 0;
        $expected_price = $secure_price * 6 - $discount;
    } elseif ($selected_duration == 12) {
        $discount_row = $conn->query("SELECT discount_value FROM discounts WHERE package = '" . $selected_package_name . "' AND months = 12")->fetch_assoc();
        $discount = $discount_row ? floatval($discount_row['discount_value']) : 0;
        $expected_price = $secure_price * 12 - $discount;
    }
}

// إذا تم إرسال السعر النهائي من الفورم، استخدمه للعرض
if ($final_price) {
    $expected_price = floatval($final_price);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaPay Payment - El-Tawfik</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; text-align: center; padding: 50px; background-color: #f8f9fa; }
        .container { max-width: 700px; margin: auto; background-color: #fff; border-radius: 15px; padding: 40px; }
    </style>
</head>
<body>
<div class="container checkout-form">
    <h2>InstaPay Payment Instructions</h2>
    <p class="text-muted">Please confirm your purchase details and proceed with the payment.</p>

    <!-- عرض رسالة الخطأ إذا تم إرسالها من صفحة التحقق -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            حدث خطأ أثناء معالجة الدفع. الرجاء المحاولة مرة أخرى. (<?php echo htmlspecialchars($_GET['error']); ?>)
        </div>
    <?php endif; ?>

    <div class="alert alert-info">تأكد من صحة الباقة والسعر قبل إكمال عملية الدفع</div>
    
    <div class="payment-info">
        <p>باقة: <strong><?php echo $package_display_name; ?></strong></p>
        <?php if ($selected_duration): ?>
            <p>المدة: <strong><?php echo $selected_duration; ?> شهر<?php echo ($selected_duration == 12 ? ' (سنة)' : ''); ?></strong></p>
        <?php endif; ?>
        <p>السعر المطلوب: <strong>$<?php echo number_format($expected_price, 2); ?></strong></p>
        <p class="contact-info">رقم حساب InstaPay: <strong style="color:#f35525">011254217070</strong></p>
        <p class="contact-info">اسم الحساب InstaPay: <strong style="color:#f35525">Zienab Tawfik</strong></p>
    </div>

    <!-- نموذج تأكيد عملية الدفع -->
    <form method="post" action="verify_instapay.php" enctype="multipart/form-data">
        <!-- نرسل اسم الباقة والسعر الآمن الذي حدده الخادم -->
        <input type="hidden" name="package" value="<?php echo htmlspecialchars($selected_package_name); ?>">
        <input type="hidden" name="expected_price" value="<?php echo $expected_price; ?>">
        <input type="hidden" name="duration" value="<?php echo htmlspecialchars($selected_duration); ?>">
        
        <div class="form-group">
            <label for="paid_amount">المبلغ المدفوع (بالدولار):</label>
            <input type="number" step="0.01" class="form-control" id="paid_amount" name="paid_amount" required>
        </div>
        <div class="form-group">
            <label for="screenshot">صورة التحويل:</label>
            <input type="file" class="form-control" id="screenshot" name="screenshot" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="transactionId">رقم العملية:</label>
            <input type="text" class="form-control" id="transactionId" name="transaction_id" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">التحقق من الدفع</button>
        </div>
    </form>
</div>
    
<a href="property-details.php" style="color:gray">الرجوع إلى صفحة الباقات</a>
<footer class="footer">
    <p>© <?php echo date("Y"); ?> El-Tawfik. All rights reserved.</p>
</footer>
</body>
</html>