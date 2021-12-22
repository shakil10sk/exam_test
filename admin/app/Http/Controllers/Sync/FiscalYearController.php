<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use App\User;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;

class FiscalYearController extends Controller
{
    public function changeFiscalYear()
    {
        // $date = date('Y');

        if(date('m') > 6)
        {
            $fiscal_year = date('Y') .'-'. (date('Y')+1);
        }else
        {
            $fiscal_year = (date('Y')-1) .'-'. date('Y');
        }

        // dd($fiscal_year);
        FiscalYear::query()->update(['is_current'=>0]);

        $item = FiscalYear::where('name', $fiscal_year)->first();
        
        if($item)
        {
            $item->is_current = 1;
            $item->save();
        }
        else
        {
            FiscalYear::create([
                'name' => $fiscal_year, 
                'is_current' => 1,
                'expire_date' => (date('Y')+1) . '-06-30',  
                'created_by' => User::where('role_id',Role::whereName('super-admin')->first()->id)->first()->id,
                'created_by_ip'=> Request::ip(),
                'created_time' => date('Y-m-d h:i:s')
            ]);
        }

        return "<h1 style='color:green; text-align: center;'>Fiscal year updated</h1>";
    }
}
