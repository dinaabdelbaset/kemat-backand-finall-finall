<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background-color: #05073C; padding: 30px 20px; text-align: center; }
        .header h1 { color: #EB662B; margin: 0; font-size: 28px; letter-spacing: 2px; }
        .content { padding: 30px; }
        .success-badge { display: inline-block; background-color: #e6f7e9; color: #28a745; padding: 8px 16px; border-radius: 20px; font-weight: bold; margin-bottom: 20px; font-size: 14px; }
        .booking-details { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin-top: 20px; }
        .detail-row { display: flex; justify-content: space-between; border-bottom: 1px solid #edf2f7; padding: 12px 0; }
        .detail-row:last-child { border-bottom: none; font-weight: bold; font-size: 18px; color: #EB662B; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #718096; border-top: 1px solid #edf2f7; }
        .btn { display: inline-block; background-color: #EB662B; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 6px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KEMET</h1>
            <p style="color: #ffffff; margin-top: 5px;">Egypt Tourism & Booking</p>
        </div>
        <div class="content">
            <div class="success-badge">✓ Booking Confirmed</div>
            <h2>Hello {{ $bookingData['name'] ?? 'Traveler' }},</h2>
            <p>Thank you for choosing KEMET! Your booking has been successfully processed and confirmed. We are excited to host you.</p>
            
            <div class="booking-details">
                <div class="detail-row">
                    <span>Reference ID:</span>
                    <strong>{{ $bookingData['booking_id'] }}</strong>
                </div>
                <div class="detail-row">
                    <span>Type:</span>
                    <strong>{{ ucfirst($bookingData['item_type']) }}</strong>
                </div>
                <div class="detail-row">
                    <span>Date:</span>
                    <strong>{{ $bookingData['date_info'] }}</strong>
                </div>
                <div class="detail-row">
                    <span>Guests/Quantity:</span>
                    <strong>{{ $bookingData['guests'] ?? 1 }}</strong>
                </div>
                <div class="detail-row">
                    <span>Total Amount:</span>
                    <strong>{{ $bookingData['total_price'] }} EGP</strong>
                </div>
            </div>

            <center>
                <a href="{{ env('APP_URL') }}" class="btn">View My Itinerary</a>
            </center>

            <p style="margin-top: 30px; font-size: 14px; line-height: 1.6;">
                If you have any questions or need to make changes to your itinerary, please contact our support team 24/7.
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} KEMET Egypt. All rights reserved.<br>
            If you did not make this booking, please contact us immediately.
        </div>
    </div>
</body>
</html>
