<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // التحقق من وجود المستخدم
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // حذف أي طلبات سابقة لنفس البريد
                $sql = "DELETE FROM password_resets WHERE email = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);

                // إنشاء رمز جديد
                $token = bin2hex(random_bytes(32));
                $expires_at = date('Y-m-d H:i:s', strtotime('+100 hour'));

                // تخزين الرمز الجديد
                $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email, $token, $expires_at]);

                // إنشاء رابط استعادة (بشكل ديناميكي)
                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
                $host = $_SERVER['HTTP_HOST'];
                $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $reset_link = "$protocol://$host$path/reset_password.php?token=$token";

                // إعداد البريد الإلكتروني
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'viralxagency12@gmail.com';
                    $mail->Password = 'qnwh qbpl wygi tnmv';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->CharSet = 'UTF-8';

                    $mail->setFrom('viralxagency12@gmail.com', 'فريق viral_x ');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'طلب إعادة تعيين كلمة المرور';
                    $mail->Body = "
                        <div style='font-family: Cairo, sans-serif; direction: rtl;'>
                            <h2 style='color: #f35525;'>استعادة كلمة المرور</h2>
                            <p>مرحباً،</p>
                            <p>لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بحسابك.</p>
                            <p>اضغط على الزر أدناه لإعادة تعيين كلمة المرور:</p>
                            <p style='text-align: center; margin: 30px 0;'>
                                <a href='$reset_link' style='background-color: #f35525; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>إعادة تعيين كلمة المرور</a>
                            </p>
                            <p>إذا لم تطلب هذا التغيير، يمكنك تجاهل هذا البريد.</p>
                            <p>مع تحياتنا،<br>فريق موقع التوفيق</p>
                            <hr>
                            <p style='font-size: 12px; color: #777;'>إذا لم يعمل الزر أعلاه، يمكنك نسخ الرابط التالي ولصقه في متصفحك:<br>$reset_link</p>
                        </div>
                    ";

                    $mail->send();
                    $_SESSION['reset_email'] = $email; // لحماية ضد هجوم CSRF
                    header("Location: forgot_password.php?success=" . urlencode("تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني بنجاح."));
                } catch (Exception $e) {
                    header("Location: forgot_password.php?error=" . urlencode("فشل إرسال البريد. الرجاء المحاولة لاحقًا."));
                }
            } else {
                header("Location: forgot_password.php?error=" . urlencode("هذا البريد الإلكتروني غير مسجل لدينا."));
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location: forgot_password.php?error=" . urlencode("حدث خطأ في النظام. الرجاء المحاولة لاحقًا."));
        }
    } else {
        header("Location: forgot_password.php?error=" . urlencode("الرجاء إدخال بريد إلكتروني صالح."));
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- باقي الهيد بدون تغيير -->
</head>
<body>

<div class="form-container text-center">
    <h2 class="mb-3">إعادة تعيين كلمة المرور</h2>
    <p class="text-muted mb-4">أدخل بريدك الإلكتروني المسجل وسنرسل لك رابطًا لإعادة تعيين كلمة المرور.</p>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars(urldecode($_GET['error'])); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars(urldecode($_GET['success'])); ?></div>
    <?php endif; ?>

    <form action="forgot_password.php" method="post">
        <div class="mb-3 text-end">
            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com"
                   required value="<?php echo isset($_SESSION['reset_email']) ? htmlspecialchars($_SESSION['reset_email']) : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">إرسال رابط إعادة التعيين</button>
    </form>
</div>

<style>
    :root {
        --primary-color: #f35525;
        --secondary-color: #e04a1a;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Cairo', sans-serif;
    }

    .form-container {
        max-width: 500px;
        width: 100%;
        padding: 2.5rem;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .form-container h2 {
        font-weight: 700;
        color: var(--primary-color);
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    
    .form-container h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 70px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }

    .form-container .text-muted {
        color: #6c757d !important;
        font-size: 0.95rem;
    }

    .btn-primary {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(243, 85, 37, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .btn-primary:hover {
        background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(243, 85, 37, 0.4);
    }
    
    .btn-primary:active {
        transform: translateY(1px);
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(243, 85, 37, 0.25);
    }

    .alert {
        border-radius: 8px;
        font-size: 0.95rem;
        word-wrap: break-word;
    }
    
    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
    }
    
    .alert-success {
        background-color: rgba(25, 135, 84, 0.1);
        border-color: rgba(25, 135, 84, 0.2);
    }

    /* تأثيرات إضافية */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .form-container {
        animation: fadeIn 0.6s ease-out;
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .input-icon input {
        padding-right: 15px;
        padding-left: 40px;
    }
</style>
</body>
</html>