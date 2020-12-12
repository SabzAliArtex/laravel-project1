<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['license_id','sales_person_id','commission', 'is_approved'];


   	public function sales_person()
	{
   		return $this->hasOne('App\User','id','sales_person_id');
	}
	public function license(){
		return $this->hasOne('App\License','id','license_id');
	}
	
}
