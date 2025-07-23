<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        header('Location: forgot_password.php');
        exit;
    }

    $stmt = $pdo->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header('Location: forgot_password.php?error=البريد الإلكتروني غير موجود.');
        exit;
    }

    $username_from_db = $user['username'];
    $password_from_db = $user['password'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'eltawifkcode@gmail.com';
        $mail->Password   = 'qefc vwkg mviz jskr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('eltawifkcode@gmail.com', 'El Tawfik Group - Support');
        $mail->addAddress($email, $username_from_db);

        $mail->isHTML(true);
        $mail->Subject = 'استعادة كلمة المرور الخاصة بك - التوفيق جروب';
        $mail->Body    = '
            <div dir="rtl" style="font-family: Arial, sans-serif; text-align: right; line-height: 1.6;">
                <h2 style="color: #f35525;">استعادة بيانات حسابك</h2>
                <p>مرحباً ' . htmlspecialchars($username_from_db) . '،</p>
                <p>بناءً على طلبك، قمنا باستعادة بيانات حسابك.</p>
                <hr>
                <p>كلمة المرور الخاصة بك هي: <strong style="font-size: 18px; color: #001219; background-color: #f0f0f0; padding: 5px 10px; border-radius: 4px;">' . htmlspecialchars($password_from_db) . '</strong></p>
                <hr>
                <p style="color: #888; font-size: 14px;"><strong>تحذير أمني:</strong> نوصي بشدة بتسجيل الدخول إلى حسابك وتغيير كلمة المرور في أقرب وقت ممكن للحفاظ على أمان حسابك.</p>
                <p>شكرًا لك،<br>فريق الدعم في التوفيق جروب</p>
            </div>
        ';
        $mail->AltBody = 'مرحباً ' . htmlspecialchars($username_from_db) . ', كلمة المرور الخاصة بك هي: ' . htmlspecialchars($password_from_db) . '. يرجى تغييرها فوراً.';

        $mail->send();
        
        header('Location: forgot_password.php?success=تم إرسال كلمة المرور إلى بريدك الإلكتروني بنجاح.');
        exit;

    } catch (Exception $e) {
        $error_message = 'حدث خطأ أثناء إرسال البريد. الخطأ: ' . $mail->ErrorInfo;
        header('Location: forgot_password.php?error=' . urlencode($error_message));
        exit;
    }
} else {
    header('Location: forgot_password.php');
    exit;
}
?>