<?php
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = htmlspecialchars($_GET['token']);

    try {
        $sql = "SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token]);
        $reset_request = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reset_request) {
            $email = $reset_request['email'];
            // عرض نموذج لتغيير كلمة المرور
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>إعادة تعيين كلمة المرور</title>
                <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
                <style>
                    body {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        min-height: 100vh;
                        background-color: #f8f9fa;
                        font-family: 'Cairo', sans-serif;
                    }

                    .form-container {
                        max-width: 500px;
                        width: 100%;
                        padding: 40px;
                        background: #fff;
                        border-radius: 15px;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    }

                    .form-container h2 {
                        font-weight: 700;
                        color: #343a40;
                    }

                    .btn-primary {
                        background-color: #f35525;
                        border-color: #f35525;
                        padding: 10px;
                        font-weight: bold;
                        transition: all 0.3s;
                    }

                    .btn-primary:hover {
                        background-color: #e04a1a;
                        border-color: #e04a1a;
                        transform: translateY(-2px);
                    }

                    .alert {
                        font-size: 0.95rem;
                        word-wrap: break-word;
                    }
                </style>
            </head>
            <body>
            <div class="form-container text-center">
                <h2 class="mb-3">إعادة تعيين كلمة المرور</h2>
                <form method="post" action="reset_password_process.php">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="mb-3 text-end">
                        <label for="new_password" class="form-label fw-bold">كلمة المرور الجديدة:</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3 text-end">
                        <label for="confirm_password" class="form-label fw-bold">تأكيد كلمة المرور الجديدة:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">تغيير كلمة المرور</button>
                </form>
            </div>
            </body>
            </html>
            <?php
        } else {
            echo "<div class='alert alert-danger'>الرمز المميز غير صالح أو انتهت صلاحيته.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>حدث خطأ في قاعدة البيانات: " . $e->getMessage() . "</div>";
    }
    $pdo = null;
} else {
    echo "<div class='alert alert-danger'>لم يتم العثور على رمز مميز صالح.</div>";
}
?>