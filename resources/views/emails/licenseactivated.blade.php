@php
$path = url('/');

$text = ['[FIRST_NAME]','[LAST_NAME]','[EMAIL]','[PHONE]','[ADDRESS]','[CITY]','[STATE]','[COUNTRY]','[LICENSE]','[URL]'];


$toend=[$user["first_name"]??'',$user["last_name"]??'',$user["email"]??'',$user["phone"]??'',$user["address"]??'',$user["city"]??'',
$user["state"]??'',$user["country"]??'',$license->license??$license, $url??''];
echo str_replace($text,$toend,$emaillayout->email_layout) ;

@endphp
{{-- {{!! str_replace('[FIRST_NAME]','$user',$el->email_layout) !!}} --}}

{{-- {{!! str_replace($text,$toend,$emaillayout->email_layout) !!}} --}}


