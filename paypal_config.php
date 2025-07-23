<?php
// ملف: paypal_config.php (النسخة النهائية للعمل الحقيقي)

// مفاتيح وضع الاختبار (Sandbox) - احتفظ بها للرجوع إليها
define('PAYPAL_SANDBOX_CLIENT_ID', 'AYcnDTG4Svanm_GiXvCmTVp6o93858RrDV2b2MtZlUuJ7k4B_V7v41BmTegSKWQwR4nmULSSK6AAZWJE');
define('PAYPAL_SANDBOX_SECRET', 'ENttyJfBAKxX2KtjCuWao_Av_jj1alJ-MIpKFR4D6wn-ftNXSD2ZRyf9A-TGc5kuP9OBoAuQmeurXxRI');

// ✅ 1. المفاتيح الحقيقية التي أرسلتها (تم وضعها هنا)
define('PAYPAL_LIVE_CLIENT_ID', 'AYcnDTG4Svanm_GiXvCmTVp6o93858RrDV2b2MtZlUuJ7k4B_V7v41BmTegSKWQwR4nmULSSK6AAZWJE'); 
define('PAYPAL_LIVE_SECRET', 'ENttyJfBAKxX2KtjCuWao_Av_jj1alJ-MIpKFR4D6wn-ftNXSD2ZRyf9A-TGc5kuP9OBoAuQmeurXxRI');

// ✅ 2. غيّر هذه إلى 'live' لتفعيل الدفع الحقيقي
define('PAYPAL_ENVIRONMENT', 'live'); 

// ====================================================================
// الكود التالي يقوم بالتبديل بين المفاتيح تلقائيًا (لا تغيره)
// ====================================================================

if (PAYPAL_ENVIRONMENT == 'sandbox') {
    define('PAYPAL_API_URL', 'https://api-m.sandbox.paypal.com');
    define('PAYPAL_CLIENT_ID', PAYPAL_SANDBOX_CLIENT_ID);
    define('PAYPAL_SECRET', PAYPAL_SANDBOX_SECRET);
} else {
    define('PAYPAL_API_URL', 'https://api-m.paypal.com');
    define('PAYPAL_CLIENT_ID', PAYPAL_LIVE_CLIENT_ID);
    define('PAYPAL_SECRET', PAYPAL_LIVE_SECRET);
}

