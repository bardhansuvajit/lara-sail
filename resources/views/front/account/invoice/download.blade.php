<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        @page {
            margin: 20px;
            size: A4 portrait;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-info {
            float: left;
            width: 50%;
        }
        .invoice-info {
            float: right;
            width: 45%;
            text-align: right;
        }
        .clear {
            clear: both;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background-color: #f8f9fa;
            padding: 8px 12px;
            font-weight: bold;
            border-left: 4px solid #333;
            margin-bottom: 15px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        .address-box, .payment-box, .summary-box {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .items-table th {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .status-timeline {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .status-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .status-icon.pending {
            background-color: #6c757d;
        }
        .status-details {
            flex-grow: 1;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .mb-1 {
            margin-bottom: 5px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .mt-2 {
            margin-top: 10px;
        }
        .border-top {
            border-top: 2px solid #333;
            padding-top: 10px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .summary-total {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1 style="margin: 0 0 10px 0; font-size: 24px;">{{ config('app.name', 'Your Store') }}</h1>
            <p style="margin: 0; color: #666;">Order Invoice</p>
        </div>
        <div class="invoice-info">
            <h2 style="margin: 0 0 10px 0; font-size: 20px;">INVOICE</h2>
            <p style="margin: 0;"><strong>Invoice #:</strong> {{ $order->order_number }}</p>
            <p style="margin: 0;"><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
            <p style="margin: 0;"><strong>Time:</strong> {{ $order->created_at->format('h:i A') }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="grid-3">
        <div class="address-box">
            <h3 style="margin: 0 0 10px 0; font-size: 14px;">SHIPPING ADDRESS</h3>
            @if($order->shipping_address)
                @php
                    $shippingAddress = is_string($order->shipping_address) ? json_decode($order->shipping_address, true) : $order->shipping_address;
                @endphp
                @if(is_array($shippingAddress))
                    <p class="mb-1">{{ $shippingAddress['first_name'] ?? '' }} {{ $shippingAddress['last_name'] ?? '' }}</p>
                    <p class="mb-1">{{ $shippingAddress['address_line1'] ?? '' }}</p>
                    @if($shippingAddress['address_line2'] ?? '')
                        <p class="mb-1">{{ $shippingAddress['address_line2'] }}</p>
                    @endif
                    <p class="mb-1">{{ $shippingAddress['city'] ?? '' }}, {{ $shippingAddress['state'] ?? '' }} {{ $shippingAddress['zip_code'] ?? '' }}</p>
                    <p class="mb-1">{{ $shippingAddress['country'] ?? '' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone_no }}</p>
                @else
                    <p>{{ $order->shipping_address }}</p>
                @endif
            @else
                <p>No shipping address provided</p>
            @endif
        </div>

        <div class="payment-box">
            <h3 style="margin: 0 0 10px 0; font-size: 14px;">PAYMENT METHOD</h3>
            <p class="mb-1"><strong>Method:</strong> {{ $order->payment_method_title ? ucwords($order->payment_method_title) : 'Not Specified' }}</p>
            <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            @if($order->transaction_id)
                <p class="mb-1"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
            @endif
            <p class="mb-1"><strong>Billing:</strong> {{ $order->same_as_shipping ? 'Same as shipping' : 'Different address' }}</p>
        </div>

        <div class="summary-box">
            <h3 style="margin: 0 0 10px 0; font-size: 14px;">ORDER SUMMARY</h3>
            <div class="summary-row">
                <span>Items ({{ $order->total_items }}):</span>
                <span>{{ $order->currency_symbol }}{{ number_format($order->mrp, 2) }}</span>
            </div>
            @if($order->coupon_discount_amount > 0)
            <div class="summary-row">
                <span>Discount:</span>
                <span>-{{ $order->currency_symbol }}{{ number_format($order->coupon_discount_amount, 2) }}</span>
            </div>
            @endif
            <div class="summary-row">
                <span>Shipping:</span>
                <span>{{ $order->currency_symbol }}{{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            @if($order->tax_amount > 0)
            <div class="summary-row">
                <span>Tax:</span>
                <span>{{ $order->currency_symbol }}{{ number_format($order->tax_amount, 2) }}</span>
            </div>
            @endif
            @if($order->payment_method_charge > 0)
            <div class="summary-row">
                <span>Payment Charge:</span>
                <span>{{ $order->currency_symbol }}{{ number_format($order->payment_method_charge, 2) }}</span>
            </div>
            @endif
            <div class="border-top mt-2">
                <div class="summary-row summary-total">
                    <span>ORDER TOTAL:</span>
                    <span>{{ $order->currency_symbol }}{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">ORDER ITEMS</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Variation</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td>{{ $item->variation_attributes ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">{{ $order->currency_symbol }}{{ number_format($item->selling_price, 2) }}</td>
                    <td style="text-align: right;">{{ $order->currency_symbol }}{{ number_format($item->selling_price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">ORDER STATUS TIMELINE</div>
        <div class="status-timeline">
            <div class="status-item">
                <div class="status-icon"></div>
                <div class="status-details">
                    <strong>Order Placed</strong>
                    <p class="mb-1">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ $order->paid_at ? '' : 'pending' }}"></div>
                <div class="status-details">
                    <strong>Payment {{ $order->paid_at ? 'Completed' : 'Pending' }}</strong>
                    <p class="mb-1">
                        {{ $order->paid_at ? $order->paid_at->format('M d, Y \a\t h:i A') : 'Waiting for payment' }}
                    </p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ $order->processed_at ? '' : 'pending' }}"></div>
                <div class="status-details">
                    <strong>Processing</strong>
                    <p class="mb-1">
                        {{ $order->processed_at ? $order->processed_at->format('M d, Y \a\t h:i A') : 'In progress' }}
                    </p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ $order->shipped_at ? '' : 'pending' }}"></div>
                <div class="status-details">
                    <strong>Shipped</strong>
                    <p class="mb-1">
                        {{ $order->shipped_at ? $order->shipped_at->format('M d, Y \a\t h:i A') : 'Not shipped yet' }}
                    </p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-icon {{ $order->delivered_at ? '' : 'pending' }}"></div>
                <div class="status-details">
                    <strong>Delivered</strong>
                    <p class="mb-1">
                        {{ $order->delivered_at ? $order->delivered_at->format('M d, Y \a\t h:i A') : 'Not delivered yet' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center; color: #666;">
        <p>Thank you for your business!</p>
        <p>If you have any questions, please contact our support team.</p>
    </div>
</body>
</html>