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

            $appenv = config('settings.APP_ENV');
            $appkey = config('settings.APP_KEY');
            $appname = config('settings.APP_NAME');
            $appurl = config('settings.APP_URL');
            $appdebug = config('settings.APP_DEBUG');

        //
        DB::table('settings')->insert([
            'app_name' => $appname,
            'app_key' => $appkey,
            'app_env' => $appenv,
            'app_url' => $appurl,
            'app_debug' => $appdebug,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),

        ]);
    }
}
