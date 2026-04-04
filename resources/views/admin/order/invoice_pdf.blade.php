<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #f5f6fa;
            padding: 20px;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
        }

        /* Header */
        .header table {
            width: 100%;
        }

        .header td {
            border: none;
            vertical-align: middle;
        }

        .logo {
            width: 120px;
        }

        .invoice-info {
            text-align: right;
        }

        .invoice-info h2 {
            margin: 0;
        }

        /* Customer Info */
        .customer-info {
            margin-top: 20px;
        }

        .customer-info p {
            margin: 3px 0;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Product Image */
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        /* Total */
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="invoice-box">

        <!-- Header -->
        <div class="header">
            <table>
                <tr>
                    {{-- <td>
                        <img src="{{ public_path('frontendAsset/images/logo.webp') }}" class="logo">
                    </td> --}}
                    @php
                        $logo = public_path('frontendAsset/images/logo.webp');
                    @endphp

                    @if (file_exists($logo))
                        <td>
                            <img src="{{ $logo }}" class="logo">
                        </td>
                    @else
                        <span>No Logo</span>
                    @endif
                    <td class="invoice-info">
                        <h4>INVOICE <strong>#{{ $order->id }}</strong></h4>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <p><strong>Customer Name:</strong> {{ $order->name ?? 'N/A' }}</p>
            <p><strong>Customer Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
            <p><strong>Customer Address:</strong> {{ $order->address ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
        </div>

        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Delivery</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ Str::limit($order->product->name ?? 'N/A', 15) }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->delivary_charge }}</td>
                    <td>{{ $order->product->price }}</td>

                    <td>
                        @php
                            $imagePath = public_path($order->product->image);
                        @endphp

                        @if (file_exists($imagePath))
                            <img src="{{ $imagePath }}" class="product-img">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>

                    <td>{{ $order->total_price }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="total">
            Grand Total: {{ $order->total_price }}
        </div>

    </div>

</body>

</html>
