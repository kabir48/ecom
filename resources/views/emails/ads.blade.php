<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotional Email</title>
    <style>
        /* Reset some default styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }

        /* Set a background color for the email */
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }

        /* Header styles */
        h1 {
            color: #e44d26;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Image styles */
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        /* Call-to-action button styles */
        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #e44d26;
            color: #fff;
            border-radius: 4px;
        }

        /* Footer styles */
        p.footer-text {
            text-align: center;
            margin-top: 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <stong>{{$name}}</stong>
        </br>
        <h1>{{$title}}</h1>
        </br>
        <img src="{{$banner}}" alt="{{$title}}">
        <p>{{$messageView}}</p>
        </br>
        <a href="https://bigbenbd.com/" class="cta-button">Shop Now</a>
        </br>
        <p class="footer-text">Best Regards,</p>
        </br>
        <p class="footer-text">{{$sitesetting->company_name}},</p>
    </div>
</body>
</html>