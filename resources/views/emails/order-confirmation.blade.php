<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sipariş Onayı</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #334155; background: #f8fafc; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .header { background: #0b3d2e; color: #fff; padding: 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 1.5rem; }
        .content { padding: 24px; }
        .order-number { font-size: 1.25rem; font-weight: 700; color: #0b3d2e; margin-bottom: 16px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        .info-table th { text-align: left; padding: 8px 0; color: #64748b; font-weight: 500; font-size: 0.875rem; width: 120px; }
        .info-table td { padding: 8px 0; }
        .items-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .items-table th { background: #f1f5f9; padding: 12px; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: #64748b; }
        .items-table td { padding: 12px; border-bottom: 1px solid #e2e8f0; }
        .items-table tr:last-child td { border-bottom: none; }
        .total-row { font-weight: 700; font-size: 1.125rem; color: #0b3d2e; }
        .btn { display: inline-block; padding: 12px 24px; background: #0b3d2e; color: #fff !important; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 16px; }
        .footer { padding: 16px 24px; background: #f8fafc; font-size: 0.75rem; color: #94a3b8; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p style="margin: 8px 0 0; opacity: 0.9;">Sipariş Onayı</p>
        </div>
        <div class="content">
            <p>Merhaba {{ $order->full_name }},</p>
            <p>Siparişiniz başarıyla alındı. Detaylar aşağıda yer almaktadır.</p>

            <p class="order-number">Sipariş No: {{ $order->order_number }}</p>

            <table class="info-table">
                <tr><th>Ad Soyad</th><td>{{ $order->full_name }}</td></tr>
                <tr><th>E-posta</th><td>{{ $order->email }}</td></tr>
                <tr><th>Telefon</th><td>{{ $order->phone }}</td></tr>
                <tr><th>Teslimat</th><td>{{ $order->address }}, {{ $order->district }}, {{ $order->city }}</td></tr>
                @if($order->notes)
                <tr><th>Not</th><td>{{ $order->notes }}</td></tr>
                @endif
            </table>

            <table class="items-table">
                <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Adet</th>
                        <th>Fiyat</th>
                        <th style="text-align: right;">Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}{{ $item->variant_name ? ' (' . $item->variant_name . ')' : '' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2, ',', '.') }} ₺</td>
                        <td style="text-align: right;">{{ number_format($item->total, 2, ',', '.') }} ₺</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr><td colspan="3" style="text-align: right;">Ara Toplam</td><td style="text-align: right;">{{ number_format($order->subtotal, 2, ',', '.') }} ₺</td></tr>
                    @if($order->discount > 0)
                    <tr><td colspan="3" style="text-align: right;">İndirim</td><td style="text-align: right;">-{{ number_format($order->discount, 2, ',', '.') }} ₺</td></tr>
                    @endif
                    @if($order->shipping_cost > 0)
                    <tr><td colspan="3" style="text-align: right;">Kargo</td><td style="text-align: right;">{{ number_format($order->shipping_cost, 2, ',', '.') }} ₺</td></tr>
                    @endif
                    <tr class="total-row"><td colspan="3" style="text-align: right;">Genel Toplam</td><td style="text-align: right;">{{ number_format($order->total, 2, ',', '.') }} ₺</td></tr>
                </tfoot>
            </table>

            <a href="{{ route('account.orders.show', $order) }}" class="btn">Siparişi Görüntüle</a>
        </div>
        <div class="footer">
            {{ config('app.name') }} · Bu e-posta sipariş onayı için otomatik gönderilmiştir.
        </div>
    </div>
</body>
</html>
