<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .message {
            font-size: 16px;
            margin-bottom: 30px;
            color: #555;
            line-height: 1.8;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            margin: 30px 0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .link-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
        }
        .link-section p {
            margin: 5px 0;
        }
        .link-section a {
            color: #667eea;
            text-decoration: none;
            word-break: break-all;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 20px 30px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .footer p {
            margin: 8px 0;
        }
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 20px 0;
        }
        @media only screen and (max-width: 600px) {
            .container {
                border-radius: 0;
            }
            .content {
                padding: 30px 20px;
            }
            .header {
                padding: 30px 20px;
            }
            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✉️ Email Verification</h1>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="greeting">
                Welcome, {{ $user->name }}! 👋
            </div>

            <div class="message">
                <p>Thank you for signing up! We're excited to have you on board. To complete your registration, please verify your email address by clicking the button below:</p>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $link }}" class="cta-button">Verify Email Address</a>
            </div>

            <div class="message">
                <p>This verification link will expire in <strong>24 hours</strong> for security reasons.</p>
            </div>

            <!-- Alternative Link -->
            <div class="link-section">
                <p><strong>Or copy and paste this link in your browser:</strong></p>
                <p><a href="{{ $link }}">{{ $link }}</a></p>
            </div>

            <!-- Security Info -->
            <div class="divider"></div>
            <div style="font-size: 13px; color: #666; background-color: #f9f9f9; padding: 15px; border-radius: 4px; margin-top: 20px;">
                <p style="margin-top: 0;"><strong>🔒 Security Tip:</strong></p>
                <p style="margin-bottom: 0;">If you didn't create this account, please ignore this email. Your account won't be activated until you verify your email.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} Walletify. All rights reserved.</p>
            <p>If you need help, contact us at <a href="mailto:support@walletify.com" style="color: #667eea; text-decoration: none;">support@walletify.com</a></p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>