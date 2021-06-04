<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apiloggs extends Model
{
    //
    protected $fillable = ['current_url','current_controller','current_payload'];
}
