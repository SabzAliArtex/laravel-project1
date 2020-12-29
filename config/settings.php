<?php

     return array(
                 'EXPIRE' => 1,
                 'DATE_FORMAT' => 'Y-m-d',
                  //Getting values from .env
                   'APP_ENV' =>env('APP_ENV',false),
                    'APP_KEY' => env('APP_KEY',false),
                    'APP_DEBUG' => env('APP_DEBUG',false),
                    'APP_URL' => env('APP_URL',false),
                    'APP_NAME' =>  env('APP_NAME',false),
            );
