<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseHistory extends Model
{
    //
    protected $fillable = ['user_id','license','license_expiry','trial_activated_at','license_activated_at','license_id'];
   
    public function license(){
		return $this->belongsTo('App\License','license_id','id');
	} 
}
