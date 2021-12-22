<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'district' => null,
            'upazila' => null,
            'type' => 1,
            'password' => Hash::make('12345678'),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'joining_date' => date('Y-m-d'),
        ]);

    }
}
