<?php

use Illuminate\Database\Seeder;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $appname = config('settings.APP_NAME');
            $mailmailer = config('settings.MAIL_MAILER');
            $mailhost = config('settings.MAIL_HOST');
            $mailport = config('settings.MAIL_PORT');
            $mailusername = config('settings.MAIL_USERNAME');
            $mailpassword = config('settings.MAIL_PASSWORD');
            $mailencryption = config('settings.MAIL_ENCRYPTION');
            $mailfrom = config('settings.MAIL_FROM_ADDRESS');
            $mailfromname = config('settings.MAIL_FROM_NAME');

        //
        DB::table('settings')->insert([
            'app_name' => $appname,

        'mail_mailer'=>$mailmailer,
        'mail_host'=>$mailhost,
        'mail_port'=>$mailport,
        'mail_username'=>$mailusername,
        'mail_password'=>$mailpassword,
        'mail_enc'=>$mailencryption,
        'mail_fromAddress'=>$mailfrom,
        'mail_fromName'=>$mailfromname,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),

        ]);
    }
}
