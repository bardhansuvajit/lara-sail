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

            // Customizations
            options.name = "{{ applicationSettings('company_name') }}";
            options.image = "{{ Storage::url('public/default/logo/logo-full.svg') }}";
            options.prefill = {
                name: "{{ $order->user->first_name.' '.$order->user->last_name ?? '' }}",
                email: "{{ $order->user->email ?? '' }}",
                contact: "{{ $order->user->primary_phone_no ?? '' }}"
            };

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
                    // console.error('Verification error:', error);
                    alert('An error occurred during payment verification');
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            /*
            options.modal = {
                ondismiss: function() {
                    alert('here');
                    // User closed the modal without payment
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            // Add error handler
            options.error = function(error) {
                // console.error('Razorpay error:', error);
                alert('Payment failed: ' + (error.description || 'Unknown error'));
                window.location.href = "{{ route('front.checkout.index') }}";
            };
            */

            options.modal = {
                ondismiss: async function() {
                    try {
                        await fetch("{{ route('front.payment.razorpay.fail') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                order_id: "{{ $order->id }}",
                                gateway_order_id: options.order_id,
                                failure_reason: 'payment_process_discontinued',
                                error_description: 'User closed the payment modal without completing payment'
                            }),
                        });
                    } catch (error) {
                        console.error('Failed to record payment dismissal:', error);
                    } finally {
                        window.location.href = "{{ route('front.checkout.index') }}";
                    }
                }
            };

            options.error = async function(error) {
                try {
                    await fetch("{{ route('front.payment.razorpay.fail') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            order_id: "{{ $order->id }}",
                            gateway_order_id: options.order_id,
                            failure_reason: 'payment_failed',
                            error_description: error.description || 'Unknown Razorpay error',
                            error_code: error.code || 'unknown',
                            // error_meta: error
                            error_meta: error,
                            // Add bank-specific error detection
                            is_bank_failure: error.source === 'bank' || 
                                           (error.description && error.description.toLowerCase().includes('bank')) ||
                                           (error.reason && error.reason.toLowerCase().includes('bank'))
                        }),
                    });
                } catch (fetchError) {
                    console.error('Failed to record payment error:', fetchError);
                } finally {
                    alert('Payment failed: ' + (error.description || 'Unknown error'));
                    window.location.href = "{{ route('front.checkout.index') }}";
                }
            };

            // Add payment capture failed handler for bank failures
            options.hooks = {
                onPaymentFailed: async function(paymentError) {
                    // This specifically handles bank payment failures after user entered bank details
                    if (paymentError.metadata && 
                        (paymentError.metadata.payment_capture_status === 'failed' || 
                         paymentError.metadata.payment_capture_status === 'bank_failed')) {
                        
                        try {
                            await fetch("{{ route('front.payment.razorpay.fail') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    order_id: "{{ $order->id }}",
                                    gateway_order_id: options.order_id,
                                    gateway_payment_id: paymentError.metadata.payment_id,
                                    failure_reason: 'bank_payment_failed',
                                    error_description: paymentError.error.description || 'Bank payment failed',
                                    error_code: paymentError.error.code || 'bank_failure',
                                    error_meta: paymentError,
                                    is_bank_failure: true,
                                    bank_error_details: {
                                        bank_reference: paymentError.metadata.bank_reference,
                                        failure_code: paymentError.metadata.failure_code,
                                        payment_method: paymentError.metadata.payment_method
                                    }
                                }),
                            });
                        } catch (fetchError) {
                            console.error('Failed to record bank payment failure:', fetchError);
                        }
                    }
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
</body>
</html>