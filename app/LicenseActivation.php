<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseActivation extends Model
{
    //
    protected $fillable = ['user_id','license','license_expiry','trial_activated_at','license_activated_at'];
    
    
}
