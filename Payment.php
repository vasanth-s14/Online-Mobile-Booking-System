<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Centering the entire page content */
        body, html {
            height: 120%;
            margin: 0;
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center;     /* Centers vertically */
        }

        /* Container for the content */
        .container {
            text-align: center; /* Centers the content inside the container */
        }

        /* You can use CSS to control the size of the QR code image */
        .qr-code {
            width: 500px;  /* Adjust the width */
            height: auto;  /* Keep the aspect ratio */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <p>Thank you for booking with us! Your booking ID is: <strong>"OOMBU"</strong></p>
        
        <h2>Your QR Code:</h2>
        <!-- Include the static QR code image with reduced size -->
        <img class="qr-code" src="pay.png" alt="QR Code">
        
        <!-- Add other stuff (e.g., booking details, contact information, etc.) -->
        <p>Please save or print this QR code for future reference.</p>
    </div>
</body>
</html>
