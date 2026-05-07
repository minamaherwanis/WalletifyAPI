<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Money Received</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, sans-serif;">

<div style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

    <!-- Header -->
    <div style="background:#22c55e; padding:25px; text-align:center; color:white;">
        <h1 style="margin:0; font-size:22px;">Money Received</h1>
    </div>

    <!-- Body -->
    <div style="padding:30px; text-align:center;">

        <div style="font-size:50px;">💰</div>

        <h2 style="color:#111; margin-top:10px;">You received a transfer</h2>

        <p style="color:#555; font-size:15px;">
            A new transfer has been added to your wallet
        </p>

        <div style="background:#f0fdf4; padding:15px; border-radius:10px; margin:20px 0;">
            <p style="margin:5px 0; color:#333;">
                From: <b>{{ $fromUser->username }}</b>
            </p>

            <p style="margin:5px 0; color:#333;">
                Amount: <b style="color:#16a34a;">{{ $amount }} EGP</b>
            </p>
        </div>

        <p style="color:#888; font-size:13px;">
            Thank you for using Walletify 🚀
        </p>

    </div>

</div>

</body>
</html>