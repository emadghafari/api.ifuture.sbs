<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
        <h2 style="color: #4f46e5; margin-bottom: 20px;">iFuture Investor Account</h2>
        <p style="color: #475569; font-size: 16px; margin-bottom: 30px;">
            Thank you for registering. Please use the following 5-digit code to verify your email address:
        </p>
        <div style="background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #1e293b;">
                {{ $code }}
            </span>
        </div>
        <p style="color: #64748b; font-size: 14px;">
            This code will expire in 15 minutes. If you did not request this, please ignore this email.
        </p>
        
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;">
        <p style="color: #94a3b8; font-size: 12px;">
            &copy; 2026 iFuture SBS. All rights reserved.
        </p>
    </div>
</body>
</html>
