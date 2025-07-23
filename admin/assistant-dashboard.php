<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'assistant') {
    header("Location: ../login.php");
    exit;
}

require '../config/db.php';

// =========================================================================
// الجزء الأول: جلب البيانات (لم يتغير + إضافة)
// =========================================================================

// 1. جلب طلبات الدفع التي تحتاج مراجعة (الكود الأصلي الخاص بك، لم يتغير)
$payments = $conn->query("
    SELECT p.*, u.username 
    FROM payments p
    JOIN users u ON p.user_id = u.id
    WHERE p.status = 'pending'
    ORDER BY p.created_at DESC
");

// 2. ✅ (إضافة جديدة) جلب جميع محادثات الشات المفتوحة
$threads_query = $conn->query("
    SELECT t.id, t.user_id, u.username,
           (SELECT m.message FROM chat_messages m WHERE m.thread_id = t.id ORDER BY m.created_at DESC LIMIT 1) as last_message,
           (SELECT m.created_at FROM chat_messages m WHERE m.thread_id = t.id ORDER BY m.created_at DESC LIMIT 1) as last_message_time
    FROM chat_threads t
    JOIN users u ON t.user_id = u.id
    WHERE t.assistant_deleted = FALSE AND t.status = 'open'
    ORDER BY t.updated_at DESC
");
$chat_threads = $threads_query->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المساعد</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
        .payment-card { border: 1px solid #ddd; border-radius: 10px; padding: 15px; margin-bottom: 20px; background: #f9f9f9; }
        .payment-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee; }
        .payment-details { margin-bottom: 15px; }
        .payment-image { max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px; }
        .action-buttons { display: flex; gap: 10px; }
        .tab-content { padding: 20px 0; }
        
        /* ✅ (إضافة جديدة) تنسيقات الشات */
        .msg-user { text-align: right; margin-bottom: 10px; }
        .msg-user .msg-content { background-color: #0d6efd; color: white; border-radius: 10px; padding: 8px 12px; display: inline-block; max-width: 80%; }
        .msg-assistant { text-align: left; margin-bottom: 10px; }
        .msg-assistant .msg-content { background-color: #e9ecef; color: #333; border-radius: 10px; padding: 8px 12px; display: inline-block; max-width: 80%; }
        .list-group-item.active { z-index: 2; color: #fff; background-color: #f35525; border-color: #f35525; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>لوحة تحكم المساعد</h3>
            <a href="../logout.php" class="btn btn-outline-danger">تسجيل الخروج</a>
        </div>
        
        <ul class="nav nav-tabs" id="assistantTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="payments-tab" data-bs-toggle="tab" href="#payments" role="tab">طلبات الدفع</a>
            </li>
            <li class="nav-item" role="presentation">
                <!-- ✅ 2. هذا هو التعديل الأهم: تحويل التبويب إلى رابط مباشر -->
            <!-- استبدل المسار المطلق بمسار نسبي -->
            <a class="nav-link" href="../php-chat-app-main/home.php">الدردشة</a>
            </li>
        </ul>
        
        <div class="tab-content" id="assistantTabsContent">
            <!-- قسم طلبات الدفع (الكود الأصلي الخاص بك، لم يتغير) -->
            <div class="tab-pane fade show active" id="payments" role="tabpanel">
                <h5 class="mb-4">طلبات الدفع تحتاج مراجعة</h5>
                <?php
                if ($payments->num_rows > 0):
                    while($payment = $payments->fetch_assoc()):
                ?>
                    <div class="payment-card">
                        <div class="payment-header">
                            <div>
                                <strong>المستخدم:</strong> <?= htmlspecialchars($payment['username']) ?>
                                <span class="badge bg-secondary ms-2">#<?= $payment['user_id'] ?></span>
                            </div>
                            <div>
                                <span class="badge bg-warning text-dark">بانتظار المراجعة</span>
                            </div>
                        </div>
                        <div class="payment-details row">
                            <div class="col-md-8">
                                <p><strong>الباقة:</strong> <?= htmlspecialchars($payment['package']) ?></p>
                                <p><strong>المبلغ المتوقع:</strong> <?= number_format($payment['expected_amount'], 2) ?> جنيه</p>
                                <p><strong>المبلغ المدفوع:</strong> <?= number_format($payment['paid_amount'], 2) ?> جنيه</p>
                                <p><strong>رقم العملية:</strong> <?= htmlspecialchars($payment['transaction_id']) ?></p>
                                <p><strong>تاريخ الطلب:</strong> <?= htmlspecialchars($payment['created_at']) ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <?php if (!empty($payment['screenshot_path'])): ?>
                                    <a href="../<?= htmlspecialchars($payment['screenshot_path']) ?>" target="_blank">
                                        <img src="../<?= htmlspecialchars($payment['screenshot_path']) ?>" class="payment-image mb-2" alt="صورة التحويل" />
                                    </a>
                                    <div><small>اضغط على الصورة للتكبير</small></div>
                                <?php else: ?>
                                    <span class="text-muted">لا توجد صورة تحويل</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="action-buttons mt-3">
                            <button class="btn btn-success btn-approve-payment" data-id="<?= $payment['id'] ?>">موافقة</button>
                            <button class="btn btn-danger btn-reject-payment" data-id="<?= $payment['id'] ?>">رفض</button>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">لا توجد طلبات دفع تحتاج مراجعة حالياً</div>
                <?php endif; ?>
            </div>
            
            <!-- ✅ (تعديل) قسم الدردشة (تم ملؤه بالواجهة الجديدة) -->
            <div class="tab-pane fade" id="chat" role="tabpanel">
                <div class="row">
                    <!-- قائمة المحادثات -->
                    <div class="col-md-4">
                        <h5 class="mb-3">المحادثات</h5>
                        <div class="list-group">
                            <?php if (!empty($chat_threads)): ?>
                                <?php foreach($chat_threads as $thread): ?>
                                    <a href="#" class="list-group-item list-group-item-action chat-thread-item" data-thread-id="<?= $thread['id'] ?>">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">محادثة مع: <?= htmlspecialchars($thread['username']) ?></h6>
                                            <small><?= date('H:i', strtotime($thread['last_message_time'])) ?></small>
                                        </div>
                                        <p class="mb-1 text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($thread['last_message'] ?? '...') ?></p>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-light">لا توجد محادثات نشطة.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- نافذة عرض الرسائل -->
                    <div class="col-md-8">
                        <h5 class="mb-3">الرسائل</h5>
                        <div id="assistant-chat-window" style="height: 400px; border: 1px solid #ddd; border-radius: 5px; padding: 15px; overflow-y: auto; background: #f9f9f9;">
                            <p class="text-center text-muted mt-5">الرجاء اختيار محادثة من القائمة لعرض الرسائل.</p>
                        </div>
                        <div class="mt-3">
                            <form id="assistant-chat-form" style="display: none;">
                                <input type="hidden" name="thread_id" id="assistant-thread-id">
                                <textarea name="message" class="form-control" rows="3" placeholder="اكتب ردك..." required></textarea>
                                <button type="submit" class="btn btn-primary mt-2 w-100">إرسال الرد</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    // ✅ (تعديل) كود JavaScript الجديد الخاص بالشات
    $(document).ready(function() {
        let currentThreadId = null;
        let assistantChatInterval;

        // عند الضغط على محادثة من القائمة
        $('.chat-thread-item').on('click', function(e) {
            e.preventDefault();
            currentThreadId = $(this).data('thread-id');
            
            $('.chat-thread-item').removeClass('active');
            $(this).addClass('active');

            $('#assistant-thread-id').val(currentThreadId);
            $('#assistant-chat-form').slideDown(200);
            
            loadAssistantMessages();
            
            // بدء التحديث التلقائي للمحادثة المفتوحة
            clearInterval(assistantChatInterval);
            assistantChatInterval = setInterval(loadAssistantMessages, 3000); // تحديث كل 3 ثواني
        });

        // إرسال الرسالة من المساعد
        $('#assistant-chat-form').on('submit', function(e) {
            e.preventDefault();
            const message = $(this).find('textarea').val().trim();
            if (message && currentThreadId) {
                // نستخدم مسار ../ للوصول للملف في الجذر
                $.post('../chat_handler.php?action=sendMessage', $(this).serialize(), function(response) {
                    if (response.status === 'success') {
                        $('#assistant-chat-form').find('textarea').val('');
                        loadAssistantMessages();
                    }
                }, 'json');
            }
        });
        
        $('#assistant-chat-form').find('textarea').on('keyup', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                $('#assistant-chat-form').submit();
            }
        });

        // دالة لجلب وعرض رسائل المحادثة المحددة
        function loadAssistantMessages() {
            if (!currentThreadId) return;

            $.post('../chat_handler.php?action=getMessages', { thread_id: currentThreadId }, function(response) {
                const chatWindow = $('#assistant-chat-window');
                chatWindow.html(''); // مسح الرسائل القديمة
                if (response.status === 'success' && response.messages.length > 0) {
                    response.messages.forEach(msg => {
                        const messageClass = (msg.sender_role === 'assistant') ? 'msg-user' : 'msg-assistant';
                        const messageDiv = $(`<div class="${messageClass}"><div class="msg-content"></div></div>`);
                        messageDiv.find('.msg-content').text(msg.message);
                        chatWindow.append(messageDiv);
                    });
                    chatWindow.scrollTop(chatWindow.prop("scrollHeight"));
                } else {
                    chatWindow.html('<p class="text-center text-muted mt-5">لا توجد رسائل في هذه المحادثة بعد.</p>');
                }
            }, 'json');
        }
    });
    // كود تغيير حالة الدفع
    $(document).on('click', '.btn-approve-payment, .btn-reject-payment', function() {
        var btn = $(this);
        var paymentId = btn.data('id');
        var action = btn.hasClass('btn-approve-payment') ? 'approve' : 'reject';
        btn.prop('disabled', true);
        btn.closest('.payment-card').css('opacity', '0.6');
        $.post('process_payment_action.php', { payment_id: paymentId, action: action }, function(response) {
            if (response.status === 'success') {
                // إذا تم القبول أو الرفض، احذف البطاقة من الواجهة
                btn.closest('.payment-card').slideUp(300, function() { $(this).remove(); });
            } else {
                alert(response.message || 'حدث خطأ!');
                btn.prop('disabled', false);
                btn.closest('.payment-card').css('opacity', '1');
            }
        }, 'json').fail(function() {
            alert('تعذر الاتصال بالخادم!');
            btn.prop('disabled', false);
            btn.closest('.payment-card').css('opacity', '1');
        });
    });
    </script>
</body>
</html>