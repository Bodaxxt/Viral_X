<?php
// ابدأ الجلسة في أعلى الملف لتتمكن من استخدام متغيرات $_SESSION
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppinlay=swap" rel="stylesheet">

          <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <style>
      /* --- تصميم أزرار الفلترة الجديدة --- */
      .filters-container {
        width: 100%;
        margin-bottom: 20px;
      }

      /* --- الفلاتر الرئيسية --- */
      .main-filters {
        border-radius: 30px;
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding: 5px 0 5px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        background: #fff;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE 10+ */
      }
      .main-filters::-webkit-scrollbar { display: none; }

      .main-filters button {
        background: transparent;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        color: #1e1e1e;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 25px;
        margin: 0 5px;
        white-space: nowrap;
        font-weight: 500;
      }

      .main-filters button.is-active {
        background-color: #8d0382ff;
        color: #fff;
        box-shadow: 0 4px 12px rgba(243, 85, 37, 0.3);
      }

      /* --- الفلاتر الفرعية --- */
      .sub-filters {
        margin-bottom: 20px;
        display: none; /* مخفي بشكل افتراضي */
        animation: fadeIn 0.5s;
        width: 100%;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
      }

      .sub-filters .btn-group {
        border-radius: 30px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 5px 0 5px 0;
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }
      .sub-filters .btn-group::-webkit-scrollbar { display: none; }
      
      .sub-filters button {
        background-color: #f9f9f9;
        border: 1px solid #eee;
        color: #555;
        padding: 8px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 0 4px;
        border-radius: 20px;
        white-space: nowrap;
        font-weight: 500;
      }

      .sub-filters button:first-child {
        margin-left: 0;
      }
      .sub-filters button:last-child {
        margin-right: 0;
      }

      .sub-filters button.is-active {
        background-color: #1e1e1e;
        color: #fff;
        border-color: #1e1e1e;
      }

      /* تعديل بسيط على العناصر لتظهر بشكل أفضل */
      .properties-items .item {
        margin-bottom: 30px;
      }

      /* ================= Responsive Tweaks ================= */
      @media (max-width: 991px) {
        .main-filters {
          padding: 4px 0;
        }
        .main-filters button {
          padding: 10px 16px;
          font-size: 15px;
          margin: 0 3px;
        }
        .sub-filters .btn-group {
          padding: 4px 0;
        }
        .sub-filters button {
          padding: 7px 14px;
          font-size: 13px;
          margin: 0 3px;
        }
      }
      @media (max-width: 767px) {
        .main-filters, .sub-filters .btn-group {
          border-radius: 15px;
          padding: 7px 0 7px 0;
        }
        .main-filters button {
          padding: 8px 10px;
          font-size: 13px;
          margin: 0 2px;
        }
        .sub-filters button {
          padding: 6px 10px;
          font-size: 12px;
          margin: 0 2px;
        }
      }
      /* إخفاء شريط التمرير الأفقي للأزرار في جميع الأجهزة */
      .main-filters::-webkit-scrollbar, .sub-filters .btn-group::-webkit-scrollbar {
        display: none;
      }
    
    </style>
    <!-- ***** نهاية التعديلات: CSS مخصص ***** -->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

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

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>Viral-X  ㅤ  ㅤ  ㅤ</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <!-- ***** القائمة الموصى بها ***** -->

                          <li><a href="index.php">Home</a></li>
                          <li><a href="properties.php" class="active">Our Services</a></li> <!-- تعديل هنا -->
                          <li><a href="property-details.php">Packages</a></li> <!-- تعديل هنا -->
                          <li><a href="contact.php">Contact Us</a></li>
                          <!-- ... باقي عناصر القائمة ... -->

                    
                        <li class="auth-buttons-container">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <div class="visitor-buttons">
                                    <span class="button2 user-display-style">
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </span>
                                    <a href="logout.php" class="auth-btn btn-logout">
                                        <button class="button2">Logout</button>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="visitor-buttons">
                                    <a href="login.php" class="auth-btn btn-login">
                                        <button class="button2">Login</button>
                                    </a>
                                    <a href="register.php" class="auth-btn btn-register">
                                        <button class="button2">Register</button>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  <!-- كود التصميم الخاص بأزرار التسجيل + قائمة الباقات العصرية -->
  <style>
  .button2{display:inline-block;position:relative;transition:all .2s;color:#222;background:#fff;border:none;border-radius:15px;font-size:15px;font-ing:.4em 1.2em;margin:0 6px;box-shadow:none;cursor:pointer;outline:0;z-index:1;letter-spacing:.5px;font-family:Poppins,Arial,sans-serif;display:inline-flex;align-items:center;justify-content:center;gap:6px}
  .user-display-style{minxt-align:center;height:40px}
  .button2:hover{background:#8a2be2;color:#fff;transform:translateY(-2px) scale(1.04)}
  .auth-buttons-container{margin-left:auto;display:flex;align-items:center;height:40px;border-radius:0;padding:0;box-shadow:none;position:relative;top:0;justify-content:center;margin-top:-30px}
  .visitor-buttons{display:flex;align-items:center;justify-content:center;gap:8pxon-wrapper{display:none!important}
  .auth-btn{background:0 0!important;box-shadow:none!important;padding:0!important;min-width:unset!important;height:auto!important}
  .user-display-style{cursor:default}
  .user-display-style:hover{background:#fff;color:#222;transform:none}

  /* ===================== باقة الباقات (select) ===================== */
  .modern-select {
    width: 100%;
    padding: 16px 22px;
    border-radius: 18px;
    border: 2.5px solid #7c1fff;
    background: linear-gradient(90deg, #fff 0%, #e0c3fc 100%);
    color: #18122B;
    font-size: 1.22rem;
    font-weight: 800;
    box-shadow: 0 6px 24px 0 rgba(124,31,255,0.13);
    outline: none;
    transition: border 0.2s, box-shadow 0.2s, background 0.2s;
    appearance: none;
    -webkit-appearance: none;
    position: relative;
    margin-bottom: 14px;
    cursor: pointer;
    letter-spacing: 0.5px;
    text-shadow: 0 1px 0 #fff, 0 0 2px #e0c3fc;
  }
  .modern-select:focus, .modern-select:hover {
    border: 2.5px solid #4f8cff;
    box-shadow: 0 8px 32px 0 rgba(79,140,255,0.18);
    background: linear-gradient(90deg, #e0c3fc 0%, #fff 100%);
    color: #18122B;
  }
  /* سهم مخصص */
  .modern-select {
    background-image: url('data:image/svg+xml;utf8,<svg fill="%237c1fff" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M5.516 7.548a1 1 0 0 1 1.415 0L10 10.617l3.07-3.07a1 1 0 1 1 1.415 1.415l-3.777 3.778a1 1 0 0 1-1.415 0L5.516 8.963a1 1 0 0 1 0-1.415z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 1.1em center;
    background-size: 1.3em;
  }
  /* تحسين الخيارات (لا يمكن إلا بشكل محدود) */
  .modern-select option {
    border-radius: 0 0 12px 12px;
    padding: 12px 18px;
    font-size: 1.08rem;
    color: #18122B;
    background: linear-gradient(90deg, #fff 0%, #e0c3fc 100%);
    font-weight: 700;
    text-shadow: 0 1px 0 #fff, 0 0 2px #e0c3fc;
  }
  .modern-select option:checked, .modern-select option:focus {
    background: linear-gradient(90deg, #7c1fff 0%, #4f8cff 100%);
    color: #fff;
  }
  /* Responsive */
  @media (max-width: 767px) {
    .modern-select {
      font-size: 1rem;
      padding: 12px 12px;
      border-radius: 12px;
    }
  }
  /* =============================================
   CSS جديد لجعل الفلاتر متجاوبة على الموبايل
   ============================================= */
  @media (max-width: 767px) {
    .main-filters,
    .sub-filters .btn-group {
      display: flex;
      flex-wrap: wrap; /* <== هذا هو السطر الأهم، يسمح للأزرار بالنزول لسطر جديد */
      justify-content: center; /* توسيط الأزرار */
      border-radius: 15px; /* تقليل استدارة الحواف لتناسب الأسطر المتعددة */
      padding: 10px 5px; /* زيادة المساحة الداخلية قليلاً */
    }

    .main-filters button {
      padding: 8px 15px; /* تصغير حجم الزر قليلاً */
      font-size: 14px;
      margin: 5px; /* إضافة هامش من كل الجهات */
    }

    .sub-filters button {
      padding: 6px 12px;
      font-size: 13px;
      margin: 4px;
    }

    .page-heading h3 {
      font-size: 36px;
    }
  }
  </style>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a> / Services</span>
          <h3>Our Projects</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      
      <!-- ***** بداية التعديلات: هيكل الفلترة الجديد ***** -->
      <div class="filters-container">
        <!-- الفلاتر الرئيسية -->
        
          
          
        <div class="main-filters">
              <button class="filter-button is-active" data-main-filter="website">Websites</button> <!-- <== هذا هو الزر الوحيد النشط -->
              <button class="filter-button" data-main-filter="app">Apps</button>
              <button class="filter-button" data-main-filter="ads">Manage Ads</button>
              <button class="filter-button" data-main-filter="digital">Design</button> <!-- <== تم حذف 'is-active' من هنا -->
              <button class="filter-button" data-main-filter="production">Media & reel</button>
              <button class="filter-button" data-main-filter="on_ground">On-Ground Services</button>
              <button class="filter-button" data-main-filter="printing">printing</button>
              <button class="filter-button" data-main-filter="Event">event</button>
          </div>
        <div id="ads-sub-filters" class="sub-filters">
        <div class="btn-group">
          <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
          <button class="sub-filter-button" data-sub-filter=".meta">Meta Ads (FB/IG)</button>
          <button class="sub-filter-button" data-sub-filter=".google">Google Ads</button>
          <button class="sub-filter-button" data-sub-filter=".tiktok">TikTok Ads</button>
          <button class="sub-filter-button" data-sub-filter=".linkedin">LinkedIn Ads</button>
        </div>
      </div>
            <!-- ===================[ بداية الفلاتر الفرعية الجديدة لـ Event ]=================== -->
      <div id="Event-sub-filters" class="sub-filters">
          <div class="btn-group">
              <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
              <button class="sub-filter-button" data-sub-filter=".corporate">For Companies</button>
              <button class="sub-filter-button" data-sub-filter=".launches">Brand Launches</button>
              <button class="sub-filter-button" data-sub-filter=".medical">For Hospitals</button>
              <button class="sub-filter-button" data-sub-filter=".private">Private Parties</button>
          </div>
      </div>
      <!-- ===================[ نهاية الفلاتر الفرعية الجديدة لـ Event ]=================== -->    

        <!-- الفلاتر الفرعية للمواقع -->
        <div id="website-sub-filters" class="sub-filters" style="display: block;">
          <div class="btn-group">
            <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
            <button class="sub-filter-button" data-sub-filter=".business">Business</button>
            <button class="sub-filter-button" data-sub-filter=".ecommerce">E-commerce</button>
            <button class="sub-filter-button" data-sub-filter=".portfolio">Portfolio</button>
            <button class="sub-filter-button" data-sub-filter=".event">Event</button>
            <button class="sub-filter-button" data-sub-filter=".non_profit">Non-Profit</button>
            <button class="sub-filter-button" data-sub-filter=".restaurant">Restaurants</button>
            <button class="sub-filter-button" data-sub-filter=".other">Other</button>
          </div>
        </div>

        <!-- الفلاتر الفرعية للتطبيقات -->
        <div id="app-sub-filters" class="sub-filters">
           <div class="btn-group">
            <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
            <button class="sub-filter-button" data-sub-filter=".system">System</button>
            <button class="sub-filter-button" data-sub-filter=".custom">custom Apps</button>
          </div>
        </div>
         <!-- يمكن إضافة فلاتر فرعية لـ Manage Ads هنا بنفس الطريقة إذا أردت -->

      <div id="digital-sub-filters" class="sub-filters" >
          <div class="btn-group">
              <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>

              <!-- الخدمة الجديدة -->
              <button class="sub-filter-button" data-sub-filter=".graphic_design">Graphic Design</button>
          </div>
      </div>

    <!-- ===================[ بداية الفلاتر الفرعية المحدثة ]=================== -->
    <div id="production-sub-filters" class="sub-filters">
      <div class="btn-group">
        <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
        <button class="sub-filter-button" data-sub-filter=".youtube">YouTube Videos</button>
        <!-- الفئات الجديدة -->
        <button class="sub-filter-button" data-sub-filter=".tiktok">TikTok Videos</button>
        <button class="sub-filter-button" data-sub-filter=".reels">Instagram Reels</button>
        <button class="sub-filter-button" data-sub-filter=".snap"> snap</button>
        <!-- الفئة القديمة -->
      </div>
    </div>
    <!-- ===================[ نهاية الفلاتر الفرعية المحدثة ]=================== -->

<!-- ===================[ بداية الفلاتر الفرعية لـ On-Ground ]=================== -->
<div id="on_ground-sub-filters" class="sub-filters">
  <div class="btn-group">
    <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
    <button class="sub-filter-button" data-sub-filter=".location_rental">Location Rental</button>
    <button class="sub-filter-button" data-sub-filter=".photography">Photography Services</button>
  </div>
</div>
<!-- ===================[ نهاية الفلاتر الفرعية لـ On-Ground ]=================== -->
<div id="event_management-sub-filters" class="sub-filters">
    <div class="btn-group">
        <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
        <button class="sub-filter-button" data-sub-filter=".corporate_event">Corporate Events</button>
        <button class="sub-filter-button" data-sub-filter=".brand_launch">Brand Launches</button>
        <button class="sub-filter-button" data-sub-filter=".medical_event">Medical Conferences</button>
        <button class="sub-filter-button" data-sub-filter=".private_event">Private Parties</button>
    </div>
</div>



<!-- فلاتر فرعية للخدمات الأخرى (مثل تأجير الأماكن) -->

      <!-- ***** نهاية التعديلات: هيكل الفلترة الجديد ***** -->


      <!-- ***** بداية التعديلات: العناصر مع الكلاسات الجديدة ***** -->
      <div class="row properties-box">

 <!-- ===================[ بداية أمثلة إنتاج الفيديو الجديدة ]=================== -->

<!-- أمثلة YouTube Videos -->
<div class="col-lg-4 col-md-6 properties-items production youtube">
  <div class="item">
    <a href="contact.php"><img src="img/download (1).jfif" alt="YouTube Vlogging"></a>
    <span class="category">YouTube Content - Vlogs</span>
    <h6>Custom Quote</h6>
    <h4><a href="contact.php">Travel & Lifestyle Vlogging</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production youtube">
  <div class="item">
    <a href="contact.php"><img src="img/download (2).jfif" alt="YouTube Product Review"></a>
    <span class="category">YouTube Content - Reviews</span>
    <h6>Starts
    <h4><a href="contact.php">Tech Product Unboxing & Review</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production youtube">
  <div class="item">
    <a href="contact.php">
      <img src="img/download (3).jfif" alt="YouTube Tutorial">
    </a>
    <span class="category">YouTube Content - Tutorials</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">Educational "How-To" Series</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>

<!-- أمثلة TikTok Videos -->
<div class="col-lg-4 col-md-6 properties-items production tiktok">
  <div class="item">
    <a href="contact.php"><img src="img/download (5).jfif" alt="TikTok Dance Challenge"></a>
    <span class="category">TikTok Short Video</span>
    <h6>Starts from $150</h6>
    <h4><a href="contact.php">Viral Dance & Trend Challenge</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production tiktok">
  <div class="item">
    <a href="contact.php"><img src="img/download (4).jfif" alt="TikTok Comedy Skit"></a>
    <span class="category">TikTok Short Video</span>
    <h6>Starts
    <h4><a href="contact.php">Short Comedy Skits Production</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production tiktok">
  <div class="item">
    <a href="contact.php">
      <img src="https://images.pexels.com/photos/799137/pexels-photo-799137.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="TikTok Product Showcase">
    </a>
    <span class="category">TikTok Short Video</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">Fast-Paced Product Showcase</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>

<!-- أمثلة Instagram Reels -->
<div class="col-lg-4 col-md-6 properties-items production reels">
  <div class="item">
    <a href="contact.php"><img src="img/download (7).jfif" alt="Instagram Fashion Reel"></a>
    <span class="category">Instagram Reels</span>
    <h6>Starts from $250</h6>
    <h4><a href="contact.php">Aesthetic Fashion & Style Reels</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production reels">
  <div class="item">
    <a href="contact.php"><img src="img/images.jfif" alt="Instagram Recipe Reel"></a>
    <span class="category">Instagram Reels</span>
    <h6>Starts from $180</h6>
    <h4><a href="contact.php">Quick & "Snackable" Recipe Videos</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items production reels">
  <div class="item">
    <a href="contact.php"><img src="img/download (8).jfif" alt="Instagram Behind The Scenes"></a>
    <span class="category">Instagram Reels</span>
    <h6>Custom Quote</h6>
    <h4><a href="contact.php">"Behind The Scenes" Business Reel</a></h4>
    <div class="main-button"><a href="contact.php">View Project</a></div>
  </div>
</div>


<div class="row">
  <!-- فلتر 1 -->




  <!-- فلتر 3 -->
  <div class="col-lg-4 col-md-6 properties-items production snap">
    <div class="item">
      <a href="contact.php"><img src="img/download (9).jfif" alt="Cartoon Face Filter"></a>
      <span class="category">Snap Filter</span>
      <h6>فلتر "Cartoon Face"</h6>
      <h4><a href="contact.php"> Cartoon Face Filter  </a></h4>
      <div class="main-button"><a href="contact.php"> View</a></div>
    </div>
  </div>
</div>

<!-- ===================[ نهاية أمثلة إنتاج الفيديو الجديدة ]=================== -->

<!-- 2. خدمة الجرافيك ديزاين -->
<div class="col-lg-4 col-md-6 properties-items digital website graphic_design">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/326503/pexels-photo-326503.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Graphic Design"></a>
    <span class="category">Custom Graphic Design</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">Branding, Logos, & Visuals</a></h4>
    <div class="main-button">
      <a href="contact.php">View Portfolio</a>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items digital website graphic_design">
  <div class="item">
    <a href="contact.php"><img src="img/Image_fx (3).jpg" alt="Graphic Design"></a>
    <span class="category">Custom Graphic Design</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">Branding, Logos, & Visuals</a></h4>
    <div class="main-button">
      <a href="contact.php">View Portfolio</a>
    </div>
  </div>
</div>
<div class="col-lg-4 col-md-6 properties-items digital website graphic_design">
  <div class="item">
    <a href="contact.php"><img src="img/Image_fx (4).jpg" alt="Graphic Design"></a>
    <span class="category">Custom Graphic Design</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">Branding, Logos, & Visuals</a></h4>
    <div class="main-button">
      <a href="contact.php">View Portfolio</a>
    </div>
  </div>
</div>


<!-- 3. خدمة إدارة وتنظيم الإيفنتات -->


<div class="col-lg-4 col-md-6 properties-items Event">
  <div class="item">
    <a href="contact.php"><img src="img/Image_fx (7).jpg" alt="Event Management"></a>
    <span class="category">Event Planning & Decoration</span>
    <h6>Custom Quote</h6>
    <h4><a href="contact.php">From Concept to Execution</a></h4>
    <div class="main-button">
      <a href="contact.php">Plan Your Event</a>
    </div>
  </div>
</div>
<!-- 4. خدمة تأجير أماكن التصوير الصغيرة -->
<div class="col-lg-4 col-md-6 properties-items on_ground location_rental">
  <div class="item">
    <a href="contact.php"><img src="img/download (10).jfif" alt="Location Rental"></a>
    <span class="category">Creative Space Rental</span>
   
    <h4><a href="contact.php">For Photoshoots & Small Productions</a></h4>
    <div class="main-button">
      <a href="contact.php">Book a Location</a>
    </div>
  </div>
</div>

<!-- ===================[ بداية قسم تأجير أماكن التصوير المطور ]=================== -->
<!-- <div id="on_ground-sub-filters" class="sub-filters">
  <div class="btn-group">
    <button class="sub-filter-button is-active" data-sub-filter="*">Show All</button>
    <button class="sub-filter-button" data-sub-filter=".location_rental">Location Rental</button>
    <button class="sub-filter-button" data-sub-filter=".photography_service">Photography Services</button>
  </div>
</div>
     -->
<!-- ===================[ بداية قسم خدمات On-Ground Services ]=================== -->

<!-- أمثلة Location Rental -->


<div class="col-lg-4 col-md-6 properties-items on_ground location_rental">
  <div class="item">
    <a href="contact.php"><img src="img/download (11).jfif" alt="Photography Studio"></a>
    <span class="category">Location Rental</span>
    <h4><a href="contact.php">Professional Photography Studio</a></h4>
    <div class="main-button"><a href="contact.php">View Location</a></div>
  </div>
</div>




<!-- أمثلة Photography Services -->
<div class="col-lg-4 col-md-6 properties-items on_ground photography">
  <div class="item">
    <a href="contact.php"><img src="img/download (12).jfif" alt="Product Photography"></a>
    <span class="category">Photography Service</span>
    <h6>Project Based Price</h6>
    <h4><a href="contact.php">High-End Product Photography</a></h4>
    <div class="main-button"><a href="contact.php">View Portfolio</a></div>
  </div>
</div>

<div class="col-lg-4 col-md-6 properties-items on_ground photography">
  <div class="item">
    <a href="contact.php"><img src="img/images (1).jfif" alt="Corporate Headshots"></a>
    <span class="category">Photography Service</span>
    <h6>Starts
    <h4><a href="contact.php">Professional Corporate Headshots</a></h4>
    <div class="main-button"><a href="contact.php">View Portfolio</a></div>
  </div>
</div>



<!-- ===================[ نهاية قسم تأجير أماكن التصوير المطور ]=================== -->

<!-- 5. خدمة الطباعة -->
<div class="col-lg-4 col-md-6 properties-items  printing">
  <div class="item">
    <!-- الصورة الجديدة هنا -->
    <a href="contact.php"><img src="img/download (13).jfif" alt="High-Volume Offset Printing Press"></a>
    <span class="category">Offset Printing</span>
    <h6>For Bulk Orders</h6>
    <h4><a href="contact.php">High-Volume Flyers & Brochures</a></h4>
    <div class="main-button">
      <a href="contact.php">Get a Quote</a>
    </div>
  </div>
</div>

<!-- 2. خدمة الطباعة الرقمية (للكروت والملصقات) -->

<div class="col-lg-4 col-md-6 properties-items  printing">
  <div class="item">
    <!-- الصورة الجديدة هنا -->
    <a href="contact.php"><img src="img/download (14).jfif" alt="High-Quality Business Cards"></a>
    <span class="category">Digital Printing</span>
    <h6>On-Demand & High Quality</h6>
    <h4><a href="contact.php">Business Cards & Sticker Sheets</a></h4>
    <div class="main-button">
      <a href="contact.php">Get a Quote</a>
    </div>
  </div>
</div>

<!-- 3. خدمة طباعة البنرات واللوحات الكبيرة -->
<div class="col-lg-4 col-md-6 properties-items  printing">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/8962453/pexels-photo-8962453.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Large Format Printing"></a>
    <span class="category">Large Format Printing</span>
    <h6>For Events & Advertising</h6>
    <h4><a href="contact.php">Banners, Posters & Signage</a></h4>
    <div class="main-button">
      <a href="contact.php">Get a Quote</a>
    </div>
  </div>
</div>

<!-- 4. خدمة طباعة وتجليد الكتب -->
<div class="col-lg-4 col-md-6 properties-items  printing">
  <div class="item">
    <a href="contact.php"><img src="img/download (15).jfif" alt="Book Printing and Binding"></a>
    <span class="category">Book Printing & Binding</span>
    <h6>Hardcover & Softcover</h6>
    <h4><a href="contact.php">Professional Book Production</a></h4>
    <div class="main-button">
      <a href="contact.php">Get a Quote</a>
    </div>
  </div>
</div>

<!-- 5. خدمة طباعة التيشرتات والملابس -->


<!-- 6. خدمة طباعة مواد التغليف -->
<div class="col-lg-4 col-md-6 properties-items  printing">
  <div class="item">
    <a href="contact.php"><img src="img/download (16).jfif" alt="Packaging Printing"></a>
    <span class="category">Packaging & Label Printing</span>
    <h6>For Products & Brands</h6>
    <h4><a href="contact.php">Custom Boxes, Bags & Labels</a></h4>
    <div class="main-button">
      <a href="contact.php">Get a Quote</a>
    </div>
  </div>
</div>

        
        <!-- عنصر 1: موقع - أعمال -->
        <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39322.jpeg" alt="موقع أعمال"></a>
            <span class="category">Business Website</span>
      
            <h4><a href="contact.php">Corporate Site Design</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

<!-- ===================[ بداية أمثلة إدارة المناسبات الجديدة ]=================== -->

<!-- ===================[ بداية أمثلة إدارة المناسبات المتخصصة ]=================== -->

<!-- أمثلة For Companies (مناسبات الشركات) -->
<div class="col-lg-4 col-md-6 properties-items Event corporate">
  <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/1181304/pexels-photo-1181304.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Corporate Conference"></a><span class="category">Corporate Events</span><h6>Full Service</h6><h4><a href="contact.php">Annual Corporate Conferences</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>

<div class="col-lg-4 col-md-6 properties-items Event corporate">
  <div class="item"><a href="contact.php"><img src="img/download (17).jfif" alt="Gala Dinner"></a><span class="category">Corporate Events</span><h6>Elegant & Formal</h6><h4><a href="contact.php">Gala Dinners & Award Ceremonies</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>

<!-- أمثلة Brand Launches (إطلاق العلامات التجارية) -->
<div class="col-lg-4 col-md-6 properties-items Event launches">
  <div class="item"><a href="contact.php"><img src="img/download (18).jfif" alt="Product Launch"></a><span class="category">Brand Launch</span><h6>Experiential Marketing</h6><h4><a href="contact.php">New Product Launch Events</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event launches">
  <div class="item"><a href="contact.php"><img src="img/download (19).jfif" alt="Store Opening"></a><span class="category">Brand Launch</span><h6>Grand Openings</h6><h4><a href="contact.php">Store & Branch Grand Openings</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event launches">
  <div class="item"><a href="contact.php"><img src="img/download (20).jfif" alt="Influencer Event"></a><span class="category">Brand Launch</span><h6>Media & Influencers</h6><h4><a href="contact.php">Exclusive Influencer Meetups</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>

<!-- أمثلة For Hospitals (المؤتمرات الطبية) -->
<div class="col-lg-4 col-md-6 properties-items Event medical">
  <div class="item"><a href="contact.php"><img src="img/download (21).jfif" alt="Medical Symposium"></a><span class="category">Medical Events</span><h6>Professional & Academic</h6><h4><a href="contact.php">Medical Symposiums & Seminars</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event medical">
  <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/5215017/pexels-photo-5215017.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Health Workshop"></a><span class="category">Medical Events</span><h6>Community Focused</h6><h4><a href="contact.php">Public Health Awareness Workshops</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event medical">
  <div class="item"><a href="contact.php"><img src="img/download (22).jfif" alt="Pharma Event"></a><span class="category">Medical Events</span><h6>For Pharmaceutical Co.</h6><h4><a href="contact.php">Pharmaceutical Product Launches</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>

<!-- أمثلة Private Parties (تشمل المطاعم وغيرها) -->
<div class="col-lg-4 col-md-6 properties-items Event private">
  <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/2260822/pexels-photo-2260822.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Private Dinner"></a><span class="category">Private Parties</span><h6>Exclusive Dinners</h6><h4><a href="contact.php">VIP & Private Dining Events</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event private">
  <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/169198/pexels-photo-169198.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Birthday Party"></a><span class="category">Private Parties</span><h6>Birthdays & Anniversaries</h6><h4><a href="contact.php">Themed Birthday Celebrations</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>
<div class="col-lg-4 col-md-6 properties-items Event private">
  <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/1024989/pexels-photo-1024989.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Wedding"></a><span class="category">Private Parties</span><h6>Weddings & Engagements</h6><h4><a href="contact.php">Intimate Wedding Receptions</a></h4><div class="main-button"><a href="contact.php">Plan Your Event</a></div></div>
</div>

<!-- ===================[ نهاية أمثلة إدارة المناسبات المتخصصة ]=================== -->
        <!-- =============== بداية قسم الحملات الإعلانية (Manage Ads) =============== -->

<!-- 1. حملة مبيعات لمتجر إلكتروني (Meta Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads meta">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/1797393/pexels-photo-1797393.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="E-commerce Conversion Campaign"></a>
    <span class="category">Meta Ads (Facebook & Instagram)</span>
    <h4><a href="contact.php">E-commerce Fashion Sales Campaign</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 2. حملة توليد عملاء محتملين (Google Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads google">
  <div class="item">
    <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__67042.png" alt="Lead Generation Campaign"></a>
    <span class="category">Google Search Ads</span>
    <h4><a href="contact.php">Lead Gen for Agency</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 3. حملة توعية بالعلامة التجارية (TikTok Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads tiktok">
  <div class="item">
    <a href="contact.php"><img src="img/download.jfif" alt="Brand Awareness Campaign"></a>
    <span class="category">TikTok Ads</span>
    <h6 style="color: #4a4a4a; background-color: #e0ffe7; border-left: 3px">Result: 3M+ Video Views</h6>
    <h4><a href="contact.php">Viral Brand Awareness Campaign</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 4. حملة لعملاء B2B (LinkedIn Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads linkedin">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="B2B Lead Generation"></a>
    <span class="category">LinkedIn Ads</span>
     <h6 style="color: #4a4a4a; background-color: #fff2e0; border-left: 3px solA: $15 (Cost Per Acquisition)</h6>
    <h4><a href="contact.php">B2B SaaS Software Leads</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 5. حملة تثبيت تطبيقات (Google Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads google">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/267350/pexels-photo-267350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="App Install Campaign"></a>
    <span class="category">Google App Campaigns (UAC)</span>
    <h6 style="color: #4a4a4a; background-color: #fff2e0; border-left: 3px solI: $0.80 (Cost Per Install)</h6>
    <h4><a href="contact.php">Mobile Game App Installs</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 6. حملة إعادة استهداف (Meta Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads meta">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/5668858/pexels-photo-5668858.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Retargeting Campaign"></a>
    <span class="category">Meta Ads (Facebook & Instagram)</span>
    <h4><a href="contact.php">Dynamic Retargeting for E-commerce</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 7. حملة فيديو (YouTube Ads) -->
<div class="col-lg-4 col-md-6 properties-items ads google">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/11197943/pexels-photo-11197943.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="YouTube Ads Campaign"></a>
    <span class="category">YouTube Ads</span>
    <h6 style="color: #4a4a4a; background-color: #e6f7ff; border-left: 3px">CPV: $0.02 (Cost Per View)</h6>
    <h4><a href="contact.php">Product Launch Video Campaign</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- 8. حملة محلية (Local Business) -->
<div class="col-lg-4 col-md-6 properties-items ads meta">
  <div class="item">
    <a href="contact.php"><img src="https://images.pexels.com/photos/2422280/pexels-photo-2422280.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Local Business Campaign"></a>
    <span class="category">Meta Ads (Facebook & Instagram)</span>
    <h4><a href="contact.php">Local Restaurant Promotion</a></h4>
    <div class="main-button">
      <a href="contact.php">View Case Study</a>
    </div>
  </div>
</div>

<!-- =============== نهاية قسم الحملات الإعلانية (Manage Ads) =============== -->

                <!-- =============== بداية قسم التطبيقات المخصصة (Custom Apps) =============== -->

        <!-- 1. تطبيق اللياقة البدنية للمدربين الشخصيين -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/4058411/pexels-photo-4058411.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق لياقة بدنية مخصص"></a>
            <span class="category">Personalized Fitness Planner</span>
        
            <h4><a href="contact.php">FitTrack Pro: For Personal Trainers</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 2. تطبيق الجولات العقارية الافتراضية -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/8089255/pexels-photo-8089255.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق جولات عقارية"></a>
            <span class="category">Augmented Reality Property Viewer</span>
         
            <h4><a href="contact.php">RealtyView AR: Virtual Home Tours</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 3. تطبيق دليل المؤتمرات والفعاليات -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/2306281/pexels-photo-2306281.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق دليل المؤتمرات"></a>
            <span class="category">Interactive Event & Conference Guide</span>
            
            <h4><a href="contact.php">EventNav: Your Conference Companion</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 4. تطبيق إدارة العيادات البيطرية -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/6234610/pexels-photo-6234610.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق عيادة بيطرية"></a>
            <span class="category">Veterinary Clinic Management</span>
          
            <h4><a href="contact.php">PetCare Connect: Vet & Pet Owner App</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 5. تطبيق تتبع أسطول السيارات للشركات -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/8995724/pexels-photo-8995724.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق تتبع أسطول السيارات"></a>
            <span class="category">B2B Fleet & Logistics Tracker</span>
            <
            <h4><a href="contact.php">FleetRoute: Live Vehicle Tracking</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 6. تطبيق الولاء والمكافآت للمقاهي -->
        <div class="col-lg-4 col-md-6 properties-items app custom">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/302899/pexels-photo-302899.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="تطبيق ولاء ومكافآت"></a>
            <span class="category">Loyalty & Rewards Program App</span>
            
            <h4><a href="contact.php">BrewPoints: For Local Coffee Shops</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
        <!-- =============== نهاية قسم التطبيقات المخصصة (Custom Apps) =============== -->

        <!-- =============== بداية قسم الأنظمة (Systems) =============== -->

        <!-- 1. نظام حجز المواعيد للعيادات -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/5452293/pexels-photo-5452293.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام حجز عيادة"></a>
            <span class="category">Clinic Management System</span>
            
            <h4><a href="contact.php">ClinicFlow: Appointment Booking</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 2. نظام إدارة المخزون للمتاجر الصغيرة -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام إدارة المخزون"></a>
            <span class="category">Inventory Management System</span>
            
            <h4><a href="contact.php">StockWise: Small Business Inventory</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 3. نظام إدارة الاشتراكات والعضويات -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/5965905/pexels-photo-5965905.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام إدارة الاشتراكات"></a>
            <span class="category">Subscription Management</span>
            
            <h4><a href="contact.php">MemberLoom: Gym & Club Memberships</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 4. نظام إدارة الطلبات للمطاعم -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/327158/pexels-photo-327158.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام طلبات المطاعم"></a>
            <span class="category">Order Management System</span>
            
            <h4><a href="contact.php">DineDirect: Restaurant Order Handling</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 5. نظام إدارة المهام والمشاريع للفرق -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/3184423/pexels-photo-3184423.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام إدارة المشاريع"></a>
            <span class="category">Project Management System</span>
          >
            <h4><a href="contact.php">TaskFlow: Team Collaboration Tool</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- 6. نظام إدارة الطلاب للمراكز التعليمية -->
        <div class="col-lg-4 col-md-6 properties-items app system">
          <div class="item">
            <a href="contact.php"><img src="https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="نظام إدارة الطلاب"></a>
            <span class="category">Student Information System</span>
            
            <h4><a href="contact.php">EduTrack: Learning Center Manager</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- =============== نهاية قسم الأنظمة (Systems) =============== -->
        
        <!-- عنصر 3: موقع - تجارة إلكترونية -->
        <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39340.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39339.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39338.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39337.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39335.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39334.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39333.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39331.jpeg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website ecommerce">
          <div class="item">
            <a href="contact.php"><img src="assets/images/property-03.jpg" alt="متجر إلكتروني"></a>
            <span class="category">E-commerce Store</span>
            
            <h4><a href="contact.php">Online Fashion Store</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>


        <!-- عنصر 4: موقع - شخصي (Portfolio) -->
        <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39356.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39354.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39353.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39351.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39352.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39350.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39349.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39348.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website portfolio">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39347.jpeg" alt="موقع شخصي"></a>
            <span class="category">Portfolio</span>
            
            <h4><a href="contact.php">Portfolio</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
        <!-- event -->

            <div class="col-lg-4 col-md-6 properties-items website portfolio event">
        <div class="item">
          <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__50650.jpeg" alt="موقع شخصي"></a>
          <span class="category">Portfolio / Event</span>
          
          <h4><a href="contact.php">events</a></h4>
          <div class="main-button">
            <a href="contact.php">View Details</a>
          </div>
        </div>
      </div>
              <div class="col-lg-4 col-md-6 properties-items website portfolio event">
        <div class="item">
          <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__50649.jpeg" alt="موقع شخصي"></a>
          <span class="category">Portfolio / Event</span>
          
          <h4><a href="contact.php">events</a></h4>
          <div class="main-button">
            <a href="contact.php">View Details</a>
          </div>
        </div>
      </div>
              <div class="col-lg-4 col-md-6 properties-items website portfolio event">
        <div class="item">
          <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__50646.jpeg" alt="موقع شخصي"></a>
          <span class="category">Portfolio / Event</span>
          
          <h4><a href="contact.php">events</a></h4>
          <div class="main-button">
            <a href="contact.php">View Details</a>
          </div>
        </div>
      </div>
      

              <div class="col-lg-4 col-md-6 properties-items website portfolio event">
        <div class="item">
          <a href="contact.php"><img src="img/Screenshot 2025-07-14 130625.png" alt="موقع شخصي"></a>
          <span class="category">Portfolio / Event</span>
          
          <h4><a href="contact.php">events</a></h4>
          <div class="main-button">
            <a href="contact.php">View Details</a>
          </div>
        </div>
      </div>
              <div class="col-lg-4 col-md-6 properties-items website portfolio event">
        <div class="item">
          <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__50645.jpeg" alt="موقع شخصي"></a>
          <span class="category">Portfolio / Event</span>
          
          <h4><a href="contact.php">events</a></h4>
          <div class="main-button">
            <a href="contact.php">View Details</a>
          </div>
        </div>
      </div>

   
        <!-- 2. جامعة -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
          <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/207692/pexels-photo-207692.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="بوابة إلكترونية لجامعة"></a><span class="category">Non-Profit / Higher Education</span><h6>Endowment Based</h6><h4><a href="contact.php">Future-Tech University Portal</a></h4><div class="main-button"><a href="contact.php">Explore Courses</a></div></div>
        </div>
        <!-- 3. منظمة إغاثة -->

        <!-- 4. مدرسة -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
          <div class="item"><a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__67039.png" alt="موقع مدرسة مجتمعية"></a><span class="category">Non-Profit / K-12 Education</span><h6>Publicly Funded</h6><h4><a href="contact.php">Hope Community School</a></h4><div class="main-button"><a href="contact.php">Admissions Info</a></div></div>
        </div>
        <!-- 5. بنك طعام -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
          <div class="item"><a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__67038.png" alt="موقع بنك طعام"></a><span class="category">Non-Profit / Hunger Relief</span><h6>Volunteer Supported</h6><h4><a href="contact.php">City Food Bank Initiative</a></h4><div class="main-button"><a href="contact.php">Get Help / Donate</a></div></div>
        </div>
        <!-- 6. حماية البيئة -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
          <div class="item"><a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__7831.jpeg" alt="منظمة حماية البيئة"></a><span class="category">Non-Profit / Environment</span><h6>Advocacy Driven</h6><h4><a href="contact.php">Green Planet Alliance</a></h4><div class="main-button"><a href="contact.php">Join the Movement</a></div></div>
        </div>
        <!-- 7. مكتبة عامة -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
            <div class="item"><a href="contact.php"><img src="https://images.pexels.com/photos/256450/pexels-photo-256450.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="موقع مكتبة عامة"></a><span class="category">Non-Profit / Arts & Culture</span><h6>Member Supported</h6><h4><a href="contact.php">Central Public Library</a></h4><div class="main-button"><a href="contact.php">Search Catalogue</a></div></div>
        </div>
        <!-- 8. مركز مجتمعي -->
    
        <!-- 9. ملجأ حيوانات -->
        <div class="col-lg-4 col-md-6 properties-items website non_profit">
          <div class="item"><a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__7830.jpeg" alt="ملجأ للحيوانات الأليفة"></a><span class="category">Non-Profit / Animal Welfare</span><h6>Adoption Services</h6><h4><a href="contact.php">Paws & Whiskers Shelter</a></h4><div class="main-button"><a href="contact.php">Adopt a Friend</a></div></div>
        </div>
        <!--مطعم  -->
      <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39341.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
            <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39342.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
            <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39343.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
            <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39344.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
            <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39345.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
            <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39341.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>
      <!-- ONTHER -->
      <div class="col-lg-4 col-md-6 properties-items website other">
      <div class="item">
        <a href="contact.php">
          <img src="img/freepik__the-style-is-candid-image-photography-with-natural__7832.jpeg" alt="Other Project">
        </a>
        <span class="category">Other</span>
        <h6>Adoption Services</h6>
        <h4><a href="contact.php">Other Project</a></h4>
        <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
      </div>
    </div>
          <div class="col-lg-4 col-md-6 properties-items website other">
      <div class="item">
        <a href="contact.php">
          <img src="img/freepik__the-style-is-candid-image-photography-with-natural__7834.jpeg" alt="Other Project">
        </a>
        <span class="category">Other</span>
        <h6>Adoption Services</h6>
        <h4><a href="contact.php">Other Project</a></h4>
        <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
      </div>
    </div>

          <div class="col-lg-4 col-md-6 properties-items website other">
      <div class="item">
        <a href="contact.php">
          <img src="img/freepik__the-style-is-candid-image-photography-with-natural__7835.jpeg" alt="Other Project">
        </a>
        <span class="category">Other</span>
        <h6>Adoption Services</h6>
        <h4><a href="contact.php">Other Project</a></h4>
        <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
      </div>
    </div>

          <div class="col-lg-4 col-md-6 properties-items website other">
      <div class="item">
        <a href="contact.php">
          <img src="img/freepik__the-style-is-candid-image-photography-with-natural__7836.jpeg" alt="Other Project">
        </a>
        <span class="category">Other</span>
        <h6>Adoption Services</h6>
        <h4><a href="contact.php">Other Project</a></h4>
        <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
      </div>
    </div>

          <div class="col-lg-4 col-md-6 properties-items website other">
      <div class="item">
        <a href="contact.php">
          <img src="img/freepik__the-style-is-candid-image-photography-with-natural__7839.jpeg" alt="Other Project">
        </a>
        <span class="category">Other</span>
        <h6>Adoption Services</h6>
        <h4><a href="contact.php">Other Project</a></h4>
        <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
      </div>
    </div>




      <!-- اخر -->
        
          <div class="col-lg-4 col-md-6 properties-items website  restaurant">
        <div class="item">
          <a href="contact.php">
            <img src="img/freepik__the-style-is-candid-image-photography-with-natural__39341.jpeg" alt="ملجأ للحيوانات الأليفة">
          </a>
          <span class="category">restaurante</span>
          <h6>Adoption Services</h6>
          <h4><a href="contact.php">restaurant</a></h4>
          <div class="main-button"><a href="contact.php">Adopt a Friend</a></div>
        </div>
      </div>

  

        <!-- عنصر 6: موقع - أعمال -->
        <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39323.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
           
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39324.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39325.png" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39327.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39326.png" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39328.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39329.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>
                <div class="col-lg-4 col-md-6 properties-items website business">
          <div class="item">
            <a href="contact.php"><img src="img/freepik__the-style-is-candid-image-photography-with-natural__39330.jpeg" alt="موقع أعمال آخر"></a>
            <span class="category">Business Website</span>
            
            <h4><a href="contact.php">Agency Site</a></h4>
            <div class="main-button">
              <a href="contact.php">View Details</a>
            </div>
          </div>
        </div>

        <!-- أضف المزيد من العناصر هنا بنفس الطريقة، مع تحديد الكلاسات المناسبة -->
        <!-- مثال: <div class="col-lg-4 col-md-6 properties-items app utility">...</div> -->

      </div>
      <!-- ***** نهاية التعديلات: العناصر ***** -->

      <!-- يمكنك إبقاء أو إزالة الترقيم حسب حاجتك -->


<!-- ==================== [ بداية كود أيقونة الشات ] ==================== -->
<?php if (isset($_SESSION['user_id'])): // أظهر الأيقونة فقط للمستخدمين المسجلين ?>
<style>
    .chat-link-bubble { position: fixed; bottom: 20px; right: 20px; background-color: #8a2be2; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 24px; cursor: pointer; z-index: 999; text-decoration: none; transition: transform 0.2s; }
    .chat-link-bubble:hover { transform: scale(1.1); color: white; }
</style>

<!-- الأيقونة الآن أصبحت رابطًا يوجه إلى home.php -->
<a href="php-chat-app-main/home.php" class="chat-link-bubble" title="Live Chat">
    <i class="fa fa-comments"></i>
</a>
<?php endif; ?>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>


  <!-- ***** بداية التعديلات: كود JAVASCRIPT للفلترة الديناميكية ***** -->
  <script>
    $(document).ready(function(){
      // تهيئة Isotope
      var $grid = $('.properties-box').isotope({
        itemSelector: '.properties-items',
        layoutMode: 'fitRows',
        filter: '.website' 
      });

      var mainFilter = '.website'; // متغير لتخزين الفلتر الرئيسي الحالي
      
      // --- التعامل مع الفلاتر الرئيسية ---
      $('.main-filters').on('click', 'button', function() {
        // تحديث متغير الفلتر الرئيسي
        mainFilter = '.' + $(this).data('main-filter');
        
        // تحديث كلاس 'is-active'
        $('.main-filters button').removeClass('is-active');
        $(this).addClass('is-active');

        // إظهار وإخفاء قوائم الفلاتر الفرعية
        $('.sub-filters').hide();
        $('#' + $(this).data('main-filter') + '-sub-filters').show();

        // إعادة تعيين الفلتر الفرعي إلى "Show All" وتطبيق الفلترة
        $('#' + $(this).data('main-filter') + '-sub-filters .sub-filter-button').removeClass('is-active');
        $('#' + $(this).data('main-filter') + '-sub-filters .sub-filter-button[data-sub-filter="*"]').addClass('is-active');
        subFilter = '*';
        
        // إذا لم يكن هناك فلاتر فرعية مرئية (مثل حالة ads)، استخدم '*'
        if (mainFilter === '.ads' && $('#ads-sub-filters').length === 0){
             $grid.isotope({ filter: mainFilter });
        } else {
             $grid.isotope({ filter: mainFilter });
        }
      });
      
      // --- التعامل مع الفلاتر الفرعية ---
      $('.sub-filters').on('click', 'button', function() {
        subFilter = $(this).data('sub-filter');

        // تحديث كلاس 'is-active' داخل المجموعة الفرعية فقط
        $(this).closest('.sub-filters').find('button').removeClass('is-active');
        $(this).addClass('is-active');

        // دمج الفلتر الرئيسي مع الفرعي وتطبيق الفلترة
        var combinedFilter = (subFilter === '*') ? mainFilter : mainFilter + subFilter;
        $grid.isotope({ filter: combinedFilter });
      });

    });
  </script>
  <!-- ***** نهاية التعديلات: كود JAVASCRIPT ***** -->

  </body>
</html>