<!DOCTYPE html>
<html>

<head>
    <title>Email Verification Code</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555555;
        }

        .code {
            font-size: 28px;
            font-weight: bold;
            background-color: #e9ecef;
            color: #333333;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            border-radius: 5px;
            letter-spacing: 3px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888888;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Email Verification Code</h1>
        <p>Hello,</p>
        <p>Your code is:</p>
        <div class="code">{{ $data['otp'] }}</div>
        <p>Please use this code to verify your email address. The code is valid for 5 minutes.</p>
        <p>Thank you for choosing our service!</p>
        <div class="footer">
            © 2024 Pisopay.com Inc. All rights reserved.
        </div>
    </div>
</body>

</html>
