<?php

namespace App\Models\Management\Employee;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Throwable;

class Employee extends Model
{
    protected $fillable = ['employee_id', 'union_id', 'device_id', 'name', 'nid', 'email', 'designation_id',
                            'date_of_birth', 'qualification', 'join_date', 'photo', 'gender', 'marital_status',
                            'election_area', 'mobile', 'address', 'district_id', 'upazila_id', 'postal_id', 'sequence',
                            'messages', 'status','is_process','is_process_web', 'created_by', 'updated_by', 'created_by_ip', 'updated_by_ip'];

    public static function boot()
    {
        parent::boot();
        static::updating(function ($query) {
            $query->is_process = 0;
            $query->is_process_web = 0;
        });

        static::deleting(function ($query) {
            $query->is_process = 0;
            $query->is_process_web = 0;
        });
    }


    //store as a member info
    public static function store($request)
    {

        $request['union_id']        = Auth::User()->union_id;
        $request['created_by']      = Auth::user()->employee_id;
        $request['created_by_ip']   = $request->ip();

        DB::beginTransaction();

        try
        {

            $employeeId = Employee::create($request->except('_token', 'photo', 'username'))->id;


                $userId = User::create([
                    'employee_id'   => $request->employee_id,
                    'union_id'      => $request->union_id,
                    'role_id'       => null,
                    'type'          => $request->designation_id,
                    'name'          => $request->name,
                    'username'      => $request->employee_id,
                    'email'         => $request->email,
                    'password'      => bcrypt($request->employee_id),
                    'created_by'    => $request->created_by,
                    'created_by_ip' => $request->created_by_ip
                ])->id;


            if($request->hasFile('photo')){
                $photo = $request->photo;
                $fileExtension = $photo->getClientOriginalExtension();
                $fileName = $request->employee_id.'.'.$fileExtension;

                $image = Image::make($photo)->resize(300, 300)->save(public_path('assets/images/employee/'.$fileName));
                Employee::find($employeeId)->update([
                    'photo'      => $fileName,
                    'is_process' => 0,
                    'is_process_web' => 0
                ]);
            }

            DB::commit();

        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $employeeId;
    }

    //get employees
    public static function getEmployees()
    {
        $employees = Employee::where('union_id', Auth::user()->union_id)
            ->Join('designation AS DS', 'employees.designation_id','=','DS.id' )
            ->whereNull('deleted_at')->orderBy('designation_id', 'asc')->orderBy('sequence', 'asc')
            ->select('employees.*','DS.name as designation_name')
            ->get();

        return $employees;
    }

    public function user()
    {
        return $this->hasOne(User::class,'employee_id','employee_id');
    }



    //get employee
    public static function getEmployee($id)
    {
        // dd($id);
        // 1231,1232.1234
        $employee = DB::table('employees AS EMP')
            ->join('bd_locations AS LOC1','EMP.district_id', '=','LOC1.id')
            ->join('bd_locations AS LOC2','EMP.upazila_id', '=','LOC2.id')
            ->join('bd_locations AS LOC3','EMP.postal_id', '=', 'LOC3.id')
            ->leftJoin('users AS US','EMP.employee_id', '=', 'US.employee_id')
            ->select('EMP.*', 'US.username','LOC1.bn_name AS district','LOC2.bn_name AS upazila', 'LOC3.bn_name AS post_office')
            ->where([
                ['EMP.union_id', '=', Auth::user()->union_id],
                ['EMP.employee_id', '=', $id],
            ])
            ->first();

            // dd($employee);
        return $employee;
    }

    //update user info
    public static function updateUser($request)
    {
        // $user = ['name' => $request->name, 'username' => $request->username, 'email' => $request->email];
        $user = ['name' => $request->name, 'email' => $request->email];
        $employee = ['name' => $request->name, 'nid' => $request->nid, 'email' => $request->email, 'is_process' => 0, 'is_process_web' => 0];

        DB::beginTransaction();

        try
        {
            User::where('employee_id', $request->id)->update($user);
            Employee::where('employee_id', $request->id)->update($employee);

            DB::commit();

        } catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return true;
    }

    //change status
    public static function changeStatus($id)
    {
        $status = Employee::where('union_id', Auth::user()->union_id)->where('id', $id)->first()->status;
        if ($status == 1){
            Employee::where('union_id', Auth::user()->union_id)
                ->where('id', $id)
                ->update([
                    'status' => false,
                    'updated_by' => Auth::user()->employee_id,
                    'updated_by_ip' => Request::ip(),
                    'is_process' => 0,
                    'is_process_web' => 0
            ]);
        }else{
            Employee::where('union_id', Auth::user()->union_id)
                ->where('id', $id)
                ->update([
                    'status' => true,
                    'updated_by' => Auth::user()->employee_id,
                    'updated_by_ip' => Request::ip(),
                    'is_process' => 0,
                    'is_process_web' => 0
            ]);
        }
    }

    //get sequence
    public static function getSequence($request)
    {

        $data = DB::table('employees AS EMP')
            ->leftJoin('users AS US','EMP.employee_id', '=', 'US.employee_id')
            ->leftjoin('model_has_roles AS MHR','MHR.model_id', '=', 'US.id')
            ->select('EMP.designation_id', 'EMP.gender', 'EMP.id As employee_id', 'EMP.name', 'EMP.sequence', 'US.name AS username', 'US.id AS userid', 'MHR.model_id')
            ->where([
                ['EMP.union_id', '=', Auth::user()->union_id],
                ['EMP.is_active', '=', 1],
                ['EMP.designation_id', '=', $request->des],
            ])
            ->orderBy('EMP.sequence', 'asc')
            ->get();

        return $data;
    }

    //update employee sequence
    public static function updateSequence($request)
    {
        foreach ($request->seq as $key => $item)
        {
            Employee::find($item)->update([
                'sequence' => $key+1,
                'updated_by' => Auth::user()->employee_id,
                'updated_by_ip' => $request->ip(),
                'is_process' => 0,
                'is_process_web' => 0
            ]);
        }
        return true;
    }

    //Update employee profile pic
    public static function picUpdate($request)
    {
            if($request->hasFile('photo')){
                $photo = $request->photo;
                $fileExtension = $photo->getClientOriginalExtension();
                $fileName = $request->id.'.'.$fileExtension;
                Image::make($photo)->resize(300, 300)->save(public_path('assets/images/employee/'.$fileName), 100);
                Employee::where('union_id', Auth::user()->union_id)
                    ->where('employee_id', $request->id)
                    ->update([
                        'photo'      => $fileName,
                        'updated_by' => Auth::user()->employee_id,
                        'updated_by_ip' => $request->ip(),
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                return true;
            }else{
                return false;
            }
    }

    //update employee info
    public static function infoUpdate($request)
    {
        // dd($request->all());

        Employee::find($request->id)->update($request->except('_token','id', 'employee_id', 'photo', 'username', 'password'));

        if($request->hasFile('photo')){

            $photo = $request->photo;
            $fileExtension = $photo->getClientOriginalExtension();
            $fileName = $request->employee_id.'.'.$fileExtension;

            Image::make($photo)->resize(300, 300)->save(public_path('assets/images/employee/'.$fileName), 100);
            Employee::where('union_id', Auth::user()->union_id)
                ->where('employee_id', $request->employee_id)
                ->update([
                    'photo'      => $fileName,
                    'is_process' => 0,
                    'is_process_web' => 0

                ]);
        }

        if($request->username && User::where('employee_id',$request->employee_id)->first()->username != $request->username )
        {
            User::where('employee_id',$request->employee_id)->update([
                'username' => $request->username
            ]);
        }

        if($request->password)
        {
            User::where('employee_id',$request->employee_id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return true;
    }

    //update members sequence info
    public static function putSequence($des, $seq)
    {
        if ($seq == 'first'){
            if ($des > 1 && $des <= 4){
                foreach (Employee::where([
                    ['designation_id', '<=', 4],
                    ['designation_id', '>', 1]])->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence + 1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }elseif ($des == 5){
                foreach (Employee::where('designation_id', '=', 5)->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence +1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }else{
                foreach (Employee::where('designation_id', '>', 5)->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence + 1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }
        }else{
            if ($des <= 4 && $des > 1){
                foreach (Employee::where([
                    ['designation_id', '<=', 4],
                    ['sequence', '>', $seq]
                ])->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence + 1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }elseif ($des == 5){
                foreach (Employee::where([
                    ['designation_id', '=', 5],
                    ['sequence', '>', $seq]
                ])->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence + 1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }else{
                foreach (Employee::where([
                    ['designation_id', '>', 5],
                    ['sequence', '>', $seq]
                ])->orderBy('sequence', 'asc')->get() as $employee){
                    Employee::find($employee->id)->update([
                        'sequence' => $employee->sequence + 1,
                        'is_process' => 0,
                        'is_process_web' => 0
                    ]);
                }
            }
        }
    }
}
