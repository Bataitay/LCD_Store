<!DOCTYPE html>
<html>
<head>
    <title>LcdStore.com</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>

    <p>Happy birthday " {{$mailData['body'] }} ".LCd Store sends you a gift worth 200k for your next order,
         this voucher is only valid for 1 week from the date you receive this e-mail,
         Make good use of it.</p>
         <p>Vocher Code</p>
         <p>{{$mailData['voucher']}}</p>

    <p>Thank you</p>
</body>
</html>
