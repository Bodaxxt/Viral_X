<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Villa Agency - Real Estate HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css ">
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
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
            <li><i class="fa fa-envelope"></i> viralxagency12@gmail.com</li>
           
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="https://www.facebook.com/profile.php?id=61578677009196"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.tiktok.com/@viral_x_agency"><i class="fab fa-tiktok"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                     <a href="index.php" class="logo">
                          <!-- ✅ تم نقل الصورة إلى هنا لتكون جزءًا من الرابط -->

                          <h1>Viral-X ㅤ  ㅤ  ㅤ</h1>
                      </a>
                    <!-- ***** Logo End ***** -->
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                          <li><a href="index.php"  class="active">Home</a></li>
                          <li><a href="properties.php" >Our Services</a></li> <!-- تعديل هنا -->
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
                                        <button class="button2">login </button>
                                    </a>
                                    <a href="register.php" class="auth-btn btn-register">
                                        <button class="button2">Register </button>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
.button2 {
  display: inline-block;
  position: relative;
  transition: all 0.2s;
  color: #222;
  background: #fff;
  border: none;
  border-radius: 15px;
  font-size: 15px;
  font-weight: 700;
  padding: 0.4em 1.2em;
  margin: 0 6px;
  box-shadow: none;
  cursor: pointer;
  outline: none;
  z-index: 1;
  letter-spacing: 0.5px;
  font-family: 'Poppins', Arial, sans-serif;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.user-display-style {
  min-width: 100px;
  text-align: center;
  height: 40px;
}

.button2:hover {
  background: #8a2be2;
  color: #fff;
  transform: translateY(-2px) scale(1.04);
}

.auth-buttons-container {
  margin-left: auto;
  display: flex;
  align-items: center;
  height: 40px;
  border-radius: 0;
  padding: 0;
  box-shadow: none;
  position: relative;
  top: 0;
  justify-content: center;
  margin-top: -30px;
}

.visitor-buttons {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
}

.icon-wrapper {
  display: none !important;
}

.auth-btn {
  background: none !important;
  box-shadow: none !important;
  padding: 0 !important;
  min-width: unset !important;
  height: auto !important;
}

.user-display-style {
  cursor: default;
}

.user-display-style:hover {
  background: #fff;
  color: #222;
  transform: none;
}


@media (max-width: 991px) {
  .auth-buttons-container {
    height: auto;
    padding: 0;
    border-radius: 0;
    top: 0;
    justify-content: center;
  }
  .button2 {
    font-size: 13px;
    padding: 0.3em 0.8em;
    margin: 0 3px;
  }
}
</style>

  <div class="main-banner">
    <div class="owl-carousel owl-banner">
      <div class="item item-1">
        <div class="header-text">
         <span class="category">Creative , <em>Solutions</em></span>
          <h2>Be viral,<br>befor all.</h2>
        
        </div>
      </div>
      <div class="item item-2">
        <div class="header-text">
          <span class="category">Melbourne, <em>Australia</em></span>
          <h2>Be Quick!<br>Get the best villa in town</h2>
        </div>
      </div>
      <div class="item item-3">
        <div class="header-text">
          <span class="category">Miami, <em>South Florida</em></span>
          <h2>Act Now!<br>Get the highest level penthouse</h2>
        </div>
      </div>
    </div>
  </div>
<div class="featured section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="left-image">
                    <img src="https://cdn-icons-png.flaticon.com/512/438/438524.png" alt="Benefits of our packages">
                    <a href="property-details.php"><img src="assets/images/featured-icon.png" alt="" style="max-width: 60px; padding: 0px;"></a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="section-heading">
                    <h6>| Why Choose Our Packages</h6>
                    <h2>Get The Best Social Media Plan For Your Business</h2>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What makes our packages different? <!-- سؤال مُعدَّل -->
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our packages are not just about posts, they're about results. 
                                We offer data-driven strategies, high-quality content creation, and dedicated support to help your business thrive on social media. <!-- وصف مُعدَّل -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                What kind of support do you offer? <!-- سؤال مُعدَّل -->
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                We provide personalized support every step of the way. 
                                From onboarding to strategy refinement, our dedicated team is here to help you succeed. <!-- وصف مُعدَّل -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How do you guarantee high-quality content? <!-- سؤال مُعدَّل -->
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Our content creators are experienced professionals who understand social media trends and best practices. 
                                We use a collaborative process to ensure your brand voice and message are always on point. <!-- وصف مُعدَّل -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="info-table">
                  <ul>
                      <li>
                          <i class="fa-solid fa-chart-line"></i> <!-- ✅ تم استبدال الصورة بأيقونة -->
                          <h4>Data-Driven<br><span>Strategies</span></h4>
                      </li>
                      <li>
                          <i class="fa-solid fa-pen-ruler"></i> <!-- ✅ تم استبدال الصورة بأيقونة -->
                          <h4>Expert<br><span>Content Creators</span></h4>
                      </li>
                      <li>
                          <i class="fa-solid fa-headset"></i> <!-- ✅ تم استبدال الصورة بأيقونة -->
                          <h4>Personalized<br><span>Support</span></h4>
                      </li>
                      <li>
                          <i class="fa-solid fa-arrow-trend-up"></i> <!-- ✅ تم استبدال الصورة بأيقونة -->
                          <h4>Brand<br><span>Growth Focus</span></h4>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
    </div>
</div>
  <div class="video section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="section-heading text-center">
            <h6>| Video View</h6>
            <h2>Get Closer View & Different Feeling</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="video-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="video-frame">
            <img src="assets/images/video-frame.jpg" alt="">
            <a href="https://youtube.com" target="_blank"><i class="fa fa-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="fun-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="wrapper">
            <div class="row">
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="34" data-speed="1000"></h2>
                   <p class="count-text ">Buildings<br>Finished Now</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="12" data-speed="1000"></h2>
                  <p class="count-text ">Years<br>Experience</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="counter">
                  <h2 class="timer count-title count-number" data-to="24" data-speed="1000"></h2>
                  <p class="count-text ">Awwards<br>Won 2023</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="section best-deal">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section-heading">
            <h6>| Our Packages</h6>
            <h2>Your social Plans  </h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="bronze-tab" data-bs-toggle="tab" data-bs-target="#bronze" type="button" role="tab" aria-controls="bronze" aria-selected="true">Bronze</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="silver-tab" data-bs-toggle="tab" data-bs-target="#silver" type="button" role="tab" aria-controls="villa" aria-selected="false">Silver</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="gold-tab" data-bs-toggle="tab" data-bs-target="#gold" type="button" role="tab" aria-controls="penthouse" aria-selected="false">Gold</button>
                  </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="platinum-tab" data-bs-toggle="tab" data-bs-target="#platinum" type="button" role="tab" aria-controls="penthouse" aria-selected="false">Platinum</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="bronze" role="tabpanel" aria-labelledby="bronze-tab">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="info-table">
                        <ul>
                          <li><i class="fa fa-pen-to-square"></i> Posts <span>8 per month</span></li>  
                          <li><i class="fa fa-video"></i> Reels <span>1 High-Quality</span></li>
                          <li><i class="fa fa-bolt"></i> Stories <span>2 Engaging</span></li>
                          <li><i class="fa fa-envelope"></i> Support <span>Email</span></li>
                        </ul>
                      </div>
                    </div>

                    <div class="col-lg-8">
                      <h4>Bronze Plan Details</h4>
                      <p>The Bronze Plan is perfect for businesses just starting with social media. It includes basic content creation and performance tracking.</p>
                      <ul class="mb-4">
                          <li><i class="fa fa-check"></i> Content creation calendar</li>
                          <li><i class="fa fa-check"></i> Engagement analysis</li>
                          <li><i class="fa fa-check"></i> Competitor monitoring</li>
                      </ul>
                      <div class="icon-button">
                        <a href="property-details.php?package=bronze"><i class="fa fa-check"></i> Choose Plan</a> 
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="silver" role="tabpanel" aria-labelledby="silver-tab">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="info-table">
                        <ul>
                          <li><i class="fa fa-pen-to-square"></i> Posts <span>12 per month</span></li> 
                          <li><i class="fa fa-video"></i> Reels <span>2 High-Quality</span></li>
                          <li><i class="fa fa-bolt"></i> Stories <span>8 Engaging</span></li>
                          
                          <li><i class="fa fa-chart-line"></i> Report <span>Basic Performance </span></li>
                          <li><i class="fa fa-comments"></i> Support <span>Email & Chat</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <h4>Silver Plan Details</h4>
                      <p>The Silver Plan offers more content creation and detailed performance reports for growing businesses.</p>
                       <ul class="mb-4">
                          <li><i class="fa fa-check"></i> All Bronze Plan Features</li>
                          <li><i class="fa fa-check"></i> Hashtag Research</li>
                          <li><i class="fa fa-check"></i> Content optimization tips</li>
                      </ul>
                      <div class="icon-button">
                        <a href="property-details.php?package=silver"><i class="fa fa-check"></i> Choose Plan</a> 
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="gold" role="tabpanel" aria-labelledby="gold-tab">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="info-table">
                        <ul>
                          <li><i class="fa fa-pen-to-square"></i> Posts <span>18 per month</span></li>
                          <li><i class="fa fa-video"></i> Reels <span>4 High-Quality</span></li>
                          <li><i class="fa fa-bolt"></i> Stories <span>16 Engaging</span></li>
                          <li><i class="fa fa-chart-line"></i> Report <span>Advanced Analytics</span></li>
                          <li><i class="fa fa-user"></i> Support <span>Dedicated Manager</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <h4>Gold Plan Details</h4>
                      <p>The Gold Plan is designed for businesses looking for a comprehensive social media strategy and advanced analytics.</p>
                      <ul class="mb-4">
                          <li><i class="fa fa-check"></i> All Silver Plan Features</li>
                          <li><i class="fa fa-check"></i> Community Engagement</li>
                          <li><i class="fa fa-check"></i> Custom strategy development</li>
                      </ul>
                      <div class="icon-button">
                        <a href="property-details.php?package=gold"><i class="fa fa-check"></i> Choose Plan</a>
                      </div>
                    </div>
                  </div>
                </div>
                   <div class="tab-pane fade" id="platinum" role="tabpanel" aria-labelledby="platinum-tab">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="info-table">
                        <ul>
                         <li><i class="fa fa-pen-to-square"></i> Posts <span>24 per month</span></li> 
                          <li><i class="fa fa-video"></i> Reels <span>8 High-Quality</span></li>
                          <li><i class="fa fa-bolt"></i> Stories <span>30 Engaging</span></li>
                          <li><i class="fa fa-chart-line"></i> Report <span>Detailed Performance Report</span></li>
                          <li><i class="fa fa-headset"></i> Support <span>Dedicated Manager & Priority</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <h4>Platinum Plan Details</h4>
                      <p>The Platinum Plan is our most comprehensive package, designed for businesses looking for full social media management and ad campaigns.</p>
                        <ul class="mb-4">
                          <li><i class="fa fa-check"></i> All Gold Plan Features</li>
                          <li><i class="fa fa-check"></i> Ad Campaign Management</li>
                          <li><i class="fa fa-check"></i> Monthly consultations</li>
                      </ul>
                      <div class="icon-button">
                        <a href="property-details.php?package=platinum"><i class="fa fa-check"></i> Choose Plan</a> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="properties section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="section-heading text-center">
                    <h6>| Our Services</h6>
                    <h2>Explore Our Range of Digital Solutions</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            // قائمة خدمات ثابتة (بدون استخدام قاعدة البيانات)
            $services = [
                [
                    'category' => 'Website Design',
                    'title' => 'Business Website',
                    'description' => 'Professional website for your business.',
                    'price' => 1200,
                    'image_url' => 'img/freepik__the-style-is-candid-image-photography-with-natural__39339.jpeg', // استبدل بصورتك
                    'alt_title' => "Corporate Website Design",
                    'alt_description' => 'Build your Brand Corporate Web Design, Build your Brand Corporate Web Design'
                ],
                [
                    'category' => 'Graphic Design',
                    'title' => 'Branding Package',
                    'description' => 'Logo design and brand guidelines.',
                    'price' => 1500,
                    'image_url' => 'https://images.pexels.com/photos/326503/pexels-photo-326503.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', // استبدل بصورتك
                  'alt_title' => "Custom Visual Designs",
                     'alt_description' => 'Visual Design, logo and brand identity solutions for small and medium business'
                ],
                [
                    'category' => 'Social Media Marketing',
                    'title' => 'Basic Plan',
                    'description' => 'Social media management with 8 posts per month.',
                    'price' => 199,
                    'image_url' => 'https://images.pexels.com/photos/267350/pexels-photo-267350.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', // استبدل بصورتك
                      'alt_title' => "Social Media Plan",
                     'alt_description' => 'Social Media Growth Social Media Plan with our plans'
                ],
            ];

            foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <a href="properties.PHP"><img src="<?php echo htmlspecialchars($service['image_url']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>"></a>
                        <span class="category"><?php echo htmlspecialchars($service['category']); ?></span>
                        
                        <h4><a href="properties.PHP"><?php echo htmlspecialchars($service['title']); ?></a></h4>
                        <ul>
                          <li>alt description: <span><?php echo htmlspecialchars($service['alt_description']); ?></span></li>
                            <li>Description: <span><?php echo htmlspecialchars($service['description']); ?></span></li>
                        </ul>
                        <div class="main-button">
                            <a href="properties.PHP">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- ===================[ New Contact Us Section - Modern Glassmorphism Design ]=================== -->
<section class="contact-modern-section">
  <div class="contact-modern-bg"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="contact-modern-card">
          <div class="row">
            <div class="col-md-5 d-flex flex-column align-items-center justify-content-center contact-modern-info">
              <h2 class="contact-modern-title mb-4"><i class="fa-solid fa-paper-plane"></i> Contact Us</h2>
              <ul class="contact-modern-list mb-4">
                <li><i class="fa-solid fa-phone"></i> <span>010-020-0340</span></li>
                <li><i class="fa-solid fa-envelope"></i> <span>viralxagency12@gmail.com</span></li>
                <li><i class="fa-brands fa-facebook"></i> <a href="https://www.facebook.com/profile.php?id=61578677009196" target="_blank">Facebook</a></li>
                <li><i class="fa-brands fa-tiktok"></i> <a href="https://www.tiktok.com/@viral_x_agency" target="_blank">TikTok</a></li>
                <li><i class="fa-brands fa-instagram"></i> <a href="#" target="_blank">Instagram</a></li>
              </ul>
              <div class="contact-modern-social">
                <a href="https://www.facebook.com/profile.php?id=61578677009196" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.tiktok.com/@viral_x_agency" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
            <div class="col-md-7">
              <form class="contact-modern-form" action="handle_contact.php" method="post" autocomplete="off">
                <div class="mb-3">
                  <label for="name-modern" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name-modern" name="name" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                  <label for="email-modern" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email-modern" name="email" placeholder="you@email.com" required>
                </div>
                <div class="mb-3">
                  <label for="subject-modern" class="form-label">Subject</label>
                  <input type="text" class="form-control" id="subject-modern" name="subject" placeholder="Subject" required>
                </div>
                <div class="mb-3">
                  <label for="message-modern" class="form-label">Message</label>
                  <textarea class="form-control" id="message-modern" name="message" rows="4" placeholder="Type your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary contact-modern-btn w-100">Send Message <i class="fa-solid fa-paper-plane ms-2"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.contact-modern-section {
  position: relative;
  padding: 80px 0 60px 0;
  z-index: 2;
  overflow: hidden;
}
.contact-modern-bg {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: linear-gradient(135deg, #8a2be2 0%, #4f8cff 100%);
  opacity: 0.18;
  z-index: 1;
}
.contact-modern-card {
  position: relative;
  z-index: 2;
  background: rgba(255,255,255,0.85);
  border-radius: 24px;
  box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
  backdrop-filter: blur(8px);
  padding: 40px 30px 30px 30px;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  min-height: 420px;
}
.contact-modern-title {
  font-size: 2.2rem;
  font-weight: 800;
  color: #8a2be2;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.contact-modern-list {
  list-style: none;
  padding: 0;
  margin: 0 0 18px 0;
  font-size: 1.1rem;
}
.contact-modern-list li {
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 10px;
  color: #333;
  font-weight: 500;
}
.contact-modern-list li i {
  color: #8a2be2;
  font-size: 1.2em;
}
.contact-modern-social {
  display: flex;
  gap: 18px;
  margin-top: 10px;
}
.contact-modern-social a {
  color: #fff;
  background: #8a2be2;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3em;
  transition: background 0.2s, color 0.2s, transform 0.2s;
  box-shadow: 0 2px 8px rgba(138,43,226,0.10);
}
.contact-modern-social a:hover {
  background: #4f8cff;
  color: #fff;
  transform: scale(1.08);
}
.contact-modern-form {
  background: rgba(255,255,255,0.7);
  border-radius: 18px;
  padding: 24px 18px 18px 18px;
  box-shadow: 0 2px 12px rgba(31,38,135,0.07);
}
.contact-modern-form .form-label {
  font-weight: 600;
  color: #8a2be2;
}
.contact-modern-form .form-control {
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 1rem;
  background: #f7f7fa;
  margin-bottom: 10px;
}
.contact-modern-btn {
  background: linear-gradient(90deg, #8a2be2 0%, #4f8cff 100%);
  border: none;
  color: #fff;
  font-weight: 700;
  font-size: 1.1rem;
  border-radius: 10px;
  padding: 12px 0;
  box-shadow: 0 2px 8px rgba(138,43,226,0.10);
  transition: background 0.2s, transform 0.2s;
}
.contact-modern-btn:hover {
  background: linear-gradient(90deg, #4f8cff 0%, #8a2be2 100%);
  color: #fff;
  transform: translateY(-2px) scale(1.03);
}
@media (max-width: 991px) {
  .contact-modern-card { padding: 24px 10px; }
  .contact-modern-title { font-size: 1.5rem; }
}
@media (max-width: 767px) {
  .contact-modern-section { padding: 40px 0 30px 0; }
  .contact-modern-card { min-height: unset; }
}
</style>

<!-- ==================== [ بداية كود الشات للمستخدم - النسخة المصححة ] ==================== -->
<!-- ==================== [ بداية كود الشات للمستخدم - النسخة المصححة ] ==================== -->
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
<!-- ==================== [ نهاية كود أيقونة الشات ] ==================== -->
<!-- ==================== [ نهاية كود الشات للمستخدم ] ==================== -->
<!-- ==================== [ نهاية كود الشات للمستخدم ] ==================== -->
<footer>

  <!-- Scripts -->

  
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
    <!-- Chat Window -->


    <!-- Header and Content -->
    <!-- ... -->


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Chat Script -->

      <!-- ==================== [ بداية كود JavaScript للشات ] ==================== -->
<!-- ==================== [ بداية كود JavaScript للشات - النسخة المصححة ] ==================== -->
<script>
$(document).ready(function() {
    // التأكد من وجود العناصر قبل تشغيل الكود
    if ($('#chat-bubble').length) {
        const chatBubble = $('#chat-bubble');
        const chatWidget = $('#chat-widget');
        const chatForm = $('#chat-form');
        const chatMessages = $('#chat-messages');
        const messageTextarea = chatForm.find('textarea');
        let chatInterval;

        // إظهار وإخفاء نافذة الشات
        chatBubble.on('click', function() {
            chatWidget.slideToggle(300, function() {
                if (chatWidget.is(':visible')) {
                    loadChatMessages();
                    // بدء التحديث التلقائي فقط عند فتح الشات
                    chatInterval = setInterval(loadChatMessages, 3000); // تحديث كل 3 ثواني
                } else {
                    // إيقاف التحديث التلقائي عند إغلاق الشات لتخفيف الحمل
                    clearInterval(chatInterval);
                }
            });
        });

        // إرسال الرسالة عند الضغط على الزر أو Enter
        chatForm.on('submit', function(e) {
            e.preventDefault();
            const message = messageTextarea.val().trim();

            if (message !== '') {
                // إرسال الرسالة إلى الخادم
                $.post('chat_handler.php?action=sendMessage', { message: message }, function(response) {
                    if (response.status === 'success') {
                        messageTextarea.val(''); // مسح مربع النص
                        loadChatMessages(); // تحديث الرسائل فورًا بعد الإرسال
                    } else {
                        // يمكنك إضافة رسالة خطأ هنا إذا فشل الإرسال
                        console.error("Failed to send message:", response.message);
                    }
                }, 'json');
            }
        });

        // إرسال الرسالة عند الضغط على Enter (بدون Shift)
        messageTextarea.on('keyup', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.submit();
            }
        });

        // دالة لجلب وعرض الرسائل
        function loadChatMessages() {
            $.post('chat_handler.php?action=getMessages', function(response) {
                chatMessages.html(''); // مسح الرسائل القديمة
                if (response.status === 'success' && response.messages.length > 0) {
                    response.messages.forEach(msg => {
                        const messageClass = (msg.sender_role === 'user') ? 'msg-user' : 'msg-assistant';
                        const messageDiv = $(`<div class="${messageClass}"><div class="msg-content"></div></div>`);
                        messageDiv.find('.msg-content').text(msg.message); // استخدام .text() للأمان
                        chatMessages.append(messageDiv);
                    });
                    // جعل الشاشة تنزل لأسفل تلقائيًا
                    chatMessages.scrollTop(chatMessages[0].scrollHeight);
                }
            }, 'json');
        }
    }
});
</script>
<!-- ==================== [ نهاية كود JavaScript للشات ] ==================== -->


<!-- ===================[ نهاية كود JavaScript لنافذة الدردشة ]=================== -->
  </footer>

  <!-- Scripts -->


  </body>
<?php
$message_display = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $message_display = '<div class="alert alert-success text-center">تم إرسال رسالتك بنجاح وسنتواصل معك قريبًا.</div>';
    } elseif ($_GET['status'] === 'error') {
        $message_display = '<div class="alert alert-danger text-center">خطأ: يرجى ملء حقلي الموضوع والرسالة.</div>';
    }
}
?>
</html>