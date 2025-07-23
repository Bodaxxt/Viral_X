<?php
// ملف: capture_payment.php (متوافق مع V2)
session_start();
require 'paypal_api_helper.php';
require 'config/db.php';

$data = json_decode(file_get_contents("php://input"));
$orderID = htmlspecialchars($data->orderID ?? null);

header('Content-Type: application/json');

if (!$orderID) {
    http_response_code(400);
    echo json_encode(['error' => 'Order ID is missing.']);
    exit;
}

try {
    $accessToken = get_paypal_access_token();
    $url = (PAYPAL_ENVIRONMENT == 'sandbox') ? "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderID}/capture" : "https://api-m.paypal.com/v2/checkout/orders/{$orderID}/capture";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json', 'Authorization: Bearer ' . $accessToken ]);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code != 201) { throw new Exception($response); }

    $details = json_decode($response);
    
    $user_id = $_SESSION['user_id'] ?? 0;
    $package = 'Gold';
    $amount = $details->purchase_units[0]->payments->captures[0]->amount->value;
    $transaction_id = $details->id;

    $stmt = $conn->prepare("INSERT INTO payments (user_id, package, expected_amount, paid_amount, transaction_id, status) VALUES (?, ?, ?, ?, ?, 'approved')");
    $stmt->bind_param("isdds", $user_id, $package, $amount, $amount, $transaction_id);
    $stmt->execute();
    
    echo $response;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>