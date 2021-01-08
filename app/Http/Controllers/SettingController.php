<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Brotzka\DotenvEditor\DotenvEditor;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        //store date
        /*config(['database.connections.mysql.host' => '127.0.0.1']);*/
        /*To get this data use config():*/
        $data['settings'] = Setting::first();


        return view('admin.settings.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting, $id)
    {
        $data['settings'] = Setting::find($id);
        return view('admin.settings.edit', $data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {


        if ($request->get('checkName') == 1) {
            $setting = Setting::find($request->get('id'));
            $request->validate([

                'app_name' => 'required',


            ]);
            $setting->app_name = $request->get('app_name');
            $settings_updated = $setting->save();
            if (isset($settings_updated)) {

                $app_name = removeSpace($request->get('app_name'));
                $env = new DotenvEditor();
                $env->changeEnv([
                    'APP_NAME' => $app_name,


                ]);

                return back()->with('success', 'Updated Successfully');

            }
        } else {
            $setting = Setting::find($request->get('id'));
            $request->validate([

                'mail_mailer' => 'required',
                'mail_host' => 'required',
                'mail_port' => 'required',
                'mail_username' => 'required',
                'mail_enc' => 'required',
                'mail_fromAddress' => 'required',
                'mailFromUsername' => 'required',

            ]);
            $setting->mail_mailer = $request->get('mail_mailer');
            $setting->mail_host = $request->get('mail_host');
            $setting->mail_port = $request->get('mail_port');
            $setting->mail_username = $request->get('mail_username');
            $setting->mail_enc = $request->get('mail_enc');
            $setting->mail_fromAddress = $request->get('mail_fromAddress');
            $setting->mail_fromName = $request->get('mailFromUsername');
            $setting->created_at = date("Y-m-d H:i:s");
            $setting->updated_at = date("Y-m-d H:i:s");
            $settings_updated = $setting->save();
            if (isset($settings_updated)) {


                $mail_mailer = removeSpace($request->get('mail_mailer'));
                $mail_host = removeSpace($request->get('mail_host'));
                $mail_port = removeSpace($request->get('mail_port'));
                $mail_username = removeSpace($request->get('mail_username'));
                $mail_enc = removeSpace($request->get('mail_enc'));
                $mail_fromAddress = removeSpace($request->get('mail_fromAddress'));
                $mailFromUsername = removeSpace($request->get('mailFromUsername'));
                $env = new DotenvEditor();
                $env->changeEnv([

                    'MAIL_MAILER' => $mail_mailer,
                    'MAIL_HOST' => $mail_host,
                    'MAIL_USERNAME' => $mail_username,
                    'MAIL_PORT' => $mail_port,
                    'MAIL_ENCRYPTION' => $mail_enc,
                    'MAIL_FROM_ADDRESS' => $mail_fromAddress,
                    'MAIL_FROM_NAME' => $mailFromUsername,

                ]);

                return back()->with('success', 'Updated Successfully');

            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
