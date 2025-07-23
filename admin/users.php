<?php  
// ملف: app/helpers/user.php (النسخة النهائية لـ PDO)
function getUser($username, $conn){
   $sql = "SELECT * FROM users WHERE username = ?";
   $stmt = $conn->prepare($sql);
   // PDO يمرر المتغيرات داخل execute
   $stmt->execute([$username]);

   // PDO يستخدم rowCount()
   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
     
     // ✅ توحيد اسم معرف المستخدم لضمان التوافق
     if (isset($user['id']) && !isset($user['user_id'])) {
         $user['user_id'] = $user['id'];
     }
   	 return $user;
   } else {
   	 return [];
   }
}
