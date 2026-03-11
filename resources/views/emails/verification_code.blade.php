<!DOCTYPE html>
<html>
<head>
    <title>iFuture Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f5;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 20px;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 4px;
            color: #1e293b;
            background: #f1f5f9;
            padding: 15px 30px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">iFuture SBS</div>
        <h2>Verify your email address</h2>
        <p>Please use the following 5-digit code to complete your registration:</p>
        
        <div class="code">{{ $code }}</div>
        
        <p>This code will expire in 15 minutes.</p>
        <p>If you did not request this code, please ignore this email.</p>
        
        <div class="footer">
            &copy; {{ date('Y') }} iFuture. All rights reserved.
        </div>
    </div>
</body>
</html>
