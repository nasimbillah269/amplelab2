<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Contact Form {{ general()->title }}</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
        }

        .email-wrapper {
            width: 100%;
            padding: 20px 0;
        }

        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .email-header {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            padding: 25px;
            text-align: center;
            color: #ffffff;
        }

        .email-header img {
            max-width: 180px;
            margin-bottom: 10px;
        }

        .email-header h2 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .email-body {
            padding: 25px;
        }

        .info-box {
            background: #f8f9fc;
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid #4e73df;
        }

        .info-row {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-row strong {
            color: #333;
            width: 90px;
            display: inline-block;
        }

        .message-box {
            background: #ffffff;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #e3e6f0;
        }

        .message-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 15px;
            color: #4e73df;
        }

        .email-footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #888;
            background: #f8f9fc;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="email-wrapper">
    <div class="email-container">

        <!-- Header -->
        <div class="email-header">
            <img src="{{ assetUrl(general()->logo()) }}" alt="Logo">
            <h2>CUSTOMER CONTACT DETAILS</h2>
        </div>

        <!-- Body -->
        <div class="email-body">

            <div class="info-box">
                <div class="info-row"><strong>Name:</strong> {{ $datas['r']['name'] }}</div>
                <div class="info-row"><strong>Email:</strong> {{ $datas['r']['email'] }}</div>
                <div class="info-row"><strong>Mobile:</strong> {{ $datas['r']['mobile'] }}</div>
                @if(!empty($datas['r']['company']))
                <div class="info-row"><strong>Company:</strong> {{ $datas['r']['company'] }}</div>
                @endif
                <div class="info-row"><strong>Subject:</strong> {{ $datas['r']['subject'] ?? 'N/A' }}</div>
                @if(!empty($datas['r']['quantity']))
                <div class="info-row"><strong>Quantity:</strong> {{ $datas['r']['quantity'] }}</div>
                @endif
            </div>

            <div class="message-box">
                <div class="message-title">Message</div>
                <div style="font-size:14px; color:#555; line-height:1.6;">
                    {!! nl2br(e($datas['r']['message'] ?? $datas['r']['comment'])) !!}
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            © {{ date('Y') }} {{ general()->title }}. All Rights Reserved.
        </div>

    </div>
</div>

</body>
</html>