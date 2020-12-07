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
    <br>
    <h4> Dear, {{$user['first_name'].' '.$user['last_name']}} </h4>
    
    <p>
        Your registration has been successful.
        <br>
        Please click & confirm your registration
    </p>
    <p>
        Your verification code is {{ $token }}
    </p>

    <p>
        <a href="{{ $url }}"> Verify </a>
    </p>
    <br>
    <br>    
</body>
</html>