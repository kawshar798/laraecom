<!doctype html>
<html lang="end">
<body>
<div>
    <p>Dear <strong>{{$user->name}}</strong></p>
    <p>Your account has been created. To complete the  Registration, enter the verification code.</p>
    <h2>Verification code is :{{$user->code}}</h2>
    <p> Your Email:{{$user->email}}</p>
    <p>Thank you for sign up</p>
</div>
</body>
</html>
