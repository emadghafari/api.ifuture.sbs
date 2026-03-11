<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thank You For Your Investment</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <div style="background-color: #0b0b0b; padding: 30px; text-align: center; border-bottom: 4px solid #c8a951;">
            <h1 style="color: #ffffff; margin: 0; font-family: 'Times New Roman', serif; font-size: 28px;">iFuture <span style="color: #c8a951;">SBS</span></h1>
        </div>

        <div style="padding: 40px 30px;">
            <h2 style="color: #1e1e1e; margin-top: 0;">Dear {{ explode(' ', $investment->user->name)[0] }},</h2>
            
            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                We are thrilled to confirm that your investment of <strong>${{ number_format($investment->amount, 2) }}</strong> in <strong>{{ $investment->project->title }}</strong> has been fully processed and legally executed.
            </p>

            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                Welcome to the future! By securing <strong>{{ $investment->shares }}%</strong> equity in this project, you are now an official partner in our technological journey.
            </p>

            <div style="background-color: #fdfbee; border: 1px solid #c8a951; padding: 20px; border-radius: 4px; margin: 25px 0; text-align: center;">
                <p style="margin: 0; color: #0b0b0b; font-size: 18px; font-weight: bold;">
                    Your Official Documents Are Ready
                </p>
            </div>

            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                Please find attached to this email your legally binding <strong>Signed Investment Contract</strong> and your official <strong>Purchase Invoice</strong> for your fiscal records.
            </p>
            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                You can also access and review these documents at any time from your investor portal dashboard.
            </p>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ env('FRONTEND_URL', 'https://ifuture.sbs') }}/portal/dashboard" style="display: inline-block; background-color: #0b0b0b; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px;">Go To My Portfolio</a>
            </div>
        </div>

        <div style="background-color: #f9f9f9; padding: 25px 20px; text-align: center; color: #888888; font-size: 13px; border-top: 1px solid #eeeeee;">
            <p style="margin: 0 0 10px 0;">If you have any questions, feel free to reply directly to this email.</p>
            &copy; {{ date('Y') }} iFuture LLC. All rights reserved.
        </div>
    </div>
</body>
</html>
