<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProviders extends Model
{
    //
    protected $fillable = [
        'user_id', 'provider', 'provider_user_id', 'provider_token',
    ];
}
