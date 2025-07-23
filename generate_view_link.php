<?php
session_start();
require 'config/db.php'; // تأكد من وجود ملف الاتصال

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // التحقق من وجود المستخدم
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if (!$stmt->fetch()) {
        header('Location: forgot_password.php?error=البريد الإلكتروني غير موجود.');
        exit;
    }

    // حذف أي توكنات قديمة لهذا المستخدم
    $pdo->prepare("DELETE FROM password_view_tokens WHERE email = ?")->execute([$email]);

    // إنشاء توكن جديد وآمن
    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", time() + 60); // صالح لدقيقة واحدة فقط!

    // حفظ التوكن في قاعدة البيانات
    $stmt_insert = $pdo->prepare("INSERT INTO password_view_tokens (email, token, expires_at) VALUES (?, ?, ?)");
    $stmt_insert->execute([$email, $token, $expires]);

    // توجيه المستخدم إلى صفحة العرض مع التوكن
    header("Location: reveal_password.php?token=" . $token);
    exit;

    // --- كود تشخيصي مؤقت ---
        echo "تم إنشاء التوكن بنجاح.<br>";
        echo "البريد الإلكتروني: " . htmlspecialchars($email) . "<br>";
        echo "التوكن الذي تم إنشاؤه: " . htmlspecialchars($token) . "<br>";
        echo "تاريخ الانتهاء: " . htmlspecialchars($expires) . "<br>";
        echo '<a href="reveal_password.php?token=' . $token . '">اضغط هنا للانتقال يدويًا</a>';
        exit; // أوقف الكود هنا مؤقتًا لمنع التوجيه التلقائي
        // --- نهاية الكود التشخيصي ---

        header("Location: reveal_password.php?token=" . $token);
        exit;
}
?>