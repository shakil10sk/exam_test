<?php

use App\Http\Controllers\Sync\FiscalYearController;
use Illuminate\Database\Seeder;

class FiscalYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new FiscalYearController)->changeFiscalYear();
    }
}
