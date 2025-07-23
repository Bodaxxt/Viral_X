<?php
// ملف: login.php (النسخة النهائية مع الحفاظ على منطق الأدمن والمساعد)
session_start();
require 'config/db.php'; // يستخدم متغير $conn

$message = '';
$message_type = 'danger';

if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    $message_type = 'success';
    unset($_SESSION['success_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // بيانات الأدمن الثابتة (لم تتغير)
    $admin_email = 'admin@admin.com';
    $admin_password = 'admin123';
    
    // بيانات المساعد الثابتة (لم تتغير)
    $assistant_email = 'assistant@example.com';
    $assistant_password = 'assistant123';

    if (!empty($email) && !empty($password)) {
        // 1. التحقق من الأدمن (كما هو)
        if ($email === $admin_email && $password === $admin_password) {
            $_SESSION['user_id'] = 'admin_id';
            $_SESSION['username'] = 'Admin';
            $_SESSION['role'] = 'admin';
            header("Location: admin/dashboard.php");
            exit;
        } 
        // 2. التحقق من المساعد (مع تعديل بسيط ومهم)
        elseif ($email === $assistant_email && $password === $assistant_password) {
            
            // ✅ [التعديل هنا] سنجلب الـ ID الرقمي الحقيقي للمساعد من قاعدة البيانات
            $assistant_username_in_db = 'assistant'; // اسم مستخدم المساعد في جدول users
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $assistant_username_in_db);
            $stmt->execute();
            $result = $stmt->get_result();
            $assistant_user = $result->fetch_assoc();

            // إذا وجدنا المساعد في قاعدة البيانات، نستخدم الـ ID الرقمي الخاص به
            if ($assistant_user) {
                $_SESSION['user_id'] = $assistant_user['id']; // <-- هذا هو الحل!
            } else {
                // إذا لم يتم العثور عليه، نستخدم قيمة افتراضية (هذا لا يجب أن يحدث)
                $_SESSION['user_id'] = 0; 
            }
            
            $_SESSION['username'] = 'assistant'; // مهم أن يكون اسم المستخدم متطابقًا
            $_SESSION['role'] = 'assistant';
            
            // توجيهه إلى لوحة تحكم الشات
            header("Location: admin/assistant-dashboard.php");
            exit;
        } 
        
        // 3. التحقق من المستخدم العادي (كما هو)
        else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit;
            } else {
                $message = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
            }
        }
    } else {
        $message = 'الرجاء ملء جميع الحقول.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>تسجيل الدخول</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f4f8;
        }
        .login-wrapper {
            display: flex;
            width: 100vw;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f0f4f8;
        }
        .login-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background: #fff;
            border-radius: 0;
            box-shadow: none;
            overflow: hidden;
        }
        .login-form {
            width: 50vw;
            min-width: 350px;
            max-width: 50vw;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-graphic {
            width: 50vw;
            max-width: 50vw;
            min-width: 350px;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #e0f0ff;
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M43.66 8.31L50 11.55l6.34-3.24-2.5 7.19 6.34 3.24-7.49.62 2.5 7.19-6.34-3.24-6.34 3.24 2.5-7.19-7.49-.62 6.34-3.24-2.5-7.19z" fill-opacity=".1" fill="%23007bff"/></svg>');
        }
        .login-graphic h1 {
            background: #002d5c;
            color: #fff;
            padding: 10px 30px;
            border-radius: 50px;
            font-size: 2.5rem;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .login-graphic img {
            max-width: 80%;
        }
        .login-graphic {
            background-color: #e0f0ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M43.66 8.31L50 11.55l6.34-3.24-2.5 7.19 6.34 3.24-7.49.62 2.5 7.19-6.34-3.24-6.34 3.24 2.5-7.19-7.49-.62 6.34-3.24-2.5-7.19z" fill-opacity=".1" fill="%23007bff"/></svg>');
        }
        .login-graphic h1 {
            background: #002d5c;
            color: #fff;
            padding: 10px 30px;
            border-radius: 50px;
            font-size: 2.5rem;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .login-graphic img {
            max-width: 80%;
        }
        .login-form h2 {
            font-weight: 700;
            color: #002d5c;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 0;
            padding-right: 35px;
            height: 50px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #fca311;
        }
        .form-group i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            color: #ccc;
        }
        .btn-submit {
            background: #fca311;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            color: #fff;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: #e8950d;
            transform: translateY(-2px);
        }
        .text-divider {
            text-align: center;
            margin: 20px 0;
            color: #aaa;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        /* =============================================
   CSS جديد لجعل صفحة تسجيل الدخول متجاوبة
   ============================================= */

/* تعديل ليناسب الشاشات الأصغر من التابلت */
@media (max-width: 991px) {
    .login-container {
        flex-direction: column; /* <-- 1. تغيير اتجاه العرض إلى رأسي */
        height: auto; /* <-- جعل الارتفاع تلقائيًا ليناسب المحتوى */
        min-height: 100vh;
    }

    .login-form, .login-graphic {
        width: 100%; /* جعل كل قسم يأخذ العرض الكامل */
        max-width: 100%; /* إلغاء الحد الأقصى للعرض */
        padding: 40px 20px;
    }

    .login-graphic {
        /* يمكنك إخفاء قسم الصورة تمامًا على الموبايل لتجربة أفضل */
        /* إذا أردت إخفاءه، أزل علامتي التعليق من السطر التالي */
        /* display: none; */ 
        
        /* أو يمكنك جعله أصغر حجمًا */
        padding-top: 60px;
        padding-bottom: 60px;
        order: -1; /* جعل الصورة تظهر فوق النموذج */
    }

    .login-graphic h1 {
        font-size: 2rem;
    }
}

/* تعديل إضافي للشاشات الصغيرة جدًا (الموبايل) */
@media (max-width: 576px) {
    .login-form h2 {
        font-size: 1.8rem; /* تصغير حجم العنوان الرئيسي */
    }
    .btn-submit {
        font-size: 1rem;
    }
}
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-container">
        <!-- قسم الفورم (يمين الشاشة) -->
        <div class="login-form">
            <h2>تسجيل الدخول</h2>
            <p class="text-muted mb-4">أهلاً بك مجدداً! أدخل بياناتك للمتابعة.</p>
            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">كلمة السر</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn-submit">تسجيل الدخول</button>
            </form>
            <div class="text-center mt-3">
                <a href="forgot_password.php">هل نسيت كلمة السر؟</a>
            </div>
            <hr class="my-4">
            <p class="text-center">لا يوجد لديك حساب؟ <a href="register.php">أنشئ حساباً جديداً الآن</a></p>
        </div>
        <!-- قسم الصورة (يسار الشاشة) -->
        <div class="login-graphic">
            <h1>تسجيل الدخول</h1>
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/login-3305943-2757111.png" alt="Login Graphic">
        </div>
    </div>
</div>
</body>
</html>