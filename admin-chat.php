<?php
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit;
}

require 'config/db.php';

// جلب الرسائل
$stmt = $pdo->query("SELECT * FROM chat_messages ORDER BY created_at ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>نظام الدردشة - لوحة الدعم</title>
    <style>
        body { font-family: 'Cairo', sans-serif; padding: 20px; }
        .message { margin: 10px 0; padding: 10px; border-radius: 8px; max-width: 70%; }
        .user { background: #f1f1f1; }
        .admin { background: #d1f7d1; }
        #chat-box { height: 400px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
        form { display: flex; gap: 10px; }
    </style>
</head>
<body>
    <h2>الدردشة الحية</h2>
    <div id="chat-box">
        <?php foreach ($messages as $msg): ?>
            <div class="message <?= $msg['is_admin_reply'] ? 'admin' : 'user' ?>">
                <strong><?= htmlspecialchars($msg['username']) ?>:</strong><br>
                <?= htmlspecialchars($msg['message']) ?><br>
                <small><?= $msg['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>

    <form id="admin-reply-form">
        <input type="text" id="admin-message" placeholder="اكتب ردك هنا..." style="flex: 1; padding: 8px;" required>
        <button type="submit" style="padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px;">إرسال</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>
    <script>
    $(document).ready(function () {
        $('#admin-reply-form').on('submit', function (e) {
            e.preventDefault();
            const message = $('#admin-message').val().trim();
            if (!message) return;

            $.post("chat.php", {
                message: message,
                userId: null,
                username: "الدعم الفني",
                is_admin_reply: 1
            }, function (response) {
                if (response.status === 'success') {
                    $('#admin-message').val('');
                    loadMessages();
                }
            }, 'json');
        });

        function loadMessages() {
            $.get("get_messages.php", function (data) {
                $('#chat-box').empty();
                data.forEach(function (msg) {
                    const className = msg.is_admin_reply ? 'admin' : 'user';
                    $('#chat-box').append(`
                        <div class="message ${className}">
                            <strong>${msg.username}:</strong><br>
                            ${msg.message}<br>
                            <small>${msg.created_at}</small>
                        </div>
                    `);
                });
            }, 'json');
        }

        // تحديث الرسائل كل 5 ثواني
        setInterval(loadMessages, 5000);
    });
    </script>
</body>
</html>