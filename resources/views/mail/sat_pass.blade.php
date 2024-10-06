<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satellite Pass Notification</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        h1,
        h3 {
            color: #1db954;
        }

        p,
        ul {
            color: #cfcfcf;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 5px 0;
        }

        strong {
            color: #ffffff;
        }

        a {
            color: #1db954;
            text-decoration: none;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #1f1f1f;
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Upcoming Satellite Pass Over Your Location</h1>

        <p>Dear {{ $user->name }},</p>

        <p>We’re excited to inform you that a satellite will be passing over your selected location soon!</p>

        <h3>Details of the Satellite Pass:</h3>
        <ul>
            <li><strong>Satellite:</strong> {{ $satelliteName }}</li>
            <li><strong>Location:</strong> Latitude {{ $latitude }}, Longitude {{ $longitude }}</li>
            <li><strong>Date and Time:</strong> {{ $passDateTime }}</li>
            <li><strong>Cloud Coverage:</strong> {{ $cloudCoverage }}%</li>
        </ul>

        <p>You can prepare to collect data or simply enjoy watching the pass.</p>

        <p>Best regards,<br>
            {{ config('app.name') }} Team</p>
    </div>
</body>

</html>
