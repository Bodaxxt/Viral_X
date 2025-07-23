<?php
// معلومات الاتصال بقاعدة البيانات
$db_host = 'localhost';
$db_name = 'agency1'; // <-- تم التغيير هنا
$db_user = 'root';
$db_pass = '';

// إنشاء اتصال
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
}
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// 3. التحقق من نجاح الاتصال (هذه أهم خطوة)
if ($conn->connect_error) {
    // إذا فشل الاتصال، أوقف كل شيء واعرض رسالة خطأ واضحة
    die("Connection failed: " . $conn->connect_error);
}

// 4. (اختياري ولكنه موصى به بشدة) تعيين ترميز الأحرف إلى UTF-8 لدعم اللغة العربية
$conn->set_charset("utf8mb4");

// الآن، أي ملف يقوم بعمل "require 'config/db.php'" سيكون لديه متغير $conn صالح وجاهز للاستخدام.
?>
?>