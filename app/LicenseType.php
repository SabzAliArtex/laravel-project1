<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    protected $fillable = [
        'title' ,'price','is_active' , 'is_deleted' , 'allowed_test' , 'type'
    ];

    public function licenseChild(){
        return $this->hasOne('App\License','license_type_id','id');
    }
}
