<?php
// ملف: login.php (النسخة النهائية الموحدة التي تستخدم PDO)
session_start();

// ✅ 1. استخدام ملف الاتصال الصحيح (PDO)
require 'app/db.conn.php'; 

$message = '';
$message_type = 'danger';

if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    $message_type = 'success';
    unset($_SESSION['success_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (!empty($email) && !empty($password)) {
        // ✅ 2. البحث عن المستخدم باستخدام PDO
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();

            if (password_verify($password, $user['password'])) {
                // ✅ 3. الأهم: تخزين 'id' الرقمي الصحيح في الجلسة
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                // توجيه المستخدم بناءً على دوره
                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard.php");
                } elseif ($user['role'] === 'assistant') {
                    header("Location: home.php"); 
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $message = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
            }
        } else {
            $message = 'البريد الإلكتروني أو كلمة المرور غير صحيحة.';
        }
    } else {
        $message = 'الرجاء ملء جميع الحقول.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Sign Up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="app/http/signup.php"
	 	      enctype="multipart/form-data">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png" 
	 		     class="w-25">
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Sign Up</h3>   
	 		</div>

	 		<?php if (isset($_GET['error'])) { ?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']);?>
			</div>
			<?php } 
              
              if (isset($_GET['name'])) {
              	$name = $_GET['name'];
              }else $name = '';

              if (isset($_GET['username'])) {
              	$username = $_GET['username'];
              }else $username = '';
			?>

	 	  <div class="mb-3">
		    <label class="form-label">
		           Name</label>
		    <input type="text"
		           name="name"
		           value="<?=$name?>" 
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           User name</label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$username?>" 
		           name="username">
		  </div>


		  <div class="mb-3">
		    <label class="form-label">
		           Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Profile Picture</label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button type="submit" 
		          class="btn btn-primary">
		          Sign Up</button>
		  <a href="index.php">Login</a>
		</form>
	 </div>
</body>
</html>
<?php
  }else{
  	header("Location: home.php");
   	exit;
  }
 ?>