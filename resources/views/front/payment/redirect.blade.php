<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment...</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const options = @json($paymentPayload);

            console.log('options>>', options);
            

            options.handler = async function (response) {
                // Send verification request
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
                console.log('verifyJson>>', verifyJson);

                if (verifyRes.ok && verifyJson.status) {
                    window.location.href = "{{ route('front.order.thankyou', ['orderId' => $order->id]) }}";
                } else {
                    alert(verifyJson.message || 'Payment verification failed');
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            options.modal = {
                ondismiss: function() {
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
</body>
</html>