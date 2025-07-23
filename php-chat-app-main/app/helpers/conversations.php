<?php 
// ملف: app/helpers/conversations.php (النسخة النهائية لمنع التكرار)

function getConversation($user_id, $conn){
    /**
      Getting all the conversations 
      for current (logged in) user
    **/

    // ✅ [التعديل هنا] استعلام SQL جديد ومحسن
    // هذا الاستعلام سيقوم بتجميع المحادثات وعرض كل مستخدم مرة واحدة فقط
    $sql = "SELECT
                -- اختر المستخدم الآخر في المحادثة
                IF(c.user_1 = ?, c.user_2, c.user_1) AS other_user_id,
                -- جلب آخر وقت للمحادثة للترتيب
                MAX(ch.created_at) AS last_chat_time
            FROM conversations c
            JOIN chats ch ON 
                (ch.from_id = c.user_1 AND ch.to_id = c.user_2) OR 
                (ch.from_id = c.user_2 AND ch.to_id = c.user_1)
            WHERE c.user_1 = ? OR c.user_2 = ?
            GROUP BY other_user_id
            ORDER BY last_chat_time DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $user_id, $user_id]);

    if($stmt->rowCount() > 0){
        $conversations = $stmt->fetchAll();
        $user_data = [];
        
        # الآن، لكل مستخدم فريد، نجلب بياناته
        foreach($conversations as $conversation){
            $sql2  = "SELECT * FROM users WHERE id=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$conversation['other_user_id']]);
            
            if ($stmt2->rowCount() > 0) {
                $userData = $stmt2->fetch();
                // إضافة 'user_id' لضمان التوافق
                if(isset($userData['id']) && !isset($userData['user_id'])){
                    $userData['user_id'] = $userData['id'];
                }
                array_push($user_data, $userData);
            }
        }
        return $user_data;
    } else {
    	return [];
    }  
}
