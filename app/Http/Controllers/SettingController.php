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
    public function index()
    {
        //store date
        /*config(['database.connections.mysql.host' => '127.0.0.1']);*/
        /*To get this data use config():*/
        $data['settings'] = Setting::all();
        return view('admin.settings.index',$data);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting,$id)
    {
        $data['settings'] = Setting::find($id);
        return view('admin.settings.edit',$data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
        $request->validate([
            'app_key'=>'required',
            'app_name'=>'required',
            'app_debug'=>'required',
            'app_env'=>'required',
            'app_url'=>'required',
        ]);

        $setting = Setting::find($request->get('id'));
        $setting->app_name = $request->get('app_name');
        $setting->app_key = $request->get('app_key');
        $setting->app_url = $request->get('app_url');
        $setting->app_debug = $request->get('app_debug');
        $setting->app_env = $request->get('app_env');
        $settings_updated = $setting->save();
        if(isset($settings_updated)){

            //

            $name = $request->get('app_name');
            $app_name=str_replace(' ','',$name);
            $key = $request->get('app_key');
            $app_key=str_replace(' ','',$key);
            $envap = $request->get('app_env');
            $app_env=str_replace(' ','',$envap);
            $url = $request->get('app_url');
            $app_url=str_replace(' ','',$url);
            $debug = $request->get('app_debug');
            $app_debug=str_replace(' ','',$debug);
            $env = new DotenvEditor();
            $env->changeEnv([
                'APP_NAME'   => $app_name,
                'APP_KEY'   =>$app_key,
                'APP_ENV'   => $app_env,
                'APP_DEBUG'   => $app_debug,
                'APP_URL'   => $app_url,

            ]);
            return back()->with('success','Updated Successfully');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
