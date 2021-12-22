<?php

namespace App\Http\Controllers\Management\Role;

use App\Http\Controllers\Controller;
use App\Models\Geocode\BdLocation;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleSetupController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->role_id == 1)
        {
            $roles = Role::where('name','!=','super-admin')->get();
            $assignedRole = DB::table('model_has_roles AS MHR')
            ->join('roles', 'MHR.role_id', '=', 'roles.id')
            ->join('users AS US', 'MHR.model_id', '=', 'US.id')
            ->select('roles.id AS role_id', 'roles.name AS role_name', 'US.name As username', 'US.id AS user_id', 'MHR.model_id')
            ->get();
            return view('management.role.user_role_admin', compact('roles', 'assignedRole'));
        }
        else
        {
            $roles = Role::where('union_id', auth()->user()->union_id)->get();
            $assignedRole = DB::table('model_has_roles AS MHR')
            ->join('roles', 'MHR.role_id', '=', 'roles.id')
            ->join('users AS US', 'MHR.model_id', '=', 'US.id')
            ->select('roles.id AS role_id', 'roles.name AS role_name', 'US.name As username', 'US.id AS user_id', 'MHR.model_id')
            ->where('US.union_id', '=', auth()->user()->union_id)
            ->where('US.type', '!=', 2)
            ->get();

            return view('management.role.user_role', compact('roles', 'assignedRole'));
        }

    }

    public function roleList()
    {
        $district = BdLocation::where('type',2)->get();

        if(auth()->user()->role_id == 1)
        {
            return view('management.role.role_list_admin');
        }
        else
        {
            $roles = Role::where(['union_id' => auth()->user()->union_id])->get();

            return view('management.role.role_list', compact('roles'));
        }
    }

    public function roleListData(Request $r)
    {
        $query = Role::where('name','!=','super-admin');

        if($r->district_id)
        {
            $union_ids = UnionInformation::where('district_id',$r->district_id)->get()->pluck(['union_code'])->toArray();
            $query->whereIn('union_id',$union_ids);
        }
        if($r->upazila_id)
        {
            $union_ids = UnionInformation::where('upazila_id',$r->upazila_id)->get()->pluck(['union_code'])->toArray();
            $query->whereIn('union_id',$union_ids);
        }
        if($r->union_code)
        {
            $union_ids = UnionInformation::where('union_code',$r->union_code)->get()->pluck(['union_code'])->toArray();
            $query->whereIn('union_id',$union_ids);
        }

        $data = $query->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function assignedRoleList()
    {
        if(auth()->user()->role_id == 1)
        {
            $union_list = UnionInformation::whereNull('deleted_at')->get();
            $roles = Role::where('name','!=','super-admin')->get();
            $assignedRole = DB::table('model_has_roles AS MHR')
            ->join('roles', 'MHR.role_id', '=', 'roles.id')
            ->join('users AS US', 'MHR.model_id', '=', 'US.id')
            ->select('roles.id AS role_id', 'roles.name AS role_name', 'US.name As username', 'US.id AS user_id', 'MHR.model_id')
            ->where('US.role_id','!=',1)
            ->get();

            $users = User::where('role_id','!=',1)->where('status',1)->get();

            // dd($users);
            return view('management.role.assign_role_admin', compact('roles', 'assignedRole','union_list','users'));
        }
        else
        {
            $designation_list  = DB::table('designation')->where('is_active',1)->select('name','id')->get();
            $roles = Role::where('union_id', auth()->user()->union_id)->get();
            $assignedRole = DB::table('model_has_roles AS MHR')
            ->join('roles', 'MHR.role_id', '=', 'roles.id')
            ->join('users AS US', 'MHR.model_id', '=', 'US.id')
            ->select('roles.id AS role_id', 'roles.name AS role_name','US.employee_id', 'US.name As username', 'US.id AS user_id', 'MHR.model_id')
            ->where('US.union_id', '=', auth()->user()->union_id)
            ->where('US.type', '!=', 2)
            ->get();
            return view('management.role.assign_role', compact('roles', 'assignedRole','designation_list'));
        }
    }

    public function showCreateRoleForm()
    {
        return view('management.role.show_create_role_form');
    }

    public function checkRoleName(Request $request)
    {
        $roleName = $request->role."_".auth()->user()->union_id;
        $data = Role::where('name', $roleName)->where('union_id', auth()->user()->union_id)->first();
        return response()->json($data);
    }

    public function storeRole(Request $request)
    {
        $request->roleName = $request->roleName."_".auth()->user()->union_id;

        $request->validate([
            'roleName' => ['required','unique:roles,name']
        ], [
            'roleName.required' => 'রোল প্রদান করুন...',
            'roleName.unique' => 'রোল নেওয়া হয়েছে।'
        ]);

        $roleName = $request->roleName;
        $role = Role::create(['name' => $roleName, 'union_id' => auth()->user()->union_id]);
        foreach($request->all() as $key => $value){
            if($key != '_token' && $key != 'roleName'){
                $role->givePermissionTo($key);
            }
        }
        Alert::toast('Successfully Role Created.','success')->position('middle');
        return redirect(route('role.list'));
    }

    public function showRole($id)
    {
        if(auth()->user()->role_id == 1)
        {
            $roleViaPermission = DB::table('roles')
            ->join('role_has_permissions AS RHP','RHP.role_id', '=', 'roles.id')
            ->join('permissions AS PER','PER.id', '=', 'RHP.permission_id')
            ->where('roles.id', $id)
            // ->where('roles.union_id', auth()->user()->union_id)
            ->get();
        }
        else
        {
            $roleViaPermission = DB::table('roles')
            ->join('role_has_permissions AS RHP','RHP.role_id', '=', 'roles.id')
            ->join('permissions AS PER','PER.id', '=', 'RHP.permission_id')
            ->where('roles.id', $id)
            ->where('roles.union_id', auth()->user()->union_id)
            ->get();
        }


        $role = Role::findById($id);

        $permissions = [];
        foreach($roleViaPermission as $item){
            $permissions[$item->name] = $item->permission_id;
        }

        // dd($permissions);

        return view('management.role.show_role', compact('role', 'permissions'));
    }

    public function editRole($id)
    {

        if(auth()->user()->role_id == 1)
        {
            $data['role_permissions'] = DB::table('roles')
            ->join('role_has_permissions AS RHP', 'RHP.role_id', '=', 'roles.id')
            ->join('permissions AS PER', 'PER.id', '=', 'RHP.permission_id')
            ->where('roles.id', $id)
            // ->where('roles.union_id', auth()->user()->union_id)
            ->pluck('PER.name')->toArray()
            ;
        }
        else
        {

            $data['role_permissions'] = DB::table('roles')
            ->join('role_has_permissions AS RHP', 'RHP.role_id', '=', 'roles.id')
            ->join('permissions AS PER', 'PER.id', '=', 'RHP.permission_id')
            ->where('roles.id', $id)
            ->where('roles.union_id', auth()->user()->union_id)
            ->pluck('PER.name')->toArray()
            ;
        }

        $data['role'] = Role::findById($id);

        return view('management.role.edit_role',$data);
    }

    public function updateRole (Request $r, $id)
    {

        $permissions = array_keys($r->except(['_token', 'roleName']));

        Role::find($id)->syncPermissions($permissions);


        Alert::toast('Successfully Role Edited.', 'success')->position('middle');

        return redirect()->route('role.edit',$id);

    }

    public function deleteRole(Request $request)
    {
        $users = User::role($request->roleName)->get(); //Model Has Role
        DB::table('role_has_permissions')->where('role_id', $request->roleId)->delete();
        if(count($users) > 0){
            foreach($users as $user){
                DB::table('model_has_permissions')->where('model_id', $user->id)->delete();
                $user->removeRole($request->roleName);
            }
        }
        DB::table('roles')->where('id', $request->roleId)->delete();
        return back();
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'user_id'     => 'required',
            'role_id'     => 'required'
        ], [
            'designation.required' => 'পদবী সিলেক্ট করুন',
            'user_id.required'     => 'কর্মকর্তার নাম সিলেক্ট করুন',
            'role_id.required'     => 'রোল সিলেক্ট করুন',
        ]);
        $userExist = count(DB::table('model_has_roles')->where('model_id', $request->user_id)->get());

        if($userExist > 0){
            Alert::toast('দুঃখিত, কর্মকর্তার -এর রোল ইতিমধ্যে দেওয়া হয়েছে!','error')->position('middle');
            return back();
        }else {
            $roleViaPermission = DB::table('role_has_permissions')->where('role_id', $request->role_id)->get();
            $role = Role::findById($request->role_id);
            $user = User::find($request->user_id);
            foreach($roleViaPermission as $permission){
                $user->givePermissionTo(Permission::findById($permission->permission_id));
            }
            $user->assignRole($role);
            User::find($request->user_id)->update(['role_id' => $request->role_id, 'updated_by_ip' => $request->ip()]);
            Alert::toast('কর্মকর্তার -এর রোল দেওয়া হয়েছে','success')->position('middle');
            return back();
        }
    }

    public function resetAllRole(Request $request)
    {
        if($request->userType != 2){
            Alert::toast('দুঃখিত, অ্যাক্সেস করা যায় নি।','error')->position('middle');
            return back();
        }else{
            $assignedRole = DB::table('model_has_roles AS MHR')
                            ->join('roles','MHR.role_id', '=', 'roles.id')
                            ->join('users AS US','MHR.model_id', '=', 'US.id')
                            ->select('roles.id AS role_id', 'roles.name AS role_name', 'US.name As username', 'US.id AS user_id', 'MHR.model_id')
                            ->where('US.union_id', '=', auth()->user()->union_id)
                            ->where('US.type', '!=', 2)
                            ->get();
            foreach($assignedRole as $user){
                DB::table('model_has_permissions')->where('model_id', $user->user_id)->delete();
                User::find($user->user_id)->removeRole($user->role_name);
            }

            Alert::toast('সকল কর্মকর্তার রোল রিসেট করা হয়েছে।','success')->position('middle');
            return back();
        }
    }


    public function resetRole(Request $request)
    {
        if($request->userType == 2 || auth()->user()->role_id == 1){
            DB::table('model_has_permissions')->where('model_id', $request->userId)->delete();
            User::find($request->userId)->removeRole(Role::findById($request->roleId));

            Alert::toast('কর্মকর্তার রোল রিসেট করা হয়েছে।','success')->position('middle');
            return back();
        }else{
            Alert::toast('দুঃখিত, অ্যাক্সেস করা যায় নি।','error')->position('middle');
            return back();
        }
    }
}
