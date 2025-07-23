<?php
require 'config/db.php';

// بيانات المدير الثابتة
$username = 'Admin';
$email = 'admin@admin.com';
$password = password_hash('admin123', PASSWORD_DEFAULT); // يمكنك تغيير كلمة المرور هنا
$role = 'admin';

// تحقق إذا كان المدير موجود مسبقاً
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
$stmt->execute([$email]);
if (!$stmt->fetch()) {
    // إذا لم يكن موجود، أضفه
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $role]);
    echo "تم إنشاء حساب المدير بنجاح!";
} else {
    echo "حساب المدير موجود بالفعل.";
}
?>
