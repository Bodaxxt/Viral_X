<?php  
// ملف: app/helpers/user.php (النسخة النهائية الصحيحة لـ PDO)
function getUser($username, $conn){
   $sql = "SELECT * FROM users WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$username]);

   if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
        if (isset($user['id']) && !isset($user['user_id'])) {
            $user['user_id'] = $user['id'];
        }
        return $user;
   } else {
        return [];
   }
}
