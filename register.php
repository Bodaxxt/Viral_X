<?php
// ملف: register.php (النسخة المصححة والموحدة)
session_start();
require 'config/db.php'; // يستخدم متغير $conn

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // ✅ 1. إضافة عمود `name` الجديد إلى البيانات
    // سنجعل الاسم هو نفسه اسم المستخدم عند التسجيل
    $name = $username; 

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (strlen($password) < 8) {
            $message = 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.';
        } else {
            // التحقق من أن المستخدم غير موجود باستخدام MySQLi
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $message = 'اسم المستخدم أو البريد الإلكتروني مسجل بالفعل!';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // ✅ 2. تحديث جملة INSERT لتشمل عمود `name`
                $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                // لاحظ أننا نمرر 4 متغيرات الآن (sssS)
                $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    $_SESSION['success_message'] = "تم إنشاء حسابك بنجاح! يمكنك الآن تسجيل الدخول.";
                    header("Location: login.php");
                    exit;
                } else {
                    $message = 'حدث خطأ غير متوقع أثناء التسجيل.';
                }
            }
        }
    } else {
        $message = 'الرجاء ملء جميع الحقول المطلوبة.';
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>إنشاء حساب جديد</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0; /* إزالة الهوامش الافتراضية */
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            height: 100vh; /* جعل ارتفاع الحاوية يملأ الشاشة */
            background: #fff;
            /* تم إزالة الخصائص التي تجعله صندوقًا صغيرًا */
        }

        .register-form-section, .register-graphic-section {
            flex: 1; /* هذه الخاصية تجعل كل قسم يأخذ نصف المساحة */
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center; /* للتوسيط الرأسي للمحتوى داخل كل قسم */
        }

        .register-graphic-section {
            background-color: #d4edda;
            align-items: center;
            color: #155724;
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path d="M50 8.31L56.34 23.04 74.51 25.49 60.92 38.62 64.29 56.96 50 48.97 35.71 56.96 39.08 38.62 25.49 25.49 43.66 23.04 50 8.31z" fill-opacity=".05" fill="%23155724"/></svg>');
        }
        
        .register-graphic-section h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .register-graphic-section img {
            max-width: 80%;
            margin-bottom: 20px;
        }
        
        .register-graphic-section p {
            font-size: 1.1rem;
            text-align: center;
            padding: 0 20px;
        }
        
        .register-form-section h2 {
            font-weight: 700;
            color: #0d4a1a;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding-right: 40px;
            height: 50px;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(21, 87, 36, 0.25);
            border-color: #155724;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 15px;
            color: #ccc;
        }

        .btn-submit {
            background: #28a745;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            color: #fff;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .btn-submit:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
        /* =============================================
   CSS جديد لجعل صفحة التسجيل متجاوبة
   ============================================= */

    /* تعديل ليناسب الشاشات الأصغر من التابلت */
    @media (max-width: 991px) {
        .register-wrapper {
            flex-direction: column; /* <-- 1. تغيير اتجاه العرض إلى رأسي */
            height: auto; /* <-- جعل الارتفاع تلقائيًا ليناسب المحتوى */
            min-height: 100vh;
        }

        .register-form-section, .register-graphic-section {
            flex: none; /* إلغاء خاصية المرونة */
            width: 100%; /* جعل كل قسم يأخذ العرض الكامل */
            padding: 40px 20px; /* تقليل المساحة الداخلية قليلاً */
        }

        .register-graphic-section {
            /* يمكنك إخفاء قسم الصورة تمامًا على الموبايل لتجربة أفضل */
            display: none; 
        }
    }

    /* تعديل إضافي للشاشات الصغيرة جدًا (الموبايل) */
    @media (max-width: 576px) {
        .register-form-section h2 {
            font-size: 1.8rem; /* تصغير حجم العنوان الرئيسي */
        }
        .btn-submit {
            font-size: 1rem;
        }
    }

    </style>
</head>
<body>

<div class="register-wrapper">
    <!-- قسم الصورة (اليمين) -->
    <div class="register-graphic-section">
         <img src="https://cdni.iconscout.com/illustration/premium/thumb/sign-up-8298289-6632427.png" alt="Register Graphic">
         <h1>انضم إلى عائلتنا</h1>
         <p>خطوة واحدة تفصلك عن استكشاف أفضل العقارات. سجل الآن وابدأ رحلتك!</p>
    </div>

    <!-- قسم الفورم (اليسار) -->
    <div class="register-form-section">
        <h2>إنشاء حساب جديد</h2>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="register.php" method="post">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" class="form-control" placeholder="اسم المستخدم" required>
            </div>
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" class="form-control" placeholder="البريد الإلكتروني" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
            </div>
            <button type="submit" class="btn-submit">تسجيل حساب</button>
        </form>
        <hr class="my-4">
        <p class="text-center">لديك حساب بالفعل؟ <a href="login.php">سجل الدخول من هنا</a></p>
    </div>
</div>

</body>
</html>