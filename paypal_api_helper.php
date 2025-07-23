<?php

define('PAYPAL_CLIENT_ID', 'YOUR_CLIENT_ID_HERE');
define('PAYPAL_SECRET', 'YOUR_SECRET_HERE');
define('PAYPAL_ENVIRONMENT', 'sandbox'); // أو live

function get_paypal_access_token() {
    $url = (PAYPAL_ENVIRONMENT == 'sandbox')
        ? 'https://api.sandbox.paypal.com/v1/oauth2/token '
        : 'https://api.paypal.com/v1/oauth2/token ';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ":" . PAYPAL_SECRET);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    $response = curl_exec($ch);
    curl_close($ch);

    $jsonData = json_decode($response);
    return $jsonData->access_token;
}