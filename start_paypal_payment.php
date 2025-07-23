<?php
// ملف: start_paypal_payment.php (النسخة النهائية مع حل مشكلة الامتثال)
session_start();

require 'paypal_config.php';
require 'config/db.php'; 

// تحقق من وجود القيم المطلوبة
if (empty($_POST['package']) || empty($_POST['package_price'])) {
    die('خطأ: لم يتم إرسال اسم الباقة أو السعر بشكل صحيح. يرجى الرجوع واختيار الباقة من جديد.');
}

// 1. الحصول على رمز الوصول (Access Token)
$ch_token = curl_init();
curl_setopt($ch_token, CURLOPT_URL, PAYPAL_API_URL . '/v1/oauth2/token');
curl_setopt($ch_token, CURLOPT_POST, true);
curl_setopt($ch_token, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_token, CURLOPT_USERPWD, PAYPAL_SANDBOX_CLIENT_ID . ":" . PAYPAL_SANDBOX_SECRET);
curl_setopt($ch_token, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch_token, CURLOPT_HTTPHEADER, ['Accept: application/json']);
$token_response = curl_exec($ch_token);
curl_close($ch_token);
$accessToken = json_decode($token_response)->access_token;

// 2. تجهيز بيانات الطلب
$price = $_POST['package_price'] ?? '0.00';
$packageName = $_POST['package'] ?? 'Default Package';
$returnUrl = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/paypal_return.php';

// ====================== [ بداية التعديل المهم ] ======================
$payload = json_encode([
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "description" => $packageName,
        "amount" => [
            "currency_code" => "USD",
            "value" => $price
        ],
        // نخبر باي بال صراحةً لمن يجب أن تذهب الأموال
// ... (داخل ملف start_paypal_payment.php)
        "payee" => [
            // ✅ 3. ضع هنا ايميل حسابك البزنس الحقيقي
            "email_address" => "zeinab.tw15@gmail.com" 
        ]
// ...
    ]],
    "application_context" => [
        "return_url" => $returnUrl . "?success=true",
        "cancel_url" => $returnUrl . "?success=false",
        "brand_name" => "El-Tawfik Agency",
        "user_action" => "PAY_NOW"
    ]
]);
// ======================= [ نهاية التعديل المهم ] =======================


// 3. إرسال طلب إنشاء الطلب إلى باي بال
$ch_order = curl_init();
curl_setopt($ch_order, CURLOPT_URL, PAYPAL_API_URL . '/v2/checkout/orders');
curl_setopt($ch_order, CURLOPT_POST, true);
curl_setopt($ch_order, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_order, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken ]);
curl_setopt($ch_order, CURLOPT_POSTFIELDS, $payload);
$order_response = curl_exec($ch_order);
curl_close($ch_order);
$order_details = json_decode($order_response);

// 4. توجيه العميل إلى رابط الموافقة على الدفع
if (isset($order_details->links)) {
    foreach ($order_details->links as $link) {
        if ($link->rel == 'approve') {
            header("Location: " . $link->href);
            exit();
        }
    }
}

die("Could not create PayPal order. Response: " . $order_response);
