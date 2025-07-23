<?php
session_start();
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        die("كلمتا المرور غير متطابقتين.");
    }
    
    // التحقق مرة أخرى من التوكن
    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->execute([$token]);
    $request = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$request) {
        die("توكن غير صالح أو منتهي الصلاحية.");
    }

    // تحديث كلمة المرور في جدول المستخدمين
    $email = $request['email'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashed_password, $email]);

    // حذف التوكن المستخدم
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);

    // توجيه المستخدم لصفحة الدخول مع رسالة نجاح
    $_SESSION['success_message'] = "تم تحديث كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول.";
    header("Location: login.php");
    exit;
}