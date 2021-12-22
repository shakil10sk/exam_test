<?php

namespace App\Http\Controllers\Management\Employee;

use App\Http\Controllers\Controller;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Http\Request;

use App\Models\Management\Employee\Employee;

use Illuminate\Support\Facades\Auth;
use PDF;

class MemberPDFController extends Controller
{
    public function gen()
    {
        $unionAddress = UnionInformation::where('union_code', Auth::user()->union_id)
            ->join('bd_locations AS BDL4', 'union_information.district_id', '=','BDL4.id')
            ->join('bd_locations AS BDL5', 'union_information.upazila_id', '=','BDL5.id')
            ->join('bd_locations AS BDL6', 'union_information.postal_id', '=','BDL6.id')
            ->select('union_information.*','BDL4.bn_name As union_district', 'BDL5.bn_name As union_upazila', 'BDL6.bn_name As union_post_office')
            ->first();
        $employees = Employee::where('union_id', Auth::user()->union_id)->orderBy('designation_id', 'asc')
            ->join('bd_locations AS BDL1', 'employees.district_id', '=','BDL1.id')
            ->join('bd_locations AS BDL2', 'employees.upazila_id', '=','BDL2.id')
            ->join('bd_locations AS BDL3', 'employees.postal_id', '=','BDL3.id')
            ->select('employees.*','BDL1.bn_name AS district','BDL2.bn_name AS upazila', 'BDL3.bn_name AS post_office')
            ->get();
        $pdf = PDF::loadView('management.employee.all_member_pdf', ['employees' => $employees, 'unionAddress' => $unionAddress]);
        return $pdf->stream('members.pdf');
    }
}
