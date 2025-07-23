<?php
// ابدأ الجلسة للوصول إلى بيانات المستخدم
session_start();
// استدعاء ملف الاتصال بقاعدة البيانات
require 'config/db.php'; // تأكد من أن المسار صحيح

// الخطوة 1: التأكد من أن المستخدم مسجل دخوله
// إذا لم يكن مسجلاً، لا تفعل شيئًا وأعده للصفحة الرئيسية
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// الخطوة 2: التأكد من أن الطلب هو POST (تم إرسال الفورم)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // استقبال البيانات بأمان
    // الاسم والإيميل نأخذهم من السيشن مباشرة لضمان الأمان
    $name    = $_SESSION['username']; 
    $email   = $_SESSION['email'] ?? 'email not set'; // تأكد من وجود الإيميل في السيشن
    
    // الموضوع والرسالة نأخذهم من الفورم
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // التحقق من أن الحقول المطلوبة ليست فارغة
    if (empty($subject) || empty($message)) {
        // إذا كانت فارغة، أعد المستخدم للصفحة الرئيسية مع رسالة خطأ
        header('Location: index.php?status=error');
        exit;
    }

    // الخطوة 3: حفظ الرسالة في قاعدة البيانات
    try {
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // تنفيذ الإدخال
        $stmt->execute([$name, $email, $subject, $message]);
        
        // إذا نجح الحفظ، أعد المستخدم للصفحة الرئيسية مع رسالة نجاح
        header('Location: index.php?status=success');
        exit;

    } catch (PDOException $e) {
        // في حال حدوث خطأ في قاعدة البيانات، أعد المستخدم مع رسالة خطأ
        // يمكنك تسجيل الخطأ الفعلي للمطورين: error_log($e->getMessage());
        header('Location: index.php?status=dberror');
        exit;
    }
} else {
    // إذا حاول شخص الوصول للملف مباشرة (وليس عبر الفورم)، أعده للصفحة الرئيسية
    header('Location: index.php');
    exit;
}
?>```

---

### الخطوة الثانية: تعديل الفورم في ملف `index.php`

الآن، اذهب إلى ملف `index.php` وقم بتعديل سطر واحد فقط في كود الفورم.

**الكود قبل التعديل (الخاطئ):**
```html
<form id="contact-form" action="admin/dashboard.php" method="post" ...>