<?php 
include 'session.php'; 
require 'config/db.php';

// جلب الخصومات من قاعدة البيانات
$discounts = [];
$discount_query = "SELECT * FROM discounts";
$discount_result = $conn->query($discount_query);
if ($discount_result && $discount_result->num_rows > 0) {
    while ($row = $discount_result->fetch_assoc()) {
        // مثال: bronze_3, silver_6, gold_12 ...
        $discounts[$row['package'].'_'.$row['months']] = $row['discount_value'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Viral-X - Details & Packages</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- ===================[ بداية كود CSS الخاص بالباقات ]=================== -->
    <style>
        .pricing-card{background:#fff;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,.07);padding:30px;text-align:center;transition:all .3s ease;height:100%;display:flex;flex-direction:column;position:relative;overflow:hidden}.pricing-card:hover{transform:translateY(-10px);box-shadow:0 15px 40px rgba(0,0,0,.1)}.pricing-card .header h3{font-size:1.2rem;font-weight:700;color:#1e1e1e;text-transform:uppercase;letter-spacing:1px;margin-bottom:20px}.pricing-card .price h2{font-size:3.5rem;font-weight:800;color:#8a2be2;margin-bottom:10px}.pricing-card .price span{font-size:1rem;font-weight:500;color:#888}.pricing-card .features{list-style:none;padding:0;margin:25px 0;text-align:left;flex-grow:1}.pricing-card .features li{font-size:1rem;color:#555;margin-bottom:15px;padding-bottom:15px;border-bottom:1px solid #eee;display:flex;align-items:center;gap:12px}.pricing-card .features li:last-child{border-bottom:none}.pricing-card .features li i{color:#8a2be2;font-size:1.2rem;width:25px;text-align:center}.pricing-card .pricing-footer .btn-outline-primary{border:2px solid #8a2be2;color:#8a2be2;border-radius:25px;padding:10px 30px;font-weight:600;text-decoration:none;transition:all .3s ease}.pricing-card .pricing-footer .btn-outline-primary:hover{background-color:#8a2be2;color:#fff}.pricing-card.highlight{transform:scale(1.05);border:2px solid #8a2be2}.pricing-card.highlight:hover{transform:scale(1.08)}.popular-badge{position:absolute;top:18px;right:-30px;background-color:#8a2be2;color:#fff;padding:5px 30px;font-size:.8rem;font-weight:700;transform:rotate(45deg);box-shadow:0 2px 5px rgba(0,0,0,.2)}@media (max-width:991px){.pricing-card.highlight{transform:scale(1)}}
        /* CSS الخاص بأزرار الدخول والخروج */
        .button2{display:inline-block;position:relative;transition:all .2s;color:#222;background:#fff;border:none;border-radius:15px;font-size:15px;font-weight:700;padding:.4em 1.2em;margin:0 6px;box-shadow:none;cursor:pointer;outline:0;z-index:1;letter-spacing:.5px;font-family:Poppins,Arial,sans-serif;display:inline-flex;align-items:center;justify-content:center;gap:6px}.user-display-style{min-width:100px;text-align:center;height:40px}.button2:hover{background:#8a2be2;color:#fff;transform:translateY(-2px) scale(1.04)}.auth-buttons-container{margin-left:auto;display:flex;align-items:center;height:40px;border-radius:0;padding:0;box-shadow:none;position:relative;top:0;justify-content:center;margin-top:-30px}.visitor-buttons{display:flex;align-items:center;justify-content:center;gap:8px;width:100%}.icon-wrapper{display:none!important}.auth-btn{background:0 0!important;box-shadow:none!important;padding:0!important;min-width:unset!important;height:auto!important}.user-display-style{cursor:default}.user-display-style:hover{background:#fff;color:#222;transform:none}@media (max-width:991px){.auth-buttons-container{height:auto;padding:0;border-radius:0;top:0;justify-content:center}.button2{font-size:13px;padding:.3em .8em;margin:0 3px}}
    </style>
    <!-- ===================[ نهاية كود CSS الخاص بالباقات ]=================== -->
</head>

<body>

  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner"><span class="dot"></span><div class="dots"><span></span><span></span><span></span></div></div>
  </div>

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> info@company.com</li>
            <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** بداية الهيدر الديناميكي ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                        <a href="index.php" class="logo">
                        <h1>Viral-X  ㅤ  ㅤ  ㅤ</h1>
                    </a>
                    <ul class="nav">
                          <li><a href="index.php">Home</a></li>
                          <li><a href="properties.php">Our Services</a></li> <!-- تعديل هنا -->
                          <li><a href="property-details.php"  class="active">Packages</a></li> <!-- تعديل هنا -->
                          <li><a href="contact.php">Contact Us</a></li>
                          <!-- ... باقي عناصر القائمة ... -->

                      <li class="auth-buttons-container">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="visitor-buttons">
                                <span class="button2 user-display-style"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                <a href="logout.php" class="auth-btn btn-logout"><button class="button2">Logout</button></a>
                            </div>
                        <?php else: ?>
                            <div class="visitor-buttons">
                                <a href="login.php" class="auth-btn btn-login"><button class="button2">Login</button></a>
                                <a href="register.php" class="auth-btn btn-register"><button class="button2">Register</button></a>
                            </div>
                        <?php endif; ?>
                      </li>
                    </ul>   
                    <a class='menu-trigger'><span>Menu</span></a>
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** نهاية الهيدر ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Packages</span>
                
<div class="title-with-offer">
  <h3>Our Service Packages</h3>
  <span class="offer-alert">
    <i class="fa-solid fa-fire"></i> Special Offers Inside!
  </span>
</div>

    
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['user_id']) && isset($conn)): ?>
<?php
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM payments WHERE user_id = ? ORDER BY created_at DESC");
    if ($stmt === false) {
        die("فشل إعداد الاستعلام: " . $conn->error);
    }
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
        die("فشل تنفيذ الاستعلام: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $user_payments = $result->fetch_all(MYSQLI_ASSOC);
?>
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4><i class="fas fa-history"></i> سجل طلباتي</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($user_payments)): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم الطلب</th>
                                <th>الباقة</th>
                                <th>المبلغ</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_payments as $p): ?>
                                <?php
                                $status = $p['status'];
                                $stat_txt = match($status) {
                                    'pending' => 'قيد المراجعة',
                                    'approved' => 'مقبول',
                                    'rejected' => 'مرفوض',
                                    default => 'غير معروف',
                                };
                                $stat_cls = match($status) {
                                    'pending' => 'badge bg-warning text-dark',
                                    'approved' => 'badge bg-success',
                                    'rejected' => 'badge bg-danger',
                                    default => 'badge bg-secondary',
                                };
                                ?>
                                <tr>
                                    <td>#<?= $p['id']; ?></td>
                                    <td><?= ucfirst(strtolower($p['package'])); ?></td>
                                    <td>$<?= $p['paid_amount']; ?></td>
                                    <td><?= date('Y-m-d', strtotime($p['created_at'])); ?></td>
                                    <td><span class="<?= $stat_cls; ?> p-2"><?= $stat_txt; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">ليس لديك أي طلبات سابقة.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

  <!-- ===================[ قسم الباقات المدمج ]=================== -->
  <div class="section packages-section" style="background-color: #f8f9fa; padding: 80px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading text-center">
                    <h2>| CHOOSE YOUR PLAN & SAVE BIG</h2>
                </div>
            </div>
        </div>
      <div class="row">
    <!-- الباقة البرونزية -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="pricing-card">
            <div class="header"><h3>BRONZE</h3></div>
            <div class="price"><h2>$199<span>/month</span></h2></div>
            <ul class="features">
                <li><i class="fa fa-pen-to-square"></i> <strong>8</strong> Social Media Posts</li>
                <li><i class="fa fa-video"></i> <strong>1</strong> High-Quality Reel</li>
                <li><i class="fa fa-bolt"></i> <strong>2</strong> Engaging Stories</li>
                
            </ul>
<!-- ==================== [ الكود الجديد للـ Footer الخاص بالباقات ] ==================== -->
<div class="pricing-footer" style="display: flex; flex-direction: column; gap: 10px;">
    <!-- زر انستا باي -->
    <!-- خيارات المدة والخصم للباقة البرونزية -->
    <?php 
        $bronze_price = 199;
        $bronze_discount_3 = isset($discounts['bronze_3']) ? $discounts['bronze_3'] : 0;
        $bronze_discount_6 = isset($discounts['bronze_6']) ? $discounts['bronze_6'] : 0;
        $bronze_discount_12 = isset($discounts['bronze_12']) ? $discounts['bronze_12'] : 0;
    ?>
    <!-- اختيار مدة الاشتراك مرة واحدة فقط -->
    <div class="mb-2">
        <select id="bronze-duration-select" class="modern-select mb-2">
            <option value="1">1 Month - $<?= $bronze_price; ?></option>
            <option value="3">3 Months - $<?= $bronze_price*3 - $bronze_discount_3; ?><?php if($bronze_discount_3): ?> (Save <?= round($bronze_discount_3/($bronze_price*3)*100); ?>%)<?php endif; ?></option>
            <option value="6">6 Months - $<?= $bronze_price*6 - $bronze_discount_6; ?><?php if($bronze_discount_6): ?> (Save <?= round($bronze_discount_6/($bronze_price*6)*100); ?>%)<?php endif; ?></option>
            <option value="12">12 Months - $<?= $bronze_price*12 - $bronze_discount_12; ?><?php if($bronze_discount_12): ?> (Save <?= round($bronze_discount_12/($bronze_price*12)*100); ?>%)<?php endif; ?></option>
        </select>
    </div>
    <form action="instapay.php" method="post" style="margin: 0;">
        <input type="hidden" name="package" value="BRONZE">
        <input type="hidden" name="duration" id="bronze-duration-instapay" value="1">
        <input type="hidden" name="package_price" id="bronze-price-instapay" value="<?= $bronze_price; ?>">
        <button type="submit" class="modern-btn">InstaPay</button>
    </form>
    <form action="start_paypal_payment.php" method="POST" style="margin: 0;">
        <input type="hidden" name="package" value="BRONZE">
        <input type="hidden" name="duration" id="bronze-duration-paypal" value="1">
        <input type="hidden" name="package_price" id="bronze-price-paypal" value="<?= $bronze_price; ?>">
        <button type="submit" class="modern-btn">PayPal</button>
    </form>
    <script>
    // عند تغيير المدة، يتم تحديث جميع فورمات الدفع وقيمة السعر
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('bronze-duration-select');
        var instapayInput = document.getElementById('bronze-duration-instapay');
        var paypalInput = document.getElementById('bronze-duration-paypal');
        var instapayPrice = document.getElementById('bronze-price-instapay');
        var paypalPrice = document.getElementById('bronze-price-paypal');
        // أسعار كل مدة
        var prices = {
            1: <?= $bronze_price; ?>,
            3: <?= $bronze_price*3 - $bronze_discount_3; ?>,
            6: <?= $bronze_price*6 - $bronze_discount_6; ?>,
            12: <?= $bronze_price*12 - $bronze_discount_12; ?>
        };
        select.addEventListener('change', function() {
            instapayInput.value = this.value;
            paypalInput.value = this.value;
            instapayPrice.value = prices[this.value];
            paypalPrice.value = prices[this.value];
        });
        // تأكد من ضبط السعر الافتراضي عند التحميل
        instapayPrice.value = prices[select.value];
        paypalPrice.value = prices[select.value];
    });
    </script>
</div>
<!-- ================================================================================= -->
        </div>
    </div>
    <!-- الباقة الفضية -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="pricing-card">
            <div class="header"><h3>SILVER</h3></div>
            <div class="price"><h2>$349<span>/month</span></h2></div>
            <ul class="features">
                <li><i class="fa fa-pen-to-square"></i> <strong>12</strong> Social Media Posts</li>
                <li><i class="fa fa-video"></i> <strong>2</strong> High-Quality Reels</li>
                <li><i class="fa fa-bolt"></i> <strong>8</strong> Engaging Stories</li>
                <li><i class="fa fa-chart-line"></i> Basic Performance Report</li>
                
            </ul>
<div class="pricing-footer" style="display: flex; flex-direction: column; gap: 10px;">

    <!-- خيارات المدة والخصم للباقة الفضية -->
    <?php 
        $silver_price = 349;
        $silver_discount_3 = isset($discounts['silver_3']) ? $discounts['silver_3'] : 0;
        $silver_discount_6 = isset($discounts['silver_6']) ? $discounts['silver_6'] : 0;
        $silver_discount_12 = isset($discounts['silver_12']) ? $discounts['silver_12'] : 0;
    ?>
    <div class="mb-2">
        <select id="silver-duration-select" class="modern-select mb-2">
            <option value="1">1 Month - $<?= $silver_price; ?></option>
            <option value="3">3 Months - $<?= $silver_price*3 - $silver_discount_3; ?><?php if($silver_discount_3): ?> (Save <?= round($silver_discount_3/($silver_price*3)*100); ?>%)<?php endif; ?></option>
            <option value="6">6 Months - $<?= $silver_price*6 - $silver_discount_6; ?><?php if($silver_discount_6): ?> (Save <?= round($silver_discount_6/($silver_price*6)*100); ?>%)<?php endif; ?></option>
            <option value="12">12 Months - $<?= $silver_price*12 - $silver_discount_12; ?><?php if($silver_discount_12): ?> (Save <?= round($silver_discount_12/($silver_price*12)*100); ?>%)<?php endif; ?></option>
        </select>
    </div>
    <form action="instapay.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="package" value="SILVER">
        <input type="hidden" name="duration" id="silver-duration-instapay" value="1">
        <input type="hidden" name="package_price" id="silver-price-instapay" value="<?= $silver_price; ?>">
        <button type="submit" class="modern-btn">Instapay</button>
    </form>
    <form action="start_paypal_payment.php" method="POST" style="margin: 0;">
        <input type="hidden" name="package" value="SILVER">
        <input type="hidden" name="duration" id="silver-duration-paypal" value="1">
        <input type="hidden" name="package_price" id="silver-price-paypal" value="<?= $silver_price; ?>">
        <button type="submit" class="modern-btn">PayPal</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('silver-duration-select');
        var instapayInput = document.getElementById('silver-duration-instapay');
        var paypalInput = document.getElementById('silver-duration-paypal');
        var instapayPrice = document.getElementById('silver-price-instapay');
        var paypalPrice = document.getElementById('silver-price-paypal');
        var prices = {
            1: <?= $silver_price; ?>,
            3: <?= $silver_price*3 - $silver_discount_3; ?>,
            6: <?= $silver_price*6 - $silver_discount_6; ?>,
            12: <?= $silver_price*12 - $silver_discount_12; ?>
        };
        select.addEventListener('change', function() {
            instapayInput.value = this.value;
            paypalInput.value = this.value;
            instapayPrice.value = prices[this.value];
            paypalPrice.value = prices[this.value];
        });
        instapayPrice.value = prices[select.value];
        paypalPrice.value = prices[select.value];
    });
    </script>
</div>

    


        </div>
    </div>
    <!-- الباقة الذهبية -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="pricing-card highlight">
            <div class="popular-badge">Most Popular</div>
            <div class="header"><h3>GOLD</h3></div>
            <div class="price"><h2>$499<span>/month</span></h2></div>
            <ul class="features">
                <li><i class="fa fa-pen-to-square"></i> <strong>18</strong> Social Media Posts</li>
                <li><i class="fa fa-video"></i> <strong>4</strong> High-Quality Reels</li>
                <li><i class="fa fa-bolt"></i> <strong>16</strong> Engaging Stories</li>
                <li><i class="fa fa-chart-line"></i> Detailed Performance Report</li>
                
            </ul>





<div class="pricing-footer" style="display: flex; flex-direction: column; gap: 10px;">
    <!-- خيارات المدة والخصم للباقة الذهبية -->
    <?php 
        $gold_price = 499;
        $gold_discount_3 = isset($discounts['gold_3']) ? $discounts['gold_3'] : 0;
        $gold_discount_6 = isset($discounts['gold_6']) ? $discounts['gold_6'] : 0;
        $gold_discount_12 = isset($discounts['gold_12']) ? $discounts['gold_12'] : 0;
    ?>
    <div class="mb-2">
        <select id="gold-duration-select" class="modern-select mb-2">
            <option value="1">1 Month - $<?= $gold_price; ?></option>
            <option value="3">3 Months - $<?= $gold_price*3 - $gold_discount_3; ?><?php if($gold_discount_3): ?> (Save <?= round($gold_discount_3/($gold_price*3)*100); ?>%)<?php endif; ?></option>
            <option value="6">6 Months - $<?= $gold_price*6 - $gold_discount_6; ?><?php if($gold_discount_6): ?> (Save <?= round($gold_discount_6/($gold_price*6)*100); ?>%)<?php endif; ?></option>
            <option value="12">12 Months - $<?= $gold_price*12 - $gold_discount_12; ?><?php if($gold_discount_12): ?> (Save <?= round($gold_discount_12/($gold_price*12)*100); ?>%)<?php endif; ?></option>
        </select>
    </div>
    <form action="instapay.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="package" value="GOLD">
        <input type="hidden" name="duration" id="gold-duration-instapay" value="1">
        <input type="hidden" name="package_price" id="gold-price-instapay" value="<?= $gold_price; ?>">
        <button type="submit" class="modern-btn">Instapay</button>
    </form>
    <form action="start_paypal_payment.php" method="POST" style="margin: 0;">
        <input type="hidden" name="package" value="GOLD">
        <input type="hidden" name="duration" id="gold-duration-paypal" value="1">
        <input type="hidden" name="package_price" id="gold-price-paypal" value="<?= $gold_price; ?>">
        <button type="submit" class="modern-btn">PayPal</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('gold-duration-select');
        var instapayInput = document.getElementById('gold-duration-instapay');
        var paypalInput = document.getElementById('gold-duration-paypal');
        var instapayPrice = document.getElementById('gold-price-instapay');
        var paypalPrice = document.getElementById('gold-price-paypal');
        var prices = {
            1: <?= $gold_price; ?>,
            3: <?= $gold_price*3 - $gold_discount_3; ?>,
            6: <?= $gold_price*6 - $gold_discount_6; ?>,
            12: <?= $gold_price*12 - $gold_discount_12; ?>
        };
        select.addEventListener('change', function() {
            instapayInput.value = this.value;
            paypalInput.value = this.value;
            instapayPrice.value = prices[this.value];
            paypalPrice.value = prices[this.value];
        });
        instapayPrice.value = prices[select.value];
        paypalPrice.value = prices[select.value];
    });
    </script>
</div>
        </div>
    </div>
    <!-- الباقة البلاتينية -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="pricing-card">
            <div class="header"><h3>PLATINUM</h3></div>
            <div class="price"><h2>$799<span>/month</span></h2></div>
            <ul class="features">
                <li><i class="fa fa-pen-to-square"></i> <strong>24</strong> Social Media Posts</li>
                <li><i class="fa fa-video"></i> <strong>8</strong> High-Quality Reels</li>
                <li><i class="fa fa-bolt"></i> <strong>30</strong> Engaging Stories</li>
                <li><i class="fa fa-chart-line"></i> Advanced Analytics & Strategy</li>
                
            </ul>
<div class="pricing-footer" style="display: flex; flex-direction: column; gap: 10px;">
    <!-- خيارات المدة والخصم للباقة البلاتينية -->
    <?php 
        $platinum_price = 799;
        $platinum_discount_3 = isset($discounts['platinum_3']) ? $discounts['platinum_3'] : 0;
        $platinum_discount_6 = isset($discounts['platinum_6']) ? $discounts['platinum_6'] : 0;
        $platinum_discount_12 = isset($discounts['platinum_12']) ? $discounts['platinum_12'] : 0;
    ?>
    <div class="mb-2">
        <select id="platinum-duration-select" class="modern-select mb-2">
            <option value="1">1 Month - $<?= $platinum_price; ?></option>
            <option value="3">3 Months - $<?= $platinum_price*3 - $platinum_discount_3; ?><?php if($platinum_discount_3): ?> (Save <?= round($platinum_discount_3/($platinum_price*3)*100); ?>%)<?php endif; ?></option>
            <option value="6">6 Months - $<?= $platinum_price*6 - $platinum_discount_6; ?><?php if($platinum_discount_6): ?> (Save <?= round($platinum_discount_6/($platinum_price*6)*100); ?>%)<?php endif; ?></option>
            <option value="12">12 Months - $<?= $platinum_price*12 - $platinum_discount_12; ?><?php if($platinum_discount_12): ?> (Save <?= round($platinum_discount_12/($platinum_price*12)*100); ?>%)<?php endif; ?></option>
        </select>
    </div>
    <form action="instapay.php" method="post">
        <input type="hidden" name="package" value="PLATINUM">
        <input type="hidden" name="duration" id="platinum-duration-instapay" value="1">
        <input type="hidden" name="package_price" id="platinum-price-instapay" value="<?= $platinum_price; ?>">
        <button type="submit" class="modern-btn">InstaPay</button>
    </form>
    <form action="start_paypal_payment.php" method="POST" style="margin: 0;">
        <input type="hidden" name="package" value="PLATINUM">
        <input type="hidden" name="duration" id="platinum-duration-paypal" value="1">
        <input type="hidden" name="package_price" id="platinum-price-paypal" value="<?= $platinum_price; ?>">
        <button type="submit" class="modern-btn">PayPal</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('platinum-duration-select');
        var instapayInput = document.getElementById('platinum-duration-instapay');
        var paypalInput = document.getElementById('platinum-duration-paypal');
        var instapayPrice = document.getElementById('platinum-price-instapay');
        var paypalPrice = document.getElementById('platinum-price-paypal');
        var prices = {
            1: <?= $platinum_price; ?>,
            3: <?= $platinum_price*3 - $platinum_discount_3; ?>,
            6: <?= $platinum_price*6 - $platinum_discount_6; ?>,
            12: <?= $platinum_price*12 - $platinum_discount_12; ?>
        };
        select.addEventListener('change', function() {
            instapayInput.value = this.value;
            paypalInput.value = this.value;
            instapayPrice.value = prices[this.value];
            paypalPrice.value = prices[this.value];
        });
        instapayPrice.value = prices[select.value];
        paypalPrice.value = prices[select.value];
    });
    </script>
    <style>
    .modern-select {
        width: 100%;
        padding: 16px 22px;
        border-radius: 18px;
        border: 2.5px solid #b983ff;
        background: linear-gradient(90deg, #f7f7fa 0%, #e0c3fc 100%);
        color: #2d2350;
        font-size: 1.13rem;
        font-weight: 700;
        box-shadow: 0 4px 18px 0 rgba(160,132,238,0.13);
        outline: none;
        transition: border 0.2s, box-shadow 0.2s, background 0.2s;
        appearance: none;
        -webkit-appearance: none;
        margin-bottom: 12px;
        cursor: pointer;
        background-image: url('data:image/svg+xml;utf8,<svg fill="%23b983ff" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M5.516 7.548a1 1 0 0 1 1.415 0L10 10.617l3.07-3.07a1 1 0 1 1 1.415 1.415l-3.777 3.778a1 1 0 0 1-1.415 0L5.516 8.963a1 1 0 0 1 0-1.415z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 1.1em center;
        background-size: 1.3em;
        box-shadow: 0 2px 10px 0 rgba(160,132,238,0.10);
        /* Custom animation for dropdown */
        animation: selectDropDownOpen 0.35s cubic-bezier(.4,1.6,.6,1) 1;
    }
    @keyframes selectDropDownOpen {
        0% { transform: scaleY(0.7) translateY(-10px); opacity: 0.2; }
        60% { transform: scaleY(1.08) translateY(2px); opacity: 1; }
        100% { transform: scaleY(1) translateY(0); opacity: 1; }
    }
    .modern-select:focus, .modern-select:hover {
        border: 2.5px solid #a084ee;
        box-shadow: 0 8px 32px 0 rgba(185,131,255,0.18);
        background: linear-gradient(90deg, #e0c3fc 0%, #f7f7fa 100%);
        color: #2d2350;
    }
    /* Custom option style for Chrome/Edge */
    .modern-select option {
        padding: 16px 22px;
        font-size: 1.13rem;
        color: #2d2350;
        background: linear-gradient(90deg, #f7f7fa 0%, #e0c3fc 100%);
        font-weight: 600;
        border-radius: 0 0 14px 14px;
        margin-bottom: 2px;
        transition: background 0.2s, color 0.2s;
    }
    .modern-select option:checked, .modern-select option:focus {
        background: linear-gradient(90deg, #b983ff 0%, #a084ee 100%);
        color: #fff;
    }
    /* For Firefox: make options bigger and rounded */
    @-moz-document url-prefix() {
      .modern-select option {
        padding: 16px 22px;
        font-size: 1.13rem;
        border-radius: 0 0 14px 14px;
      }
    }
    .modern-btn {
        width: 100%;
        background: linear-gradient(90deg, #b983ff 0%, #a084ee 100%);
        color: #fff;
        border: none;
        border-radius: 25px;
        padding: 14px 0;
        font-size: 1.13rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 10px 0 rgba(160,132,238,0.10);
        transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
        margin-bottom: 2px;
        margin-top: 2px;
        cursor: pointer;
    }
    .modern-btn:hover, .modern-btn:focus {
        background: linear-gradient(90deg, #a084ee 0%, #b983ff 100%);
        color: #fff;
        box-shadow: 0 4px 18px 0 rgba(185,131,255,0.18);
        transform: translateY(-2px) scale(1.03);
    }
    </style>
</div>
        </div>
    </div>
</div>
    </div>
  </div>
<!-- ==================== [ بداية كود أيقونة الشات ] ==================== -->
<?php if (isset($_SESSION['user_id'])): // أظهر الأيقونة فقط للمستخدمين المسجلين ?>
<style>
    .chat-link-bubble { position: fixed; bottom: 20px; right: 20px; background-color: #b60c9fff; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 24px; cursor: pointer; z-index: 999; text-decoration: none; transition: transform 0.2s; }
    .chat-link-bubble:hover { transform: scale(1.1); color: white; }
</style>

<!-- الأيقونة الآن أصبحت رابطًا يوجه إلى home.php -->
<a href="php-chat-app-main/home.php" class="chat-link-bubble" title="Live Chat">
    <i class="fa fa-comments"></i>
</a>
<?php endif; ?>

  <footer class="footer-no-gap">
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
</footer>

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>