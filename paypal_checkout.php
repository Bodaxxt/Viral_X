<?php 
    // يمكنك إضافة include 'session.php'; هنا إذا أردت
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Complete Your Payment</title>
    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 80vh; font-family: sans-serif; background-color: #f7f7f7; }
        #checkout-container { width: 100%; max-width: 500px; padding: 20px; box-shadow: 0 0 15px rgba(0,0,0,0.1); border-radius: 8px; background-color: #fff;}
        #result-message { text-align: center; margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div id="checkout-container">
        <h3>Pay with PayPal</h3>
        <p>You are about to pay for the 'Gold' package.</p>
        <p><strong>Amount: $499.00 USD</strong></p>
        <hr>
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>
    </div>

    <!-- ✅ 1. استخدام المكتبة الحديثة والصحيحة (V2 SDK) من المصدر الرسمي -->
    <script src="https://www.paypal.com/sdk/js?client-id=AaM7IA8Fe7zVRtf2sjJvyzzC5ulAa8myMdSXQG1cTjon4SP-ehfSzkvFww8eZ_p_3xL4Xi83wKoXQpF3¤cy=USD"></script>
    
    <!-- ✅ 2. كود JavaScript الصحيح للـ V2 SDK -->
    <script>
        // نتأكد من أن الكائن paypal موجود قبل استخدامه
        if (window.paypal) {
            paypal.Buttons({
                createOrder: async function() {
                    try {
                        const response = await fetch("create_order.php", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ package_price: "499.00" })
                        });
                        const orderData = await response.json();
                        if (orderData.id) return orderData.id;
                        throw new Error(orderData.error || "Could not create order.");
                    } catch (error) {
                        console.error("Error in createOrder:", error);
                        document.getElementById('result-message').innerHTML = `<span style="color:red;">Error creating order.</span>`;
                    }
                },
                onApprove: async function(data, actions) {
                    try {
                        const response = await fetch(`capture_payment.php`, {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify({ orderID: data.orderID })
                        });
                        const orderDetails = await response.json();
                        if (orderDetails.error) {
                            throw new Error(orderDetails.error);
                        }
                        const transaction = orderDetails.purchase_units[0].payments.captures[0];
                        const message = `Transaction ${transaction.status}: ${transaction.id}.<br>Payment successful!`;
                        document.getElementById('result-message').innerHTML = `<span style="color:green;">${message}</span>`;
                        document.getElementById('paypal-button-container').style.display = 'none';
                    } catch (error) {
                        console.error("Error in onApprove:", error);
                        document.getElementById('result-message').innerHTML = `<span style="color:red;">Error processing payment.</span>`;
                    }
                },
                onError: function (err) {
                    // عرض الأخطاء التي تحدث أثناء عملية الدفع نفسها
                    console.error('PayPal button error:', err);
                    document.getElementById('result-message').innerHTML = `<span style="color:red;">An error occurred with PayPal.</span>`;
                }
            }).render("#paypal-button-container");
        } else {
            // هذه الرسالة ستظهر فقط إذا فشل تحميل السكربت من المصدر
            document.getElementById('result-message').innerHTML = '<span style="color:red;">Failed to load PayPal script. Please check your browser extensions or network settings.</span>';
        }
    </script>
</body>
</html>