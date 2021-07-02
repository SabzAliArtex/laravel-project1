<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License_devices extends Model
{
    public function deviceLicense(){
    	return $this->hasMany('App\License','license','license_id');
    }
    public function users(){
    	return $this->hasMany('App\User','id','user_id');
    }
    public function license_type()
	{
   		return $this->hasOne('App\LicenseType','id','App\License.license_type_id');   
	}
    public function licensetype()
    {
        return $this->hasOne('App\LicenseType','id','App\License.license_type_id'); 
    }
    public function license()
    {
        return $this->hasOne('App\License','license','license_id'); 
    }
}
 