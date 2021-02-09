
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
    <input type="email" value="user@ystsol.com" name="UserEmail"   placeholder="User id">
    <input type="text" value="CCVT0M0NKRKM3S3R9R7P" name="LicenseCode" id="" placeholder="license key">
    <input type="text" value="{{ rand()}}" name="DeviceUniqueId" id="" placeholder="dev id">
    <input type="text" value="android" name="dev_os" id="" placeholder="dev os">
    <input type="text" value="samsung   " name="dev_name" id="" placeholder="dev name">
    <input type="submit" value="Activate">
</form>

</body>
</html>
