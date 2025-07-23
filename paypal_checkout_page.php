<?php
// ملف: paypal_checkout_page.php (النسخة الديناميكية)
session_start();

// 1. استقبال بيانات الباقة من الصفحة السابقة
$packageName = $_POST['package_name'] ?? 'Default Package';
$packagePrice = $_POST['package_price'] ?? '0.00';

// 2. التحقق من أن السعر صحيح (حماية أساسية)
if (!is_numeric($packagePrice) || floatval($packagePrice) <= 0) {
    die("Invalid package price.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Payment</title>
    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 80vh; font-family: sans-serif; background-color: #f7f7f7; }
        .checkout-box { width: 100%; max-width: 500px; padding: 30px; box-shadow: 0 0 15px rgba(0,0,0,0.1); border-radius: 8px; background-color: #fff; text-align: center; }
    </style>
</head>
<body>
    <div class="checkout-box">
        <h3>Pay with PayPal</h3>
        <!-- 3. عرض البيانات الديناميكية -->
        <p>You are about to pay for the '<?php echo htmlspecialchars($packageName); ?>'.</p>
        <p><strong>Amount: $<?php echo htmlspecialchars($packagePrice); ?> USD</strong></p>
        <hr>
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=AYcnDTG4Svanm_GiXvCmTVp6o93858RrDV2b2MtZlUuJ7k4B_V7v41BmTegSKWQwR4nmULSSK6AAZWJE¤cy=USD"></script>
    <script>
        paypal.Buttons({
            createOrder: async function() {
                try {
                    const response = await fetch("start_paypal_payment.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        // 4. إرسال البيانات الديناميكية إلى الخادم
                        body: JSON.stringify({
                            package_name: "<?php echo addslashes($packageName); ?>",
                            package_price: "<?php echo addslashes($packagePrice); ?>"
                        })
                    });
                    const orderData = await response.json();
                    if (orderData.id) return orderData.id;
                    throw new Error(orderData.error || "Could not create order.");
                } catch (error) {
                    console.error("Error creating order:", error);
                    document.getElementById('result-message').innerHTML = `<span style="color:red;">Error creating order.</span>`;
                }
            },
            // ... (باقي كود onApprove كما هو)
        }).render("#paypal-button-container");
    </script>
</body>
</html>