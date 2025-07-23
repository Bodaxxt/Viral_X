<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Viral-X - Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- =================================================================== -->
    <!-- ============= Custom Styles for Contact Page Start ============== -->
    <!-- =================================================================== -->
    <style>
      /* Main font for the body */
      body {
        font-family: 'Poppins', sans-serif;
      }
      
      /* Styling for the contact page section */
      .contact-page .section-heading h6 {
        font-size: 1rem;
        color: #8a2be2;
        font-weight: 600;
      }
      .contact-page .section-heading h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 25px;
      }
      .contact-page p {
        color: #4a4a4a;
        font-size: 0.95rem;
        line-height: 1.8;
      }

      /* Styling for the contact info cards */
      .contact-item {
        display: flex;
        align-items: center;
        background-color: #f7f7f7;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        transition: all .3s ease-in-out;
        border: 1px solid #eee;
      }
      .contact-item:hover {
        background-color: #fff;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.08);
        transform: translateY(-5px);
      }
      .contact-item .icon {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #8a2be2;
        color: #fff;
        font-size: 24px;
        border-radius: 50%;
        margin-right: 20px;
      }
      .contact-item h6 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #1e1e1e;
      }
      .contact-item h6 span {
        font-size: 1rem;
        font-weight: 500;
        color: #4a4a4a;
        display: block;
      }
      
      /* Style for the clickable phone number link */
      .contact-item h6 span a {
        color: inherit; /* Inherit color from the parent span */
        text-decoration: none; /* Remove underline */
        transition: color .3s;
      }
      .contact-item h6 span a:hover {
        color: #8a2be2; /* Add a hover effect */
      }

      /* Styling for the contact form */
      #contact-form {
        background: #fff;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.09);
      }
      #contact-form label {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
      }
      #contact-form input,
      #contact-form textarea {
        margin-bottom: 20px;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        transition: border-color .3s;
        width: 100%; /* Ensure full width */
      }
      #contact-form input:focus,
      #contact-form textarea:focus {
        border-color: #8a2be2;
        box-shadow: none;
      }
      #contact-form input::placeholder,
      #contact-form textarea::placeholder {
        color: #aaa;
      }
      #contact-form .orange-button {
        width: 100%;
        padding: 14px;
        font-size: 1.1rem;
        font-weight: 600;
      }
      input[readonly] {
          cursor: not-allowed;
          background-color: #e9ecef !important;
      }

      /* Styling for the login prompt message */
      .login-prompt {
          padding: 60px 40px;
          border-radius: 15px;
          font-size: 1.15rem;
          background-color: #fff;
          border: 1px solid #eee;
          box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
      }
      .login-prompt .fa-exclamation-triangle {
          color: #8a2be2;
      }
      .login-prompt .alert-heading {
          font-weight: 700;
          color: #1e1e1e;
      }
       .login-prompt .orange-button {
         padding: 10px 25px;
         font-size: 1rem;
       }
       
      /* Inherited styles for login/register buttons from the first file */
      .button2{display:inline-block;position:relative;transition:all .2s;color:#222;background:#fff;border:none;border-radius:15px;font-size:15px;font-weight:700;padding:.4em 1.2em;margin:0 6px;box-shadow:none;cursor:pointer;outline:0;z-index:1;letter-spacing:.5px;font-family:Poppins,Arial,sans-serif;display:inline-flex;align-items:center;justify-content:center;gap:6px}.user-display-style{min-width:100px;text-align:center;height:40px}.button2:hover{background:#8a2be2;color:#fff;transform:translateY(-2px) scale(1.04)}.auth-buttons-container{margin-left:auto;display:flex;align-items:center;height:40px;border-radius:0;padding:0;box-shadow:none;position:relative;top:0;justify-content:center;margin-top:-30px}.visitor-buttons{display:flex;align-items:center;justify-content:center;gap:8px;width:100%}.icon-wrapper{display:none!important}.auth-btn{background:0 0!important;box-shadow:none!important;padding:0!important;min-width:unset!important;height:auto!important}.user-display-style{cursor:default}.user-display-style:hover{background:#fff;color:#222;transform:none}@media (max-width:991px){.auth-buttons-container{height:auto;padding:0;border-radius:0;top:0;justify-content:center}.button2{font-size:13px;padding:.3em .8em;margin:0 3px}}
    </style>
    <!-- ============= Custom Styles for Contact Page End ================ -->
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

  <!-- Sub Header -->
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
            <!--  تمت إضافة زر Facebook هنا -->
            <li><a href="https://www.facebook.com/share/1EF99Va8M5/?mibextid=wwXIfr"><i class="fab fa-facebook"></i></a></li>
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="properties.php">Our Services</a></li>
                            <li><a href="property-details.php">Packages</a></li>
                            <li><a href="contact.php" class="active">Contact Us</a></li>
                          
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
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="index.php">Home</a>  /  Contact Us</span>
          <h3>Contact Us</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================================================================== -->
  <!-- =================== Final & Modified Code Start =================== -->
  <!-- ===================================================================== -->
<div class="contact-page section">
  <div class="container">
    <div class="row">
      <?php
      // Check login status to display the appropriate content
      if (isset($_SESSION['user_id'])) {
      ?>
        <!-- Content for logged-in user -->
        <div class="col-lg-6">
          <div class="section-heading">
            <h6>| Contact Us</h6>
            <h2>Get In Touch With Our Agents</h2>
          </div>
          <p>We're here to help you find your dream property. Feel free to contact us by phone, email, or social media. Our team is ready to answer all your questions and schedule a visit to the properties that interest you.</p>
          <div class="row">
            <div class="col-lg-12 mb-3">
              <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="https://www.facebook.com/share/1EF99Va8M5/?mibextid=wwXIfr" target="_blank" class="btn btn-primary" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://x.com/minthu" target="_blank" class="btn btn-info" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fab fa-twitter"></i> Twitter/X</a>
                <a href="#" class="btn btn-secondary" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <a href="#" class="btn btn-danger" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="mailto:viralxagency12@gmail.com" class="btn btn-dark" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fas fa-envelope"></i> Email</a>
                <a href="tel:+201098539907" class="btn btn-success" style="min-width:120px;display:flex;align-items:center;gap:8px;"><i class="fas fa-phone-alt"></i> Call Us</a>
                <a href="https://wa.me/201098539907" target="_blank" class="btn btn-success" style="min-width:120px;display:flex;align-items:center;gap:8px;background:#25D366;border:none;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-6">
          <form id="contact-form" action="handle_contact.php" method="post">
            <div class="row">
              <div class="col-lg-12">
                <fieldset>
                  <label for="name">Full Name</label>
                  <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="email">Email Address</label>
                  <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" placeholder="Your Email Address..." required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Subject</label>
                  <input type="text" name="subject" id="subject" placeholder="Subject..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="message">Message</label>
                  <textarea name="message" id="message" placeholder="Your Message..." required></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12 mb-2">
                <div class="alert alert-info text-center" style="font-size:1rem;">
                  <i class="fas fa-info-circle"></i> Your message will be sent directly to the admin to ensure your comfort and privacy.
                </div>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        


      <?php
      } else {
        // Content for visitors (not logged in)
      ?>
        <div class="col-lg-12">
            <div class="login-prompt text-center">
                <i class="fa fa-exclamation-triangle fa-3x mb-4"></i>
                <h4 class="alert-heading">You Must Be Logged In!</h4>
                <p class="my-4">
                    To get in touch with our team and use our services, please log in to your account.<br>
                    If you don't have an account, you can create a new one quickly and easily.
                </p>
                <hr>
                <div class="mt-4">
                    <a href="login.php" class="orange-button" style="text-decoration: none; margin-right: 15px;">Login</a>
                    <a href="register.php" class="orange-button" style="text-decoration: none; background-color: #2a2a2a;">Create a New Account</a>
                </div>
            </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<!-- =================== Final & Modified Code End ==================== -->
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
        <br>
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