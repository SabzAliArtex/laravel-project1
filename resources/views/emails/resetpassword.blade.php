@php
    $path = url('/');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h3>Congratulations</h3>
    <p>
        Reset Your Password
        <br>
        Please click & reset your password
    </p>
    <p>
        {{ $gettoken }}
        <br>
        {{ $getuser->name }}
    </p>
    <br>
    <br>    
</body>
</html>