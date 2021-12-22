<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function () {
           $role = Role::create(['name'=>'super-admin']);

            $user = User::create([
                'name' => 'Super Admin', 
                'username' => 'superadmin', 
                'password' => Hash::make('12345678'), 
                'role_id' => $role->id,
                'union_id' => 0, 
                'type' => 0, 
                'created_by' => 1, 
                'created_by_ip' => Request::ip()
            ]);

            $user->assignRole('super-admin');
            
        });

    }
}
