<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Confirmation</title>
</head>
<body>
    <h1>Thank you for contacting us, {{ $contact['name'] }}!</h1>
    <p>We have received your message and will get back to you as soon as possible.</p>
    <p>Your message:</p>
    <p>{{ $contact['message'] }}</p>
</body>
</html>
