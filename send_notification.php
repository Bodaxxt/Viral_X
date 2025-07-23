<?php
function send_notification($recipient, $type, $payment_id, $message = '') {
    global $conn;
    
    // 1. تحديد نوع المستلم
    $user_type = '';
    $user_id = 0;
    
    if ($recipient === 'assistant' || $recipient === 'admin') {
        $user_type = $recipient;
    } else {
        $user_type = 'user';
        $user_id = (int)$recipient;
    }
    
    // 2. حفظ الإشعار في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO notifications (
        user_type,
        user_id,
        payment_id,
        notification_type,
        message,
        is_read,
        created_at
    ) VALUES (?, ?, ?, ?, ?, 0, NOW())");
    
    $stmt->bind_param("siiss", $user_type, $user_id, $payment_id, $type, $message);
    $stmt->execute();
    
    // 3. إرسال إيميل (اختياري)
    send_email_notification($recipient, $type, $payment_id, $message);
    
    // 4. إرسال إشعار فوري (إذا كان المستخدم متصلاً)
    send_real_time_notification($recipient, $message);
}

function send_email_notification($recipient, $type, $payment_id, $message) {
    // تنفيذ إرسال الإيميل هنا
    // يمكن استخدام PHPMailer أو أي مكتبة أخرى
}

function send_real_time_notification($recipient, $message) {
    // تنفيذ إشعارات فورية عبر WebSocket أو Firebase
}
?>