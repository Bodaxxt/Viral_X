<?php
// ملف: create_order.php (متوافق مع V2)
require 'paypal_api_helper.php';

// يقرأ الـ JSON المرسل من الـ JavaScript الحديث
$data = json_decode(file_get_contents("php://input"));
$price = htmlspecialchars($data->package_price ?? '0.00');

header('Content-Type: application/json');

try {
    if (floatval($price) <= 0) {
        throw new Exception("Invalid price provided.");
    }
    $accessToken = get_paypal_access_token();
    $url = (PAYPAL_ENVIRONMENT == 'sandbox') 
    ? 'https://api-m.sandbox.paypal.com/v2/checkout/orders ' 
    : 'https://api-m.paypal.com/v2/checkout/orders ';
    
    $payload = json_encode([
        "intent" => "CAPTURE",
        "purchase_units" => [[
            "amount" => [ "currency_code" => "USD", "value" => $price ],
            "payee" => [ "email_address" => "sb-q5jmr30311456@business.example.com" ] // استخدم ايميل التاجر الوهمي
        ]]
    ]);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code != 201) throw new Exception($response);
    
    echo $response;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
