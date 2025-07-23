<?php 
  session_start();

  // 1. التأكد من أن المستخدم مسجل دخوله وأن لديه دور محدد
  if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
    
    // --- 2. التحقق من دور المستخدم وتوجيهه ---

    if ($_SESSION['role'] === 'user') {
        header("Location: chat.php?user=assistant");
        exit;
    } 
    elseif ($_SESSION['role'] === 'assistant') {
        // إذا كان المستخدم "assistant"، استمر في تحميل هذه الصفحة
    } 
    else {
        header("Location: index.php");
        exit;
    }

  	// --- 3. هذا الكود سيتم تنفيذه فقط إذا كان الدور هو "assistant" ---

  	# database connection file (يستخدم PDO)
  	include 'app/db.conn.php'; 

  	include 'app/helpers/user.php';
  	include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

  	# جلب بيانات المساعد (المستخدم المسجل دخوله حاليًا)
  	$user = getUser($_SESSION['username'], $conn);

  	# جلب كل المحادثات الخاصة بالمساعد
  	$conversations = getConversation($user['user_id'], $conn);

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>لوحة تحكم الدردشة</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="p-2 w-400 rounded shadow">
    	<div>
    		<div class="d-flex mb-3 p-3 bg-light justify-content-between align-items-center">
    			<div class="d-flex align-items-center">
    			    <img src="uploads/<?=$user['p_p']?>" class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2"><?=$user['name']?> (مساعد)</h3> 
    			</div>
    			<a href="..\admin\assistant-dashboard.php" class="btn btn-dark"> الخروج</a>
    		</div>

    		<div class="input-group mb-3">
    			<input type="text" placeholder="ابحث..." id="searchText" class="form-control">
    			<button class="btn btn-primary" id="serachBtn"><i class="fa fa-search"></i></button>       
    		</div>
    		<ul id="chatList" class="list-group mvh-50 overflow-auto">
    			<?php if (!empty($conversations)): ?>
    			    <?php foreach ($conversations as $conversation): ?>
	    			<li class="list-group-item">
	    				<a href="chat.php?user=<?=$conversation['username']?>" class="d-flex justify-content-between align-items-center p-2">
	    					<div class="d-flex align-items-center">
	    					    <img src="uploads/<?=$conversation['p_p']?>" class="w-10 rounded-circle">
	    					    <h3 class="fs-xs m-2">
	    					    	<?=$conversation['name']?><br>
                                    <small>
                                        <?php 
                                            // ✅ [تصحيح هنا] استخدام user_id الموحد
											// ✅ [تصحيح هنا] استخدام 'id' بدلاً من 'user_id' للمستخدم الآخر
											echo lastChat($user['user_id'], $conversation['id'], $conn);                                        ?>
                                    </small>
	    					    </h3>            	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online"><div class="online"></div></div>
	    					<?php } ?>
	    				</a>
	    			</li>
    			    <?php endforeach; ?>
    			<?php else: ?>
    				<div class="alert alert-info text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       لا توجد محادثات حتى الآن.
					</div>
    			<?php endif; ?>
    		</ul>
    	</div>
    </div>
	  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
      // كود JavaScript الأصلي الخاص بالبحث وتحديث last_seen (يعمل كما هو)
      $("#searchText").on("input", function(){
       	 var searchText = $(this).val();
         if(searchText == "") return;
         $.post('app/ajax/search.php', { key: searchText }, function(data, status){ $("#chatList").html(data); });
      });
      $("#serachBtn").on("click", function(){
       	 var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('app/ajax/search.php', { key: searchText }, function(data, status){ $("#chatList").html(data); });
      });
      let lastSeenUpdate = function(){ $.get("app/ajax/update_last_seen.php"); }
      lastSeenUpdate();
      setInterval(lastSeenUpdate, 10000);
    });
</script>
</body>
</html>
<?php
  } else {
    // إذا لم يكن المستخدم مسجل دخوله أصلاً، وجهه لصفحة تسجيل الدخول
  	header("Location:  E:\xamppp\htdocs\templatemo_591_villa_agency\login.php");
   	exit;
  }
?>