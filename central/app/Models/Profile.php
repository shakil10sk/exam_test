<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = ['user_id', 'name', 'mobile', 'email', 'bcs_batch', 'joining_date', 'photo'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
