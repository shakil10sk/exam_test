<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Global_model;
use App\User;
use App\Models\Management\Employee\Employee;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use union_information;

class SuperAdmin extends Model
{


    //this is for union list
    public function union_list_data($district_id = null, $upazila_id = null, $union_code = null, $search_content, $start, $limit)
    {

        // DB::enableQueryLog();

        $query = DB::table('union_information AS UI')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS UI.id as up_id'), 'UI.*', 'UADD1.bn_name as union_district_name_bn', 'UADD1.en_name as union_district_name_en', 'UADD2.bn_name as union_upazila_name_bn', 'UADD2.en_name as union_upazila_name_en', 'UADD3.bn_name as union_postoffice_name_bn', 'UADD3.en_name as union_postoffice_name_en', 'UGS.username', 'UGS.password', 'UGS.role_id', 'UGS.type')
            ->join('users AS UGS', function ($join) {

                $join->on('UGS.union_id', '=', 'UI.union_code')
                    ->where('UGS.type', 2)
                    ->where('UGS.status', 1);
            })
            ->join('bd_locations AS UADD1', 'UADD1.id', '=', 'UI.district_id')
            ->join('bd_locations AS UADD2', 'UADD2.id', '=', 'UI.upazila_id')
            ->join('bd_locations AS UADD3', 'UADD3.id', '=', 'UI.postal_id')
            ->whereNull('UI.deleted_at')
            ->where(function ($query) use ($district_id, $upazila_id, $union_code) {

                if ($district_id > 0) {
                    $query->Where("UI.district_id", $district_id);
                }
                if ($upazila_id > 0) {
                    $query->Where("UI.upazila_id", '=', $upazila_id);
                }
                if ($union_code > 0) {
                    $query->Where("UI.union_code", $union_code);
                }
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy('UI.id', 'DESC');

        //for searching on page
        if ($search_content) {

            $query->where(function ($query) use ($search_content) {

                return $query->Where("UI.sub_domain", "LIKE", "%" . $search_content . "%")
                    ->orWhere("UI.union_code", "LIKE", "%" . $search_content . "%")
                    ->orWhere("UI.bn_name", "LIKE", "%" . $search_content . "%")
                    ->orWhere("UI.mobile", "LIKE", "%" . $search_content . "%");
            });
        }


        $data['data'] = $query->get();

        return $data;
    }

    //union informatin save
    public function union_information_save($receive, $user_data = null)
    {

        //create union informatin array
        $union_info = [

            'district_id' => $receive['district_id'],
            'upazila_id' => $receive['upazila_id'],
            'postal_id' => $receive['district_id'],
            'union_code' => $receive['union_code'],
            'en_name' => $receive['en_name'],
            'bn_name' => $receive['bn_name'],
            'postal_code' => $receive['postal_code'],
            'village_bn' => $receive['village_bn'],
            'village_en' => $receive['village_en'],
            'email' => $receive['email'],
            'mobile' => $receive['mobile'],
            'sub_domain' => strtolower($receive['sub_domain']),
            'is_header_active' => ($receive['is_header_active']) ? 1 : 0,
            'pre_select' => (($receive['pre_select'] ?? 0) === "on") ? 1 : 0,
            'about' => $receive['about'],
            'google_map' => $receive['google_map'],

            'created_by' => Auth::user()->id,
            'created_by_ip' => Request::ip(),
            'created_at' => Carbon::now(),
        ];

        // dd($receive->all());

        //transection start
        DB::beginTransaction();

        try {

            //union main logo added in info array
            if ($receive->hasFile("main_logo")) {

                //insert image
                $image = $receive->file("main_logo");

                $img = "main_logo_" . $receive->union_code . "." . $image->getClientOriginalExtension();

                $location = public_path("assets/images/union_profile/" . $img);

                //upload image in folder
                $move = Image::make($image)->resize(500, 500)->save($location);

                if ($move) {
                    $union_info['main_logo'] = $img;
                }
            }

            //union brand logo added in info array
            if ($receive->hasFile("brand_logo")) {

                //insert image
                $image = $receive->file("brand_logo");

                $img = "brand_logo_" . $receive->union_code . "." . $image->getClientOriginalExtension();

                $location = public_path("assets/images/union_profile/" . $img);

                //upload image in folder
                $move = Image::make($image)->resize(100, 100)->save($location);

                if ($move) {
                    $union_info['brand_logo'] = $img;
                }
            }

            //union jolchap added in info array
            if ($receive->hasFile("jolchap")) {

                //insert image
                $image = $receive->file("jolchap");

                $img = "jolchap_" . $receive->union_code . "." . $image->getClientOriginalExtension();

                $location = public_path("assets/images/union_profile/" . $img);

                //upload image in folder
                $move = Image::make($image)->resize(900, 900)->opacity(22)->save($location);

                if ($move) {
                    $union_info['jolchap'] = $img;
                }
            }

            //union profile insert
            $union_profile_insert = DB::table('union_information')->insert($union_info);

            //get union profile last insert id
            $union_last_id = DB::getPdo()->lastInsertId();

            //employee id generated
            $employee_id = IdGenerate::employee_id($receive->union_code, $union_last_id);

            //secretery role create
            $secretary = Role::create(['name' => 'SECRETRY_' . $receive['union_code'], 'union_id' => $receive->union_code]);

            //udc role create
            $udc = Role::create(['name' => 'udc_' . $receive['union_code'], 'union_id' => $receive->union_code]);

            //other role create
            $others = Role::create(['name' => 'others_' . $receive['union_code'], 'union_id' => $receive->union_code]);

            //get all permission
            $permissions = Permission::get();

            //secretery all permission assign
            $secretary->syncPermissions($permissions);

            //udc permission assign
            $udc->givePermissionTo('application');
            $udc->givePermissionTo('edit');
            $udc->givePermissionTo('delete');
            $udc->givePermissionTo('generate');
            $udc->givePermissionTo('certificate');
            $udc->givePermissionTo('nagorik');


            //other permission assign
            $others->givePermissionTo('application');
            $others->givePermissionTo('edit');
            $others->givePermissionTo('delete');
            $others->givePermissionTo('generate');
            $others->givePermissionTo('certificate');
            $others->givePermissionTo('nagorik');

            //user crediential insert
            $user = Factory(User::class)->create([

                'union_id' => $receive->union_code,
                'employee_id' => $employee_id,
                'name' => 'Secretery',
                'username' => $employee_id,
                'email' => "admins@gmail.com",
                'password' => bcrypt($employee_id),
                'role_id' => $secretary->id,
                'type' => 2,
                'username' => $employee_id,

                'created_by' => Auth::user()->id,
                'created_by_ip' => $receive->ip(),
                'created_at' => Carbon::now(),

            ]);

            //empolyee credential added
            $employee = Employee::create(
                [

                    'employee_id' => $employee_id,
                    'union_id' => $receive->union_code,
                    'name' => 'Secretary',
                    'designation_id' => 2,
                    'district_id' => $receive->district_id,
                    'upazila_id' => $receive->upazila_id,
                    'postal_id' => $receive->district_id,
                    'sequence' => 1,
                    'is_active' => 1,
                    'status' => 1,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => $receive->ip(),
                    'created_at' => Carbon::now(),

                ]
            );


            //Model has role assign
            $user->assignRole($secretary);


            $sonod_sign_print_list = [

                '1' => 'নাগরিক সনদ',
                '2' => 'মৃত্যু সনদ',
                '3' => 'অবিবাহিত সনদ',
                '4' => 'পুনঃবিবাহ না হওয়া সনদ',
                '5' => 'একই নামের প্রত্যয়ন',
                '6' => 'সনাতন ধর্ম অবলম্বি সনদ',
                '7' => 'প্রত্যয়ন',
                '8' => 'নদী ভাঙনের সনদ',
                '9' => 'চারিত্রিক সনদ',
                '10' => 'ভূমিহীন সনদ',
                '11' => 'বার্ষিক আয়ের সনদ',
                '12' => 'প্রকৃত বাক ও শ্রবণ প্রতিবন্ধী সনদ',
                '13' => 'অনুমতি সনদ',
                '14' => 'ভোটার আইডি স্থানান্তর সনদ',
                '15' => 'অনাপত্তি পত্র',
                '16' => 'রাস্তা খনন',
                '17' => 'ওয়ারিশ সনদ',
                '18' => 'পারিবারিক সনদ',
                '19' => 'ট্রেড লাইসেন্স',
                '20' => 'বিবাহিত সনদ',
                // পৌরসভা //
                '90' => 'প্রিমিসেস',
                '91' => 'পোষা প্রাণীর সনদ',
                '92' => 'নতুন হোল্ডিং সনদ',
                '93' => 'নতুন হোল্ডিং নামজারী সনদ',
                '94' => 'রাস্তা খননের অনুমতি সনদ',
                '95' => 'ইমারত নির্মাণ অনুমতি সনদ',
                '96' => 'ভূমি ব্যবহার ছাড়পত্রের সনদ',
            ];


            // default print settings

            foreach ($sonod_sign_print_list as $key => $value) {

                DB::table('print_settings')->insert([
                    'type' => $key,
                    'union_id' => $receive['union_code'],
                    'application_type' => 1,
                    'chairman' => 1,
                    'created_by' => auth()->user()->employee_id,
                    'created_by_ip' => Request::ip(),
                    'created_at' => date('Y-m-d h:i:s')
                ]);

                DB::table('print_settings')->insert([
                    'type' => $key,
                    'union_id' => $receive['union_code'],
                    'application_type' => 2,
                    'chairman' => 0,
                    'created_by' => auth()->user()->employee_id,
                    'created_by_ip' => Request::ip(),
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }

            //sonod account create
            $sonod_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 101,
                'account_name' => "সনদ ফি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $sonod_account_insert = DB::table('acc_account')->insert($sonod_account);

            //get sonod account last insert id
            $sonod_fee_acc_id = DB::getPdo()->lastInsertId();


            $sonod_child_account_list = [

                '1' => 'নাগরিক সনদ',
                '2' => 'মৃত্যু সনদ',
                '3' => 'অবিবাহিত সনদ',
                '4' => 'পুনঃবিবাহ না হওয়া সনদ',
                '5' => 'একই নামের প্রত্যয়ন',
                '6' => 'সনাতন ধর্ম অবলম্বি সনদ',
                '7' => 'প্রত্যয়ন',
                '8' => 'নদী ভাঙনের সনদ',
                '9' => 'চারিত্রিক সনদ',
                '10' => 'ভূমিহীন সনদ',
                '11' => 'বার্ষিক আয়ের সনদ',
                '12' => 'প্রকৃত বাক ও শ্রবণ প্রতিবন্ধী সনদ',
                '13' => 'অনুমতি সনদ',
                '14' => 'ভোটার আইডি স্থানান্তর সনদ',
                '15' => 'অনাপত্তি পত্র',
                '16' => 'রাস্তা খনন',
                '17' => 'ওয়ারিশ সনদ',
                '18' => 'পারিবারিক সনদ',
                '20' => 'বিবাহিত সনদ',
            ];


            //create sonod fee account child account

            $sonod_fee_child_account = [];
            $code = 102;

            foreach ($sonod_child_account_list as $key => $value) {

                $sonod_fee_child_account[] = [

                    'parent_id' => $sonod_fee_acc_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 101,
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            //sonod fee child account insert
            $sonod_child_account_insert = DB::table('acc_account')->insert($sonod_fee_child_account);

            //License fee account create
            $license_account = [

                // 'parent_id' => $sonod_fee_acc_id,
                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 121,
                'account_name' => "লাইসেন্স ফি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $license_account_insert = DB::table('acc_account')->insert($license_account);

            //get license account last insert id
            $license_account_id = DB::getPdo()->lastInsertId();

            //license account list
            $license_account_list = [

                '19' => 'ট্রেড লাইসেন্স',
                '21' => 'সাইনবোর্ড কর',
                '22' => 'সাব চার্জ',
                '97' => 'উৎসেকর',
            ];


            $license_child_account = [];
            $code = 122;

            foreach ($license_account_list as $key => $value) {

                //create license child account
                $license_child_account[] = [

                    'parent_id' => $license_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 121,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $license_child_account_insert = DB::table('acc_account')->insert($license_child_account);

            //Other account list
            $other_account_list = [

                '23' => 'বকেয়া',
                '24' => 'ছাড়',
                '25' => 'ভ্যাট (১৫%)',
                '26' => 'ক্যাশ'

            ];


            $other_account = [];
            $code = 125;

            foreach ($other_account_list as $key => $value) {

                //other account
                $other_account[] = [

                    'parent_id' => NULL,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => $code,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $other_account_insert = DB::table('acc_account')->insert($other_account);

            //bank main head data
            $bank_head = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 129,
                'account_name' => 'ব্যাংক',
                'acc_type' => 27,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),

            ];

            $bank_head_insert = DB::table('acc_account')->insert($bank_head);

            //get bank account last insert id
            $bank_head_id = DB::getPdo()->lastInsertId();

            //bank account list
            $bank_account_list = [

                '130' => 'জন্ম নিবন্ধন',
                '131' => 'নিজস্ব তহবিল',
                '132' => 'উন্নয়ন তহবিলঃ অ,দ,ক,ক',
                '133' => 'উন্নয়ন তহবিলঃএল,জি,এসপি',
                '134' => 'উন্নয়ন তহবিল ভূমি হস্তান্তর কর ১ %',
            ];

            $bank_child_account = [];
            $acc_type = 30;
            foreach ($bank_account_list as $key => $value) {

                //bank child account
                $bank_child_account[] = [

                    'parent_id' => $bank_head_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $key,
                    'account_name' => $value,
                    'acc_type' => $acc_type++,
                    'head_type' => 129, //because bank account code  = 129

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $bank_account_insert = DB::table('acc_account')->insert($bank_child_account);

            //Tax account create
            $tax_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 135,
                'account_name' => "কর ও রেট",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $tax_account_insert = DB::table('acc_account')->insert($tax_account);

            //get tax account last insert id
            $tax_account_id = DB::getPdo()->lastInsertId();


            //tax child account list
            $tax_child_account_list = [

                '28' => 'পেশা জীবিকা কর',
                '29' => 'বসতভিটা কর',
            ];

            $tax_child_account = [];
            $code = 136;

            foreach ($tax_child_account_list as $key => $value) {

                //bank child account
                $tax_child_account[] = [

                    'parent_id' => $tax_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 135,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $bank_child_account_insert = DB::table('acc_account')->insert($tax_child_account);


            //relief account create
            $relief_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 139,
                'account_name' => "ত্রান",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $relief_account_insert = DB::table('acc_account')->insert($relief_account);

            //get relief account last insert id
            $relief_account_id = DB::getPdo()->lastInsertId();


            //relief child account list
            $relief_child_account_list = [

                '35' => 'ভিজিড',
                '36' => 'ভিজিএফ',
                '37' => 'অন্যান্য (ত্রান)',
            ];

            $relief_child_account = [];
            $code = 140;

            foreach ($relief_child_account_list as $key => $value) {

                //relief child account
                $relief_child_account[] = [

                    'parent_id' => $relief_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 139,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $relief_child_account_insert = DB::table('acc_account')->insert($relief_child_account);


            //self fund other account creat
            $self_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 143,
                'account_name' => "নিজস্ব খাতে অন্যান্য",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $self_account_insert = DB::table('acc_account')->insert($self_account);

            //get self account last insert id
            $self_account_id = DB::getPdo()->lastInsertId();


            //self child account list
            $self_child_account_list = [

                '38' => 'মোকদ্দমা ফি',
                '39' => 'বিবিধ'
            ];

            $self_child_account = [];
            $code = 144;

            foreach ($self_child_account_list as $key => $value) {

                //self child account
                $self_child_account[] = [

                    'parent_id' => $self_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 143,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $self_child_account_insert = DB::table('acc_account')->insert($self_child_account);

            //LGSP account creat
            $lgsp_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 146,
                'account_name' => "এল জি এস পি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $lgsp_account_insert = DB::table('acc_account')->insert($lgsp_account);

            //lgsp last insert id
            $lgsp_account_id = DB::getPdo()->lastInsertId();


            //lgsp child account list
            $lgsp_child_account_list = [

                '40' => 'বিবিজি-১',
                '41' => 'বিবিজি-২',
                '42' => 'পিবিজি'
            ];

            $lgsp_child_account = [];
            $code = 147;

            foreach ($lgsp_child_account_list as $key => $value) {

                //lgsp child account
                $lgsp_child_account[] = [

                    'parent_id' => $lgsp_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 147,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $lgsp_child_account_insert = DB::table('acc_account')->insert($lgsp_child_account);


            //lease account creat
            $lease_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 150,
                'account_name' => "ইজারা",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $lease_account_insert = DB::table('acc_account')->insert($lease_account);

            //lease last insert id
            $lease_account_id = DB::getPdo()->lastInsertId();


            //lease child account list
            $lease_child_account_list = [

                '43' => 'বিনোদন কর, যাত্রা, নাটক ও অন্যান্য',
                '44' => 'হাট বাজার',
                '45' => 'ফেরী ঘাট',
                '46' => 'জলমহাল',

            ];

            $lease_child_account = [];
            $code = 151;

            foreach ($lease_child_account_list as $key => $value) {

                //lease child account
                $lease_child_account[] = [

                    'parent_id' => $lease_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 150,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $lease_child_account_insert = DB::table('acc_account')->insert($lease_child_account);

            //other_receive account creat
            $other_receive_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 155,
                'account_name' => "অন্যান্য প্রাপ্তি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $other_receive_account_insert = DB::table('acc_account')->insert($other_receive_account);

            //other_receive last insert id
            $other_receive_account_id = DB::getPdo()->lastInsertId();


            //other_receive child account list
            $other_receive_child_account_list = [

                '47' => 'বিজিডি ও ভিজিএফ (অন্যান্য প্রাপ্তি)',
                '48' => 'ব্যাংক জমা এলজিএসপি',
            ];

            $other_receive_child_account = [];
            $code = 156;

            foreach ($other_receive_child_account_list as $key => $value) {

                //other_receive child account
                $other_receive_child_account[] = [

                    'parent_id' => $other_receive_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 155,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $other_receive_child_account_insert = DB::table('acc_account')->insert($other_receive_child_account);

            //generel instalation account creat
            $generel_install_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 158,
                'account_name' => "সাধারণ সংস্থাপন",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $generel_install_account_insert = DB::table('acc_account')->insert($generel_install_account);

            //generel_install last insert id
            $generel_install_account_id = DB::getPdo()->lastInsertId();


            //generel_install child account list
            $generel_install_child_account_list = [

                '49' => 'অন্যান্য (সাধারণ সংস্থাপন)',
                '50' => 'চেয়ারম্যান ও সদসদের ভাতা',
                '51' => 'সেক্রেটারি ও অন্যান্য কর্মচারীদের‍ বেতন',
                '52' => 'কর আদায় বাবদ ব্যয়',
                '53' => 'প্রিন্টিং এবং ষ্টেশনারী',
                '54' => 'তথ্য ও প্রযুক্তি',
                '55' => 'বিদ্যুৎ বিল',
                '56' => 'অফিস রক্ষণাবেক্ষণ',
                '57' => 'আনুসাঙ্গিক ব্যয়',
                '58' => 'যাতায়াত ব্যয়',
                '59' => 'আপ্যায়ন',
                '60' => 'জ্বালানী',
                '61' => 'ট্রেড লাইসেন্সর ভ্যাট জমা',
                '62' => 'ভিজিডি ও ভিজিএফ লোডিং আনলোডিং ও পরিবহন ব্যয়',
                '63' => 'পরিছন্ন কর্মীর বেতন',
                '64' => 'পত্রিকা বিল',
                '65' => 'ট্রেড লাইসেন্স আদায় কমিশন'
            ];

            $generel_install_child_account = [];
            $code = 159;

            foreach ($generel_install_child_account_list as $key => $value) {

                //generel_install child account
                $generel_install_child_account[] = [

                    'parent_id' => $generel_install_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 158,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $generel_install_account_insert = DB::table('acc_account')->insert($generel_install_child_account);


            //development account creat
            $development_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 176,
                'account_name' => "উন্নয়ন কাজ-যোগাযোগ,স্বাস্থ্য,পানি সরবরাহ,প্রাকৃতিক সম্পদ ব্যবস্থাপনা,শিক্ষা,মানব সম্পদ উন্নয়ন",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $development_account_insert = DB::table('acc_account')->insert($development_account);

            //development last insert id
            $development_account_id = DB::getPdo()->lastInsertId();


            //development child account list
            $development_child_account_list = [

                '66' => 'অনুদান',
                '67' => 'কাবিখা',
                '68' => 'টি আর',
                '69' => 'এলজিএসপি',
                '70' => 'অতিদরিদ্য কর্মসূচি',
                '71' => 'এডিপি',
                '72' => 'থোক',
                '73' => 'ভূমি হস্তান্তর কর(১%)'
            ];

            $development_child_account = [];
            $code = 177;

            foreach ($development_child_account_list as $key => $value) {

                //development child account
                $development_child_account[] = [

                    'parent_id' => $development_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 176,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $development_account_insert = DB::table('acc_account')->insert($development_child_account);


            //Other exp account creat
            $other_exp_account = [

                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 185,
                'account_name' => "বিবিধ - অন্যান্য ব্যয়",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $other_exp_account_insert = DB::table('acc_account')->insert($other_exp_account);

            //other_exp last insert id
            $other_exp_account_id = DB::getPdo()->lastInsertId();


            //other_exp child account list
            $other_exp_child_account_list = [

                '74' => 'নিজস্ব তহবিল হতে ব্যয়',
                '75' => 'ব্যাংক চার্জ- নিজস্ব তহবিল',
                '76' => 'ব্যাংক চার্জ- জন্ম নিবন্ধন',
                '77' => 'ব্যাংক চার্জ- ভূমি হস্তান্তর কর(১%)',
                '78' => 'ব্যাংক চার্জ- এলজিএসপি'
            ];

            $other_exp_child_account = [];
            $code = 186;

            //other exp child account list
            foreach ($other_exp_child_account_list as $key => $value) {

                //other_exp child account
                $other_exp_child_account[] = [

                    'parent_id' => $other_exp_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 185,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            //other exp account insert
            $other_exp_account_insert = DB::table('acc_account')->insert($other_exp_child_account);


            //extra account
            $extra_account = [

                '79' => 'সরকারি অনুদান-ভূমি হস্তান্তর কর(১%)',
                '80' => 'সরকারি অনুদান-সংস্থাপন',
                '81' => 'এলজিএসপি ফান্ড ফেরত হইতে ব্যয়',
                '82' => 'বিবিধ - অগ্রিম',
                '83' => 'স্থাবর সম্পত্তি হস্তান্তর কর ১%',
                '84' => 'বিনিয়োগ হতে আয়',
                '85' => 'অনুদান হতে আয়',
                '86' => 'উন্নয়ন খাতে অন্যান্য',
                '87' => 'মৃত্যু নিবধন ফি',
            ];

            $extra_child_account = [];
            $code = 191;

            foreach ($extra_account as $key => $value) {

                //extra child account
                $extra_child_account[] = [

                    'parent_id' => NULL,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => NULL,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $extra_account_insert = DB::table('acc_account')->insert($extra_child_account);

            //  ======================== পৌরসভা ================================ //

            // premises license fee account create
            $premises_account = [
                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 201,
                'account_name' => "প্রিমিসেস ফি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];
            $premises_account_insert = DB::table('acc_account')->insert($premises_account);

            //get premises license account last insert id
            $premises_account_id = DB::getPdo()->lastInsertId();

            //premises license account list
            $premises_account_list = [

                '90' => 'প্রিমিসেস লাইসেন্স',
                '21' => 'সাইনবোর্ড কর',
                '22' => 'সাব চার্জ',
                '97' => 'উৎসেকর',
            ];


            $premises_child_account = [];
            $code = 202;

            foreach ($premises_account_list as $key => $value) {

                //create license child account
                $premises_child_account[] = [

                    'parent_id' => $premises_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 201,

                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            $premises_child_account_insert = DB::table('acc_account')->insert($premises_child_account);


            // animals license fee account create
            $animals_account = [
                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 208,
                'account_name' => "পোষা প্রাণীর ফি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $animals_account_insert = DB::table('acc_account')->insert($animals_account);

            //get animals license account last insert id
            $animals_account_id = DB::getPdo()->lastInsertId();

            //premises license account list
            $animals_account_list = [

                '91' => 'পোষা প্রাণীর সনদ',
                '22' => 'সাব চার্জ',
                '97' => 'উৎসেকর',
            ];

            $animals_child_account = [];
            $code = 209;

            foreach ($animals_account_list as $key => $value) {

                //create animals license child account
                $animals_child_account[] = [

                    'parent_id' => $animals_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 208,
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }


            $animals_child_account_insert = DB::table('acc_account')->insert($animals_child_account);


            //========== holding namjari sonod ================//

            // namjari license fee account create
            $namjari_account = [
                'parent_id' => NULL,
                'union_id' => $receive['union_code'],
                'account_code' => 212,
                'account_name' => "হোল্ডিং নামজারী সনদ ফি",
                'acc_type' => NULL,
                'head_type' => NULL,

                'created_by' => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time' => Carbon::now(),
            ];

            $namjari_account_insert = DB::table('acc_account')->insert($namjari_account);

            //get animals license account last insert id
            $namjari_account_id = DB::getPdo()->lastInsertId();


            //namjari license account list
            $namjari_account_list = [

                '93' => 'হোল্ডিং নামজারী সনদ সনদ',
                '98' => 'পূর্বোক্ত হোল্ডিং কর',
                '99' => 'হোল্ডিং কর',
            ];

            $namjari_child_account = [];
            $code = 213;

            foreach ($namjari_account_list as $key => $value) {

                //create animals license child account
                $namjari_child_account[] = [

                    'parent_id' => $namjari_account_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 212,
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }


            $namjari_child_account_insert = DB::table('acc_account')->insert($namjari_child_account);



            // poyroshova others sonod //
            $poyroshova_sonod_lists = [
                '94' => 'রাস্তা খননের অনুমতি সনদ',
                '95' => 'ইমারত নির্মাণ অনুমতি সনদ',
                '96' => 'ভূমি ব্যবহার ছাড়পত্রের সনদ',
            ];

            //create poyroshova sonod fee account child account
            $poyroshova_sonod_fee_child_account = [];
            $code = 216;

            foreach ($poyroshova_sonod_lists as $key => $value) {

                $poyroshova_sonod_fee_child_account[] = [

                    'parent_id' => $sonod_fee_acc_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $code++,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'head_type' => 101,
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now(),

                ];
            }

            // poyroshova sonod fee child account insert
            $sonod_child_account_insert = DB::table('acc_account')->insert($poyroshova_sonod_fee_child_account);

            // pauro market management accounts
            $market_acc = [
                'parent_id'     => NULL,
                'union_id'      => $receive['union_code'],
                'account_code'  => 100,
                'account_name'  => "পৌর মার্কেট হিসাব",
                'acc_type'      => 100,
                'created_by'    => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time'  => Carbon::now()
            ];

            DB::table('acc_account')->insert($market_acc);

            // get last insert id
            $market_acc_id = DB::getPdo()->lastInsertId();

            // sub account list
            $market_sub_acc_list = [
                '101' => 'সেলামী',
                '102' => 'ভাড়া',
                '103' => 'নবায়ন ফি',
                '104' => 'মালিকানা পরিবর্তন ফি',
            ];

            $market_sub_acc = [];

            foreach ($market_sub_acc_list as $key => $value) {
                $market_sub_acc[] = [
                    'parent_id' => $market_acc_id,
                    'union_id' => $receive['union_code'],
                    'account_code' => $key,
                    'account_name' => $value,
                    'acc_type' => $key,
                    'created_by' => Auth::user()->id,
                    'created_by_ip' => Request::ip(),
                    'created_time' => Carbon::now()
                ];
            }

            DB::table('acc_account')->insert($market_sub_acc);
            // end market account


            // market association  accounts
            $association_acc = [
                'parent_id'     => NULL,
                'union_id'      => $receive['union_code'],
                'account_code'  => 105,
                'account_name'  => "সমিতি কালেকশান হিসাব",
                'acc_type'      => 105,
                'created_by'    => Auth::user()->id,
                'created_by_ip' => Request::ip(),
                'created_time'  => Carbon::now()
            ];

            DB::table('acc_account')->insert($association_acc);
            // market association  accounts end



            DB::commit();
            // all good

            return ["status" => "success", "message" => "পৌরসভা টি সফলভাবে রেজিষ্ট্রেশন করা হয়েছে"];

        } catch (Throwable $e) {

            DB::rollback();
            throw $e;
            // something went wrong
            return ["status" => "error", "message" => "পৌরসভা টি রেজিষ্ট্রেশন সমস্যা হয়েছে", 'error_message' => $e->getMessage()];
        }


    }

    //get union edit information
    public function union_information($id = null)
    {

        $data = DB::table('union_information AS UI')
            ->join('bd_locations AS UADD1', 'UADD1.id', '=', 'UI.district_id')
            ->join('bd_locations AS UADD2', 'UADD2.id', '=', 'UI.upazila_id')
            ->join('bd_locations AS UADD3', 'UADD3.id', '=', 'UI.postal_id')
            ->select('UI.*', 'UADD1.bn_name as union_district_name_bn', 'UADD1.en_name as union_district_name_en', 'UADD2.bn_name as union_upazila_name_bn', 'UADD2.en_name as union_upazila_name_en', 'UADD3.bn_name as union_postoffice_name_bn', 'UADD3.en_name as union_postoffice_name_en')
            ->where([
                ['UI.id', '=', $id],
                ['UI.status', '=', 1],
            ])
            ->first();
        // dd($data);
        return $data;
    }

    //union update save
    public function union_update_save($receive)
    {


        //create union informatin array
        $union_update_data = [

            'district_id' => $receive['district_id'],
            'upazila_id' => $receive['upazila_id'],
            'postal_id' => $receive['postal_id'],
            'en_name' => $receive['en_name'],
            'bn_name' => $receive['bn_name'],
            'postal_code' => $receive['postal_code'],
            'village_bn' => $receive['village_bn'],
            'village_en' => $receive['village_en'],
            'email' => $receive['email'],
            'mobile' => $receive['mobile'],
            'sub_domain' => strtolower($receive['sub_domain']),
            'is_header_active' => ($receive['is_header_active']) ? 1 : 0,
            'pre_select' => (($receive['pre_select'] ?? 0) === "on") ? 1 : 0,
            'about' => $receive['about'],
            'google_map' => $receive['google_map'],
            'updated_by' => Auth::user()->id,
            'updated_by_ip' => Request::ip(),
            'updated_at' => Carbon::now(),
            'is_process' => 0,
            'is_process_web' => 0,
        ];

        // union code update
        $old_union_id = DB::table('union_information')->find($receive['row_id'])->union_code;


        if ($old_union_id != $receive['union_code']) {

            if (DB::table('application')->where('union_id', $old_union_id)->count() < 10) {
                $select_query = 'SELECT TABLE_NAME as tbl, COLUMN_NAME as col, data_type    FROM  INFORMATION_SCHEMA.COLUMNS   WHERE (COLUMN_name = "union_id" OR  COLUMN_name = "union_code") AND table_schema = "' . env('DB_DATABASE') . '";';

                $all_tables = DB::select(DB::raw($select_query));

                if (count($all_tables)) {

                    foreach ($all_tables as $item) {

                        DB::table($item->tbl)->where($item->col, $old_union_id)
                            ->update([$item->col => $receive['union_code']]);
                    }
                }
            } else {
                return ['status' => 'error', 'message' => 'পৌরসভা কোড আপডেট করা যাবে না। ১০ এর বেশি আবেদন করা হয়াছে।'];
            }
        }


        //union main logo added in info array
        if ($receive->hasFile("main_logo")) {

            //insert image
            $image = $receive->file("main_logo");

            $img = "main_logo_" . $receive->union_code . "." . $image->getClientOriginalExtension();

            $location = public_path("assets/images/union_profile/" . $img);

            //upload image in folder
            $move = Image::make($image)->resize(500, 500)->save($location);

            if ($move) {
                $union_update_data['main_logo'] = $img;
            }
        }

        //union brand logo added in info array
        if ($receive->hasFile("brand_logo")) {

            //insert image
            $image = $receive->file("brand_logo");

            $img = "brand_logo_" . $receive->union_code . "." . $image->getClientOriginalExtension();

            $location = public_path("assets/images/union_profile/" . $img);

            //upload image in folder
            $move = Image::make($image)->resize(100, 100)->save($location);

            if ($move) {
                $union_update_data['brand_logo'] = $img;
            }
        }

        //union jolchap added in info array
        if ($receive->hasFile("jolchap")) {

            //insert image
            $image = $receive->file("jolchap");

            $img = "jolchap_" . $receive->union_code . "." . $image->getClientOriginalExtension();

            $location = public_path("assets/images/union_profile/" . $img);

            //upload image in folder
            $move = Image::make($image)->resize(900, 900)->opacity(22)->save($location);

            if ($move) {
                $union_update_data['jolchap'] = $img;
            }
        }

        $union_update = DB::table('union_information')->where('id', $receive['row_id'])->update($union_update_data);

        return ['status' => 'success', 'message' => 'Union update successfully'];
    }


    //bd location list data
    public function bd_location_list_data($district_id = null, $upazila_id = null, $postoffice_id = null, $search_content, $start, $limit)
    {

        $query = DB::table('bd_locations AS post')
            ->select(DB::raw('SQL_CALC_FOUND_ROWS post.id as post_id'), 'post.type',
                'post.id', 'post.post_code', 'post.parent_id', 'post.bn_name as post_bn', 'post.en_name as post_en',
                'upa.id as upa_id', 'upa.bn_name as upa_bn', 'upa.en_name as upa_en',
                'dis.id as dis_id', 'dis.bn_name as dis_bn', 'dis.en_name as dis_en')
            ->leftJoin('bd_locations as upa', 'upa.id', 'post.parent_id')
            ->leftJoin('bd_locations as dis', 'dis.id', 'upa.parent_id')
            ->leftJoin('bd_locations as divi', 'divi.id', 'dis.parent_id')
            ->where('post.type', '!=', '1')/* divition */
            ->where('post.type', '!=', '4')/* thana */
            ->where('post.type', '!=', '5') /* union */
        ;

        if ($district_id && !$upazila_id) {
            $query->where('upa.parent_id', $district_id)
                ->orWhere('post.parent_id', $district_id);
        } else if ($upazila_id) {
            $query->where('post.parent_id', $upazila_id);
        } else if ($postoffice_id) {
            $query->where('post.id', $postoffice_id);
        }

        // //for searching on page
        if ($search_content) {

            $query->where("post.en_name", "LIKE", '%' . $search_content . '%')
                ->orWhere("post.bn_name", "LIKE", '%' . $search_content . '%');

        }

        if ($limit != -1) {

            $query->offset($start)
                ->limit($limit);
        }

        $data['data'] = $query->get();

        // dd($data['data']);
        return $data;
    }


    //=======bd location save======//

    public function bd_location_save($receive)
    {

        $where = [
            "parent_id" => $receive['parent_id'],
            "en_name" => $receive['en_name'],
            "bn_name" => $receive['bn_name'],
            "type" => $receive['type'],
        ];

        $existing_check = DB::table("bd_locations")->where($where)->count();

        if ($existing_check > 0) {
            return ["status" => "error", "message" => "This location already exist !, Please try anoter location.", "data" => []];
        }

        $insert = DB::table("bd_locations")->insert($receive);

        if ($insert) {
            return ["status" => "success", "message" => "Location Added Successfull.", "data" => []];
        } else {
            return ["status" => "error", "message" => "Location added failed.", "data" => []];
        }
    }


    //=======bd location update save======//

    public function bd_location_update_save($receive, $id)
    {

        $where = [

            "parent_id" => $receive['parent_id'],
            "en_name" => $receive['en_name'],
            "bn_name" => $receive['bn_name'],
            "type" => $receive['type'],
        ];

        $existing_check = DB::table("bd_locations")
            ->where($where)
            ->where('id', '!=', $id)
            ->count();

        if ($existing_check > 0) {
            return ["status" => "error", "message" => "This location already exist !, Please try anoter location.", "data" => []];
        }

        // DB::enableQueryLog();

        $insert = DB::table("bd_locations")->where("id", $id)->update($receive);

        if ($insert) {
            return ["status" => "success", "message" => "Location Update Successfull.", "data" => []];
        } else {
            return ["status" => "error", "message" => "Location Update failed.", "data" => []];
        }
    }

    //===bd_location delete====//

    public function bd_location_delete($id)
    {

        $delete = DB::table('bd_locations')->where('id', $id)->delete();

        if ($delete) {
            return ["status" => "success", "message" => "Location delete Successfull.", "data" => []];
        } else {
            return ["status" => "error", "message" => "Location delete failed.", "data" => []];
        }
    }

    //==trade fee update save
    public function trade_fee_update_save($receive)
    {


        DB::beginTransaction();

        try {

            //ready trans section data
            $fee_data = [
                'amount' => $receive->fee,
                'updated_by' => Auth::user()->id,
                'updated_time' => date('Y-m-d h:i:s'),
                'updated_by_ip' => Request::ip(),

            ];

            DB::table('acc_transaction')->where(['id' => $receive->fee_id, 'union_id' => $receive->union_id])->update($fee_data);


            //if have due
            if ($receive->due_id > 0) {

                if ($receive->due > 0) {

                    $due_update_data = [
                        'amount' => $receive->due,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->due_id, 'union_id' => $receive->union_id])->update($due_update_data);

                } else {

                    $due_update_data = [
                        'is_active' => 0,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->due_id, 'union_id' => $receive->union_id])->update($due_update_data);


                }


            } else {

                if ($receive->due > 0) {

                    //get due account id
                    $due_account_id = Global_model::get_account_id($receive->union_id, 23);

                    if ($due_account_id < 0) {

                        return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];

                    } else {

                        $due_new_data = [
                            'union_id' => $receive->union_id,
                            'fiscal_year_id' => $receive->fiscal_year_id,
                            'voucher' => $receive->voucher,
                            'sonod_no' => $receive->sonod_no,
                            'amount' => $receive->due,
                            'debit' => $due_account_id,
                            'credit' => 28,
                            'type' => 19,

                            'created_by' => Auth::user()->id,
                            'created_time' => date('Y-m-d h:i:s'),
                            'created_by_ip' => Request::ip(),

                        ];

                        DB::table('acc_transaction')->insert($due_new_data);

                    }
                }
            }


            //if have discount
            if ($receive->discount_id > 0) {

                if ($receive->discount > 0) {

                    $discount_update_data = [
                        'amount' => $receive->discount,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->discount_id, 'union_id' => $receive->union_id])->update($discount_update_data);

                } else {

                    $discount_update_data = [
                        'is_active' => 0,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->discount_id, 'union_id' => $receive->union_id])->update($discount_update_data);


                }


            } else {

                if ($receive->discount > 0) {

                    //get discount account id
                    $discount_account_id = Global_model::get_account_id($receive->union_id, 24);

                    if ($discount_account_id < 0) {

                        return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];

                    } else {

                        $discount_new_data = [
                            'union_id' => $receive->union_id,
                            'fiscal_year_id' => $receive->fiscal_year_id,
                            'voucher' => $receive->voucher,
                            'sonod_no' => $receive->sonod_no,
                            'amount' => $receive->due,
                            'debit' => 28,
                            'credit' => $discount_account_id,
                            'type' => 19,

                            'created_by' => Auth::user()->id,
                            'created_time' => date('Y-m-d h:i:s'),
                            'created_by_ip' => Request::ip(),

                        ];

                        DB::table('acc_transaction')->insert($discount_new_data);

                    }
                }
            }

            //vat always update
            $vat_update_data = [
                'amount' => $receive->vat,
                'updated_by' => Auth::user()->id,
                'updated_time' => date('Y-m-d h:i:s'),
                'updated_by_ip' => Request::ip(),
            ];

            DB::table('acc_transaction')->where(['id' => $receive->vat_id, 'union_id' => $receive->union_id])->update($vat_update_data);


            //if have signbord
            if ($receive->signbord_id > 0) {

                if ($receive->signbord_vat > 0) {

                    $signbord_update_data = [
                        'amount' => $receive->signbord_vat,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->signbord_id, 'union_id' => $receive->union_id])->update($signbord_update_data);

                } else {

                    $signbord_update_data = [
                        'is_active' => 0,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->signbord_id, 'union_id' => $receive->union_id])->update($signbord_update_data);


                }


            } else {

                if ($receive->signbord_vat > 0) {

                    //get vat account id
                    $signbord_account_id = Global_model::get_account_id($receive->union_id, 21);

                    if ($signbord_account_id < 0) {

                        return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];

                    } else {

                        $signbord_new_data = [
                            'union_id' => $receive->union_id,
                            'fiscal_year_id' => $receive->fiscal_year_id,
                            'voucher' => $receive->voucher,
                            'sonod_no' => $receive->sonod_no,
                            'amount' => $receive->signbord_vat,
                            'debit' => $signbord_account_id,
                            'credit' => 28,
                            'type' => 19,

                            'created_by' => Auth::user()->id,
                            'created_time' => date('Y-m-d h:i:s'),
                            'created_by_ip' => Request::ip(),

                        ];

                        DB::table('acc_transaction')->insert($signbord_new_data);

                    }
                }
            }

            //if have pesha_vat
            if ($receive->pesha_vat_id > 0) {

                if ($receive->pesha_vat > 0) {

                    $pesha_vat_update_data = [
                        'amount' => $receive->pesha_vat,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->pesha_vat_id, 'union_id' => $receive->union_id])->update($pesha_vat_update_data);

                } else {

                    $pesha_vat_update_data = [
                        'is_active' => 0,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->pesha_vat_id, 'union_id' => $receive->union_id])->update($pesha_vat_update_data);


                }


            } else {

                if ($receive->pesha_vat > 0) {

                    //get pesha_vat account id
                    $pesha_vat_account_id = Global_model::get_account_id($receive->union_id, 28);

                    if ($pesha_vat_account_id < 0) {

                        return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];

                    } else {

                        $pesha_vat_new_data = [
                            'union_id' => $receive->union_id,
                            'fiscal_year_id' => $receive->fiscal_year_id,
                            'voucher' => $receive->voucher,
                            'sonod_no' => $receive->sonod_no,
                            'amount' => $receive->pesha_vat,
                            'debit' => $pesha_vat_account_id,
                            'credit' => 28,
                            'type' => 19,

                            'created_by' => Auth::user()->id,
                            'created_time' => date('Y-m-d h:i:s'),
                            'created_by_ip' => Request::ip(),

                        ];

                        DB::table('acc_transaction')->insert($pesha_vat_new_data);

                    }
                }
            }

            //if have sarcharge
            if ($receive->sarcharge_id > 0) {

                if ($receive->sarcharge > 0) {

                    $sarcharge_update_data = [
                        'amount' => $receive->sarcharge,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->sarcharge_id, 'union_id' => $receive->union_id])->update($sarcharge_update_data);

                } else {

                    $sarcharge_update_data = [
                        'is_active' => 0,
                        'updated_by' => Auth::user()->id,
                        'updated_time' => date('Y-m-d h:i:s'),
                        'updated_by_ip' => Request::ip(),
                    ];

                    DB::table('acc_transaction')->where(['id' => $receive->sarcharge_id, 'union_id' => $receive->union_id])->update($sarcharge_update_data);


                }


            } else {

                if ($receive->sarcharge > 0) {

                    //get sarcharge account id
                    $sarcharge_account_id = Global_model::get_account_id($receive->union_id, 22);

                    if ($sarcharge_account_id < 0) {

                        return ["status" => "error", "message" => "লাইসেন্সটি জেনারেট করা সম্ভব হচ্ছে না। সাপোর্ট এ যোগাযোগ করুন"];

                    } else {

                        $sarcharge_new_data = [
                            'union_id' => $receive->union_id,
                            'fiscal_year_id' => $receive->fiscal_year_id,
                            'voucher' => $receive->voucher,
                            'sonod_no' => $receive->sonod_no,
                            'amount' => $receive->pesha_vat,
                            'debit' => $sarcharge_account_id,
                            'credit' => 28,
                            'type' => 19,

                            'created_by' => Auth::user()->id,
                            'created_time' => date('Y-m-d h:i:s'),
                            'created_by_ip' => Request::ip(),

                        ];

                        DB::table('acc_transaction')->insert($sarcharge_new_data);

                    }
                }
            }

            //if all are good
            DB::commit();

            return ["status" => "success", "message" => "ট্রেড লাইসেন্স ফি আপডেট হয়েছে।"];

        } catch (\Exception $e) {

            DB::rollback();

            return ["status" => "error", "message" => "দুঃখিত ! ট্রেড লাইসেন্স ফি আপডেট হয়নি।"];
        }

    }

}
