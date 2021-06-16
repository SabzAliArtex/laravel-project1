<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    //
    protected $fillable = ['email','license','license_type_id','purchase_date', 'activation_date ','status '];

    public function license_type()
	{	
   		return $this->hasOne('App\LicenseType','id','license_type_id');
	}
}
