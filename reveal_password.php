<?php
require 'config/db.php';

if (!isset($_GET['token'])) {
    die("رابط غير صالح.");
}

$token = $_GET['token'];

// استعلام للتحقق من التوكن بدون شرط الوقت أولاً
$stmt = $pdo->prepare("SELECT * FROM password_view_tokens WHERE token = ?");
$stmt->execute([$token]);
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    die("التوكن غير موجود في قاعدة البيانات.");
}

// تحقق من الصلاحية بشكل منفصل
$current_time = time();
$expires_time = strtotime($request['expires_at']);

if ($expires_time < $current_time) {
    die("انتهت صلاحية التوكن. تم الإنشاء في: ".$request['created_at']." وينتهي في: ".$request['expires_at']);
}

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عرض كلمة المرور</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* ... نفس الـ CSS الجميل ... */
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #f8f9fa; font-family: 'Cairo', sans-serif; }
        .form-container { max-width: 500px; width: 100%; padding: 40px; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; }
        #password-display { font-size: 24px; font-weight: bold; background-color: #e9ecef; padding: 15px; border-radius: 5px; margin: 20px 0; user-select: all; }
        #timer { color: #f35525; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>كلمة المرور الخاصة بك</h2>
        <p class="text-muted">هذه هي كلمة مرورك الحالية. سيتم إخفاؤها بعد <span id="timer">15</span> ثانية.</p>
        <div id="password-display"><?php echo htmlspecialchars($password); ?></div>
        <a href="login.php" class="btn btn-primary">الذهاب لتسجيل الدخول</a>
    </div>

    <script>
        let timeLeft = 1500;
        const timerElement = document.getElementById('timer');
        const passwordElement = document.getElementById('password-display');

        const countdown = setInterval(function() {
            timeLeft--;
            timerElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                passwordElement.innerHTML = '<em>انتهى الوقت...</em>';
                timerElement.textContent = '0';
            }
        }, 1000);
    </script>
    <?php

// --- كود تشخيصي مؤقت ---
echo "أنا في صفحة reveal_password.php<br>";
$received_token = $_GET['token'] ?? 'لا يوجد توكن في الرابط!';
echo "التوكن الذي استقبلته من الرابط هو: " . htmlspecialchars($received_token) . "<br>";
echo "الوقت الحالي حسب السيرفر هو: " . date("Y-m-d H:i:s") . "<br>";
echo "<hr>";
// --- نهاية الكود التشخيصي ---

// التأكد من وجود توكن في الرابط
if (!isset($_GET['token'])) {
    die("رابط غير صالح.");
}
?> 
// ... باقي الكود يستمر ...
</body>
</html>