<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License_devices extends Model
{
    //

    public function deviceLicense(){

    	return $this->hasMany('App\License','id','license_id');
    }
}
 