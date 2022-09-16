<!DOCTYPE html>
<html>
<head>
    <title>LcdStore.com</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <p> LcdStore sends you Your order has been confirmed. Your order code is {{$mailData['orderId']}}</p>

    <p>Thank you</p>
</body>
</html>
