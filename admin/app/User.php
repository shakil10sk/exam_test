<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;







    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'employee_id', 'email', 'username', 'password', 'union_id', 'type', 'role_id', 'status', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'
    ];

    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relationBetweenUnion
    function relationBetweenUnion()
    {
        return $this->hasOne('App\Models\Management\Union\UnionInformation','union_code','union_id');
    }

    // relationBetweenEmployee
    function relationBetweenEmployee()
    {
        return $this->hasOne('App\Models\Management\Employee\Employee','employee_id','employee_id');
    }

}
