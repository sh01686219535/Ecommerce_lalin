<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 15px;
            color: #333;
            background-color: #fff;
        }

        .invoice-container {
            border: 2px solid #1a4d2e;
            padding: 20px;
            position: relative;
            min-height: 950px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border: none;
        }

        .header-box {
            background-color: #1a4d2e;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 4px;
        }

        .header-box h1 { margin: 0; font-size: 22px; text-transform: uppercase; }
        .header-box p { margin: 5px 0 0; font-size: 10px; opacity: 0.9; }

        .watermark {
            position: absolute;
            top: 40%;
            left: 20%;
            opacity: 0.05;
            width: 400px;
            z-index: -1;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
            border-bottom: 1px solid #1a4d2e;
            padding-bottom: 10px;
            font-size: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .items-table th {
            background-color: #1a4d2e;
            color: white;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #1a4d2e;
        }

        .items-table td {
            border: 1px solid #d1e7dd;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        .total-row { background-color: #f8f9fa; font-weight: bold; }
        .footer-note { margin-top: 20px; color: #d9534f; font-size: 11px; font-style: italic; }
        .signature-section { margin-top: 60px; width: 100%; }

        .sig-box {
            width: 35%;
            border-top: 1px solid #333;
            text-align: center;
            display: inline-block;
            font-size: 11px;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        @php
            $logoPath = public_path('frontendAsset/images/logo.webp');
            $logoData = '';
            if (file_exists($logoPath)) {
                $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                $data = @file_get_contents($logoPath);
                if($data) {
                    $logoData = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            }
        @endphp

        @if ($logoData)
            <img src="{{ $logoData }}" class="watermark">
        @endif

        <table class="header-table" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100" valign="middle">
                    @if ($logoData)
                        <img src="{{ $logoData }}" style="width: 90px; height: auto;">
                    @else
                        <span style="font-weight: bold; font-size: 16px; color: #1a4d2e;">LOGO</span>
                    @endif
                </td>
                <td>
                    <div class="header-box">
                        <h1>BIKHYATA BAZAR DOT COM</h1>
                        <p>All kinds of Gadgets, Online Items, Wholesale & Retailer</p>
                        <p>Shop No-104, (2nd Floor) Kaptan Bazar Complex, Building-2, Gulistan, Dhaka-1203</p>
                    </div>
                </td>
            </tr>
        </table>

        <table class="info-table" cellspacing="0" cellpadding="0">
            <tr>
                <td width="60%"><strong>Customer:</strong> {{ $order->name ?? 'N/A' }}</td>
                <td width="40%" align="right"><strong>Invoice:</strong> #{{ $order->id }}</td>
            </tr>
            <tr>
                <td><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</td>
                <td align="right"><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</td>
            </tr>
            <tr>
                <td><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</td>
                <td align="right"><strong>Status:</strong> Paid</td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th width="10%">SL</th>
                    <th width="45%">Product Description</th>
                    <th width="10%">Qty</th>
                    <th width="15%">Price</th>
                    <th width="20%">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalPrice = 0; @endphp
                @if (isset($order->items) && $order->items->count() > 0)
                    @foreach ($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td align="left">{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                        </tr>
                        @php $totalPrice += $item->total; @endphp
                    @endforeach
                @else
                    <tr>
                        <td>1</td>
                        <td align="left">{{ $order->product->name ?? 'N/A' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->product->price ?? 0, 2) }}</td>
                        <td>{{ number_format($order->total_price ?? 0, 2) }}</td>
                    </tr>
                    @php $totalPrice = $order->total_price ?? 0; @endphp
                @endif
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" align="right">Grand Total:</td>
                    <td>{{ number_format($totalPrice, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer-note">
            * Note: Sold goods are not returnable.
        </div>

        <div class="signature-section">
            <div class="sig-box" style="float: left;">Customer Signature</div>
            <div class="sig-box" style="float: right;">Authorized Signature</div>
        </div>
    </div>

</body>
</html>