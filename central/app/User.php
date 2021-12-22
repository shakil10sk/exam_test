<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'district', 'upazila', 'type', 'password', 'photo'
    ];

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

    public static function routes()
    {
        Route::get('user/profile', 'UserController@profile')->name('profile');
        Route::post('user/profile/edit', 'UserController@profileEdit')->name('profile.edit');
        
        Route::get('user/profile/get/{id}', 'UserController@getProfile')->name('get.profile.edit')->middleware('admin');
        Route::post('user/profile/edit/{id}', 'UserController@updateProfile')->name('post.profile.edit')->middleware('admin');

        Route::get('user/list', 'UserController@list')->name('user.list')->middleware('admin');

        Route::post('user/change-status/{id}/{status}', 'UserController@changeUserStatus')->name('user.chagneStatus')->middleware('admin');

        Route::post('user/change-status/{id}', 'UserController@deleteUser')->name('user.delete')->middleware('admin');
    }

    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class, 'user_id', 'id');
    }

    public function district_()
    {
        return $this->hasOne(\App\Models\BdLocation::class, 'id', 'district');
    }
    
    public function upazila_()
    {
        return $this->hasOne(\App\Models\BdLocation::class, 'id', 'upazila');
    }
}
