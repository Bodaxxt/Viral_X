<?php
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
    $token = htmlspecialchars($_POST['token']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password && strlen($new_password) >= 8) {
        try {
            $sql = "SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$token]);
            $reset_request = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($reset_request) {
                $email = $reset_request['email'];
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // تحديث كلمة المرور في جدول المستخدمين
                $sql = "UPDATE users SET password = ? WHERE email = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$hashed_password, $email]);

                // حذف الرمز المميز
                $sql = "DELETE FROM password_resets WHERE token = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$token]);

                header("Location: login.php?success=" . urlencode(htmlspecialchars("تم تغيير كلمة المرور بنجاح. قم بتسجيل الدخول بكلمة المرور الجديدة.")));
                exit();
            } else {
                echo "<div class='alert alert-danger'>الرمز المميز غير صالح أو انتهت صلاحيته.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>حدث خطأ في قاعدة البيانات: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>كلمات المرور غير متطابقة أو قصيرة جدًا.</div>";
    }
    $pdo = null;
} else {
    echo "<div class='alert alert-danger'>حدث خطأ.</div>";
}
?>