<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Investment Received</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <div style="background-color: #0b0b0b; padding: 30px; text-align: center; border-bottom: 4px solid #c8a951;">
            <h1 style="color: #ffffff; margin: 0; font-family: 'Times New Roman', serif; font-size: 28px;">iFuture <span style="color: #c8a951;">SBS</span></h1>
        </div>

        <div style="padding: 40px 30px;">
            <h2 style="color: #1e1e1e; margin-top: 0;">New Investment Alert 🚀</h2>
            
            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                A new investment has been confirmed successfully on the platform.
            </p>

            <div style="background-color: #fafafa; border: 1px solid #eaeaea; border-left: 4px solid #c8a951; padding: 20px; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin-top: 0; color: #1e1e1e; border-bottom: 1px solid #eaeaea; padding-bottom: 10px;">Investment Details</h3>
                <p style="margin: 10px 0; color: #333;"><strong>Investor:</strong> {{ $investment->user->name }} ({{ $investment->user->email }})</p>
                <p style="margin: 10px 0; color: #333;"><strong>Project:</strong> {{ $investment->project->title }}</p>
                <p style="margin: 10px 0; color: #333;"><strong>Amount:</strong> ${{ number_format($investment->amount, 2) }}</p>
                <p style="margin: 10px 0; color: #333;"><strong>Shares:</strong> {{ $investment->shares }}%</p>
                <p style="margin: 10px 0; color: #333;"><strong>Gateway:</strong> {{ ucfirst($investment->gateway) }}</p>
                <p style="margin: 10px 0; color: #333;"><strong>Transaction ID:</strong> <span style="font-size: 12px;">{{ $investment->transaction_id }}</span></p>
            </div>

            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                Both the final signed <strong>Investment Contract</strong> and the <strong>Purchase Invoice</strong> have been attached to this email for your records.
            </p>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ env('FRONTEND_URL', 'https://ifuture.sbs') }}/admin" style="display: inline-block; background-color: #c8a951; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">View Dashboard</a>
            </div>
        </div>

        <div style="background-color: #f9f9f9; padding: 20px; text-align: center; color: #888888; font-size: 13px; border-top: 1px solid #eeeeee;">
            &copy; {{ date('Y') }} iFuture LLC. Automated System Notification.
        </div>
    </div>
</body>
</html>
