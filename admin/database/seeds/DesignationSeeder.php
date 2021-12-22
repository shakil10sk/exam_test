<?php

use Illuminate\Database\Seeder;
use  \Illuminate\Support\Facades\DB;
class DesignationSeeder extends Seeder
{

    public function run()
    {
        $designations = ['মেয়র', 'সচিব', 'নির্বাহী কর্মকর্তা', 'নির্বাহী প্রকৌশলী কর্মকর্তা', 'কাউন্সিলর', 'মেডিকেল অফিসার'];


        $designation_data = [];

        foreach ($designations as $item) {
            $designation_data[] = [
                'name' => $item,
                'is_system' => 1,
                'created_by' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'created_by_ip' => \Illuminate\Support\Facades\Request::ip()

            ];
        }

        DB::table('designation')->insert($designation_data);
    }
}
