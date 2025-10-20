<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment...</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <script>
        // In resources/views/front/payment/redirect.blade.php
        document.addEventListener('DOMContentLoaded', function () {
            const options = @json($paymentPayload);

            // console.log('Payment options:', options);

            options.handler = async function (response) {
                // console.log('Payment response:', response);

                try {
                    const verifyRes = await fetch("{{ route('front.payment.razorpay.verify') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature: response.razorpay_signature,
                            order_id: "{{ $order->id }}"
                        }),
                    });

                    const verifyJson = await verifyRes.json();
                    // console.log('Verification response:', verifyJson);

                    if (verifyRes.ok && verifyJson.status) {
                        // Success - redirect to thank you page
                        window.location.href = verifyJson.redirect_url || "{{ route('front.order.thankyou', ['orderId' => $order->id]) }}";
                    } else {
                        // Failure - redirect back to checkout with error
                        alert(verifyJson.message || 'Payment verification failed');
                        window.location.href = "{{ route('front.checkout.index') }}";
                    }
                } catch (error) {
                    console.error('Verification error:', error);
                    alert('An error occurred during payment verification');
                    // window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            options.modal = {
                ondismiss: function() {
                    // User closed the modal without payment
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            // Add error handler
            options.error = function(error) {
                console.error('Razorpay error:', error);
                alert('Payment failed: ' + (error.description || 'Unknown error'));
                window.location.href = "{{ route('front.checkout.index') }}";
            };

            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
</body>
</html>