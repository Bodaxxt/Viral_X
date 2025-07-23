<?php
session_start();
require 'session.php';
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=" . urlencode(htmlspecialchars("يجب عليك تسجيل الدخول للاشتراك في باقة.")));
    exit();
}

if (!isset($_POST['package'])) {
    header("Location: property-details.php?error=" . urlencode(htmlspecialchars("الرجاء تحديد باقة أولاً.")));
    exit();
}

$package = htmlspecialchars($_POST['package']);

$package_prices = [
    'bronze'   => 199,
    'silver'   => 349,
    'gold'     => 499,
    'platinum' => 799,
];

if (!array_key_exists($package, $package_prices)) {
    header("Location: property-details.php?error=" . urlencode(htmlspecialchars("باقة غير صالحة.")));
    exit();
}
$price = htmlspecialchars($package_prices[$package]);

try {
    $sql = "SELECT username, email FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: logout.php?error=" . urlencode(htmlspecialchars("لم يتم العثور على معلومات المستخدم. الرجاء تسجيل الدخول مرة أخرى.")));
        exit();
    }
    $username = htmlspecialchars($user['username']);
    $email = htmlspecialchars($user['email']);
} catch (PDOException $e) {
    error_log("checkout_package.php: Database error: " . $e->getMessage());
    header("Location: property-details.php?error=" . urlencode(htmlspecialchars("حدث خطأ أثناء جلب معلومات المستخدم. الرجاء المحاولة مرة أخرى.")));
    exit();
}

// مفاتيح تجريبية نموذجية (استبدلها بمفاتيحك الفعلية)
$apiKey = "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRBMk1EZ3pNU3dpYm1GdFpTSTZJbWx1YVhScFlXd2lmUS44VmVpVmtWSlkxRC1fQ2ZKRFJpM1FNWktEX1lBQ0M1ZnMtazRQSkVtUGxKNHdqLTdDZV9MVlZFM2hIUnV1Z1RmVU1tRWlaM3lTOUpZMUJJR2ZENkpGdw==";
$integrationId = "5195872"; // تكامل Sandbox

// **هام: استبدل هذه القيم بمعلوماتك الحقيقية من Paymob**
// **هام: استبدل هذه القيم بمعلوماتك الحقيقية من Paymob**
$merchantId = "1060831"; // تم الاستبدال هنا
$apiKey = "ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2TVRBMk1EZ3pNU3dpYm1GdFpTSTZJbWx1YVhScFlXd2lmUS44VmVpVmtWSlkxRC1fQ2ZKRFJpM1FNWktEX1lBQ0M1ZnMtazRQSkVtUGxKNHdqLTdDZV9MVlZFM2hIUnV1Z1RmVU1tRWlaM3lTOUpZMUJJR2ZENkpGdw==";
$integrationId = "5195872"; // تكامل Sandbox // تم الاستبدال هنا
$iFrameId = "940496"; // !! iFrame ID هنا !!
$baseUrl = "https://accept.paymobsolutions.com/api/";

// 1. Autentication Request
$auth_url = $baseUrl . "auth/tokens";
$auth_data = ["api_key" => $apiKey];
$auth_json_result = sendPaymobRequest($auth_url, $auth_data);
$authToken = $auth_json_result["token"];
error_log("Token: " . $authToken);
// 2. Order Registration API
$order_url = $baseUrl . "ecommerce/orders";
// "url": "https://accept.paymobsolutions.com/standalone?ref=i_aYniF"
$order_data = [
    "auth_token" => $authToken,
    "delivery_needed" => "false",
    "amount_cents" => $price * 100, //  بالقرش
    "currency" => "EGP", 
    "merchant_order_id"=> uniqid(), // معرف فريد من  نظامك
    "items" => [] //  
];

$order_json_result = sendPaymobRequest($order_url, $order_data);

error_log("Order: " . print_r($order_json_result, true)); // تسجيل استجابة JSON كامله

$orderId = $order_json_result["id"];

// 3. Payment Key Request
    $payment_url = $baseUrl . "acceptance/payment_keys";
    $payment_data = [
        "auth_token" => $authToken,
        "amount_cents" => $price * 100,
        "expiration" => 3600,  // 1 hour 
        "order_id" => $orderId,
        "billing_data" => [
            "apartment" => "NA",
            "email" => $email,  //  الايميل
            "floor" => "NA",
            "first_name" => $username, //اسم  المستخدم
            "last_name" => "NA",//اسم  مستخدم وهمى (يمكنك تعديله إذا كان لديك الاسم الأخير)
            "phone_number" => "01111111111", 
            "street" => "NA",
            "building" => "NA",
            "city" => "NA", //  محافظه افتراضيه
            "country" => "EG",  //
            "postal_code" => "0000",
            "state" => "NA"
        ],
        "currency" => "EGP",
        "integration_id" => $integrationId
    ];

$payment_json_result = sendPaymobRequest($payment_url, $payment_data);

$paymentToken = $payment_json_result["token"];
//  تسجيل   ال  paymentToken
 error_log("Payment Token: " . $paymentToken);
// توجيه المستخدم الي صفحه  Paymob
  $iframe_url = "https://accept.paymobsolutions.com/api/acceptance/iframes/" . $iFrameId . "?payment_token=" . $paymentToken; // رابط  ال iframe

header("Location: " . $iframe_url);
exit();



function sendPaymobRequest($url, $data) {
    $json_request = json_encode($data);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json_request);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $json_response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($json_response, true);

   if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
        // مشكلة في json - تسجيل الخطأ و الرسالة
        error_log("Error decoding JSON: " . json_last_error_msg() . " from response: " . $json_response);
        die("Failed to decode JSON response."); // إنهاء التنفيذ في هذه الحالة
    }

    return $result;
}