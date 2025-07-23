<?php
session_start();
require 'config/db.php'; // تأكد من صحة هذا المسار

$login_message = '';
$login_message_type = 'danger';

$register_message = '';
$register_message_type = 'danger';

// عرض رسالة النجاح بعد إنشاء الحساب
if (isset($_SESSION['success_message'])) {
    $login_message = $_SESSION['success_message'];
    $login_message_type = 'success';
    unset($_SESSION['success_message']);
}

// ========================================
// === معالجة طلب تسجيل الدخول (Login) ===
// ========================================
if (isset($_POST['login_submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $admin_email = 'admin@admin.com';
    $admin_password = 'admin123';

    if (!empty($email) && !empty($password)) {
        if ($email === $admin_email && $password === $admin_password) {
            $_SESSION['user_id'] = 0;
            $_SESSION['username'] = 'Admin';
            $_SESSION['role'] = 'admin';
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'] ?? 'user';
                header("Location: index.php");
                exit;
            } else {
                $login_message = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
            }
        }
    } else {
        $login_message = 'الرجاء ملء جميع الحقول.';
    }
}

// ===========================================
// === معالجة طلب إنشاء حساب (Register) ===
// ===========================================
if (isset($_POST['register_submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (strlen($password) < 8) {
            $register_message = 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.';
        } else {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->rowCount() > 0) {
                $register_message = 'اسم المستخدم أو البريد الإلكتروني مسجل بالفعل!';
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$username, $email, $hashed_password])) {
                    $_SESSION['success_message'] = "تم إنشاء حسابك بنجاح! يمكنك الآن تسجيل الدخول.";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    $register_message = 'حدث خطأ غير متوقع أثناء التسجيل.';
                }
            }
        }
    } else {
        $register_message = 'الرجاء ملء جميع الحقول المطلوبة.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول / إنشاء حساب</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-reboot.min.css">
    <style>
        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Cairo', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }
        
        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }
        
        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            direction: rtl; /* For Arabic input */
        }
        
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }
        
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        
        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }
        
        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }
        
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }
        
        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        
        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        
        .overlay-left {
            transform: translateX(-20%);
        }
        
        .overlay-right {
            right: 0;
            transform: translateX(0);
        }
        
        /* التحريك */
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }
        
        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }
        
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }
        
        @keyframes show {
            0%, 49.99% {
                opacity: 0;
                z-index: 1;
            }
            50%, 100% {
                opacity: 1;
                z-index: 5;
            }
        }
        
        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }
        
        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }
        
        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
    </style>
</head>
<body>

<div class="container <?php if(!empty($register_message)) echo 'right-panel-active'; ?>" id="container">
	<!-- فورم إنشاء حساب -->
	<div class="form-container sign-up-container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1>إنشاء حساب</h1>
			<?php if(!empty($register_message)): ?>
                <div class="alert alert-danger p-2 mt-3"><?php echo $register_message; ?></div>
            <?php endif; ?>
			<input type="text" name="username" placeholder="اسم المستخدم" required />
			<input type="email" name="email" placeholder="البريد الإلكتروني" required />
			<input type="password" name="password" placeholder="كلمة المرور" required />
			<button type="submit" name="register_submit">إنشاء حساب</button>
		</form>
	</div>
	<!-- فورم تسجيل الدخول -->
	<div class="form-container sign-in-container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<h1>تسجيل الدخول</h1>
            <?php if(!empty($login_message)): ?>
                <div class="alert alert-<?php echo $login_message_type; ?> p-2 mt-3"><?php echo $login_message; ?></div>
            <?php endif; ?>
			<input type="email" name="email" placeholder="البريد الإلكتروني" required />
			<input type="password" name="password" placeholder="كلمة المرور" required />
			<a href="#">هل نسيت كلمة المرور؟</a>
			<button type="submit" name="login_submit">تسجيل الدخول</button>
		</form>
	</div>
	<!-- اللوحة المتحركة -->
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>أهلاً بعودتك!</h1>
				<p>للبقاء على تواصل معنا، الرجاء تسجيل الدخول بمعلوماتك الشخصية</p>
				<button class="ghost" id="signIn">تسجيل الدخول</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>مرحباً بك!</h1>
				<p>أدخل بياناتك الشخصية وابدأ رحلتك معنا</p>
				<button class="ghost" id="signUp">إنشاء حساب</button>
			</div>
		</div>
	</div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</body>
</html>