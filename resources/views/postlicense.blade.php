
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('api/license/activate')}}" method="post">
    {{csrf_field()}}
    <input type="text" value="alex" name="UserFirstName"   placeholder="User id">
    <input type="text" value="alex" name="UserLastName"   placeholder="User id">
    <input type="email" value="mohammadfahad.ystsol@gmail.com" name="UserEmail"   placeholder="User id">
    <input type="text" value="1223123" name="UserPhone"   placeholder="User id">
    <input type="password" value="12345678" name="UserPassword"   placeholder="User id">
    <input type="text" value="CCVT0M0NKRKM3S3R9R7P" name="LicenseCode" id="" placeholder="license key">
    <input type="text" value="{{ rand()}}" name="DeviceUniqueId" id="" placeholder="dev id">
    <input type="text" value="2021-02-11T10:18:46.334947" name="StartTrialTime">
    <input type="submit" value="Activate">
</form>

</body>
</html>
