<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
   	protected $fillable = [
	    'license' ,'license_type_id','license_duration' , 'sales_person_id' , 'allowed_test'
   	];

   	public function sales_person()
	{
   		return $this->hasOne('App\User','id','sales_person_id');
	}
	public function user()	
	{
   		return $this->hasOne('App\User','id','user_id');
	}
	public function license_type()
	{	
   		return $this->hasOne('App\LicenseType','id','license_type_id');
	}
	public function license_activation(){
		return $this->hasmany('App\LicenseActivation','license_id','id');
	}
	
}

