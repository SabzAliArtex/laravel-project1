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
    <h3>Reminder</h3>
    <br>
    <h4> Dear, {{$user['first_name'].$user['last_name']}} </h4>
    
    <p>
        License has been created successfully.
        <br>
        Please click & confirm.
    </p>
    <p>
        Your License Key  is {{ $license_key }}
    </p>
     

    <p>
        
        <a href="{{ $url }}"> Home </a>
    </p>
    <br>
    <br>    
</body>
</html>