
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('api/license/trial')}}" method="post">
    {{csrf_field()}}
    <input type="text" value="4" name="loggedinuser_id"  id="" placeholder="User id">
    <input type="text" value="CCVT7MFP9R9M8PLP5S2N" name="license_key" id="" placeholder="license key">
    <input type="submit" value="Activate">
</form>

</body>
</html>
