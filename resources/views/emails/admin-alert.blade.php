<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #dc3545; }
        .header { background-color: #2d3748; padding: 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .alert-badge { display: inline-block; background-color: #fee2e2; color: #ef4444; padding: 6px 12px; border-radius: 4px; font-weight: bold; margin-bottom: 20px; font-size: 14px; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid #edf2f7; }
        .data-table th { background-color: #f8fafc; color: #4a5568; width: 40%; font-weight: 600; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #a0aec0; background-color: #f8fafc; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KEMET Admin Alert</h1>
        </div>
        <div class="content">
            <div class="alert-badge">🚨 New Booking Received</div>
            <p>A new automated booking has been secured on the platform. Please review the details below:</p>
            
            <table class="data-table">
                <tr>
                    <th>Booking ID</th>
                    <td><strong>{{ $bookingData['booking_id'] }}</strong></td>
                </tr>
                <tr>
                    <th>Item Type</th>
                    <td>{{ ucfirst($bookingData['item_type']) }}</td>
                </tr>
                <tr>
                    <th>Target Subject (ID)</th>
                    <td>{{ $bookingData['item_id'] }}</td>
                </tr>
                <tr>
                    <th>Date Information</th>
                    <td>{{ $bookingData['date_info'] }}</td>
                </tr>
                <tr>
                    <th>Number of Guests</th>
                    <td>{{ $bookingData['guests'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Total Revenue</th>
                    <td style="color: #059669; font-weight: bold;">{{ $bookingData['total_price'] }} EGP</td>
                </tr>
                <tr>
                    <th>User ID (Customer)</th>
                    <td>{{ $bookingData['user_id'] }}</td>
                </tr>
            </table>

            <p style="margin-top: 30px; font-size: 13px; color: #718096;">
                Please ensure operational readiness for this booking. You can view full customer details in the admin database.
            </p>
        </div>
        <div class="footer">
            System Generated Alert from KEMET Backend
        </div>
    </div>
</body>
</html>
