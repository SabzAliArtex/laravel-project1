<?php

     return array(
                 'EXPIRE' => 1,
                 'DATE_FORMAT' => 'Y-m-d',
                  //Getting values from .env

                    'APP_NAME' =>  env('APP_NAME',false),
                    'MAIL_MAILER'=> env('MAIL_MAILER',false),
                    'MAIL_HOST'=> env('MAIL_HOST',false),
                    'MAIL_PORT'=> env('MAIL_PORT',false),
                    'MAIL_USERNAME'=> env('MAIL_USERNAME',false),
                    'MAIL_PASSWORD'=> env('MAIL_PASSWORD',false),
                    'MAIL_ENCRYPTION'=> env('MAIL_ENCRYPTION',false),
                    'MAIL_FROM_ADDRESS'=> env('MAIL_FROM_ADDRESS',false),
                    'MAIL_FROM_NAME'=> env('MAIL_FROM_NAME',false),
            );
