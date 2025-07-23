<?php
session_start();
require 'config/db.php';

// التحقق من تسجيل دخول المساعد
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'assistant') {
    header("Location: admin/login.php?error=You must log in as an assistant.");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id']) && isset($_POST['reply'])) {
    $messageId = htmlspecialchars($_POST['message_id']);
    $reply = htmlspecialchars($_POST['reply']);

    try {
        $sql = "INSERT INTO chat_messages (user_id, username, message, is_admin_reply) VALUES (NULL, ?, ?, 1)";
        $stmt = $pdo->prepare($sql);
        // **تنبيه:** لا يوجد هنا user_id  لذا قم  بتعديل هذا  في حال رغبت  بربط الرد ب مستخدم
        $stmt->execute([$_SESSION['admin_username'], $reply]); // تم  الإفتراض ب وجود اسم  مستخدم الأدمن بال سيشن

         // احصل على مُعرّف آخر رسالة مُضافة
          $lastInsertId = $pdo->lastInsertId();
          // احصل على معلومات الرسالة المضافة حديثًا
        /*  $sql = "SELECT * FROM chat_messages WHERE id = ?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$lastInsertId]);
          $newMessage = $stmt->fetch(PDO::FETCH_ASSOC);*/
          $httpReferer = $_SERVER['HTTP_REFERER'] ?? 'admin_login.php' ;
        header("Location: $httpReferer");  
        exit();

    } catch (PDOException $e) {
        error_log("send_assistant_message.php: Database error: " . $e->getMessage());
        die("حدث خطأ في قاعدة البيانات.");
    }

} else {
    //  العودة  الي  الصفحة  السابقه ادا لم تكن الشروط  متحققه 
     $httpReferer = $_SERVER['HTTP_REFERER'] ?? 'admin_login.php' ;
        header("Location: $httpReferer");  
        exit();
}
$pdo = null;
?>