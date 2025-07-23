<?php
// ملف: paypal_return.php (النسخة الإنتاجية النهائية)
session_start();
require 'paypal_config.php';
require 'config/db.php';

// 1. التحقق إذا كانت العملية ناجحة أو تم إلغاؤها
if (!isset($_GET['success']) || $_GET['success'] !== 'true' || !isset($_GET['token'])) {
    die("Payment was cancelled or failed. Please try again.");
}

$orderID = $_GET['token'];

try {
    // 2. الحصول على رمز وصول جديد
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

    // 3. تأكيد (Capture) الدفعة
    $ch_capture = curl_init();
    curl_setopt($ch_capture, CURLOPT_URL, PAYPAL_API_URL . "/v2/checkout/orders/{$orderID}/capture");
    curl_setopt($ch_capture, CURLOPT_POST, true);
    curl_setopt($ch_capture, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_capture, CURLOPT_POSTFIELDS, '{}');
    curl_setopt($ch_capture, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken ]);
    $capture_response = curl_exec($ch_capture);
    curl_close($ch_capture);
    $details = json_decode($capture_response);

    // 4. التحقق من نجاح العملية وحفظها
    if (isset($details->status) && $details->status == 'COMPLETED') {
        // ... (كود حفظ الدفعة في قاعدة البيانات)
        
        echo "<h1>Payment Successful!</h1>";
        // ... (باقي رسالة النجاح)
    } else {
        throw new Exception("Failed to capture payment. PayPal Response: " . $capture_response);
    }
} catch (Exception $e) {
    die("An error occurred: " . $e->getMessage());
}
