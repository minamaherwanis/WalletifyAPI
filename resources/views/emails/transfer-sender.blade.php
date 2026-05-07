<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transfer Sent</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, sans-serif;">

<div style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

    <!-- Header -->
    <div style="background:#2563eb; padding:25px; text-align:center; color:white;">
        <h1 style="margin:0; font-size:22px;">Transfer Sent</h1>
    </div>

    <!-- Body -->
    <div style="padding:30px; text-align:center;">

        <div style="font-size:50px;">📤</div>

        <h2 style="color:#111; margin-top:10px;">Transfer Completed</h2>

        <p style="color:#555; font-size:15px;">
            Your transfer has been successfully processed
        </p>

        <div style="background:#eff6ff; padding:15px; border-radius:10px; margin:20px 0;">
            <p style="margin:5px 0; color:#333;">
                To: <b>{{ $touser->username }}</b>
            </p>

            <p style="margin:5px 0; color:#333;">
                Amount: <b style="color:#2563eb;">{{ $amount }} EGP</b>
            </p>
        </div>

        <p style="color:#888; font-size:13px;">
            Thank you for using Walletify 🚀
        </p>

    </div>

</div>

</body>
</html>