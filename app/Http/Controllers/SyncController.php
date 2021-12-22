<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\BusinessType;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\FiscalYear;
use App\Models\Geocode\BdLocation;
use App\Models\Notice;
use App\Models\Slide;
use App\Models\UnionInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    function __construct()
    {
        if(env('APP_ENV') == 'local')
        {
            DB::disconnect('mysql');
            Config::set('database.connections.mysql.database', env('WEB_DB'));
            DB::reconnect();
        }
    }

    //bd_locations
    public function syncBdLoaction(Request $r)
    {

        // bd location array
        $data = json_decode($r->data);
        // return response()->json($data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                BdLocation::updateOrCreate([
                    'id' => $item->id
                ], [
                    'parent_id' => $item->parent_id,
                    'en_name' => $item->en_name,
                    'bn_name' => $item->bn_name,
                    'post_code' => $item->post_code,
                    'web' => $item->web,
                    'type' => $item->type
                ]);

            } catch (Exception $e) {
                return response()->json($e->getMessage(),500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncUnionInformation(Request $r)
    {
        // return $r->data;
        // return config('database.connections.mysql.database');
        $data = json_decode($r->data);

        // return response()->json($data[0]->union_code);
        $modified = [];
        foreach ($data ?? [] as $item) {

            try {

                UnionInformation::updateOrCreate([
                    'district_id' => $item->district_id,
                    'upazila_id' => $item->upazila_id,
                    'union_code' => $item->union_code,

                ], [
                    'postal_id' => $item->postal_id,
                    'en_name' => $item->en_name,
                    'bn_name' => $item->bn_name,
                    'postal_code' => $item->postal_code,
                    'village_bn' => $item->village_bn,
                    'village_en' => $item->village_en,
                    'email' => $item->email,
                    'mobile' => $item->mobile,
                    'telephone' => $item->telephone,
                    'sub_domain' => $item->sub_domain,
                    'main_logo' => $item->main_logo,
                    'brand_logo' => $item->brand_logo,
                    'jolchap' => $item->jolchap,
                    'is_header_active' => $item->is_header_active,
                    'status' => $item->status,
                    'about' => $item->about,
                    'google_map' => $item->google_map,
                    'deleted_at' => $item->deleted_at,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip,
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(),500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncEmployees(Request $r)
    {
        $data = json_decode($r->data);

        // return response()->json($data);
        $modified = [];

        foreach ($data ?? [] as $item) {

            Employee::updateOrCreate([
                'employee_id' => $item->employee_id,
                'union_id' => $item->union_id,
            ], [

                'device_id' => $item->device_id,
                'nid' => $item->nid,
                'email' => $item->email,
                'name' => $item->name,
                'designation_id' => $item->designation_id,
                'gender' => $item->gender,
                'marital_status' => $item->marital_status,
                'date_of_birth' => $item->date_of_birth,
                'qualification' => $item->qualification,
                'join_date' => $item->join_date,
                'photo' => $item->photo,
                'election_area' => $item->election_area,
                'mobile' => $item->mobile,
                'address' => $item->address,
                'district_id' => $item->district_id,
                'upazila_id' => $item->upazila_id,
                'postal_id' => $item->postal_id,
                'sequence' => $item->sequence,
                'messages' => $item->messages,
                'is_active' => $item->is_active,
                'status' => $item->status,

                'created_by' => $item->created_by,
                'updated_by' => $item->updated_by,
                'created_by_ip' => $item->created_by_ip,
                'updated_by_ip' => $item->updated_by_ip,
                'deleted_at' => $item->deleted_at,
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncAllowance(Request $r)
    {
        $data = json_decode($r->allowance);
        // return response()->json($data);

        $modified = [];

        foreach ($data ?? [] as $item) {

            try {
                Allowance::updateOrCreate([
                    'union_id' => $item->union_id,
                    'allowance_id' => $item->allowance_id,
                ], [
                    'name' => $item->name,
                    'nid' => $item->nid,
                    'photo' => $item->photo,
                    'father_name' => $item->father_name,
                    'date_of_birth' => $item->date_of_birth,
                    'mobile' => $item->mobile,
                    'village' => $item->village,
                    'ward_no' => $item->ward_no,
                    'bio' => $item->bio,
                    'type' => $item->type,
                    'is_active' => $item->is_active,
                    'amount_of_allowance' => $item->amount_of_allowance,
                    'sector_no' => $item->sector_no,
                    'health_condition' => $item->health_condition,
                    'economical_condition' => $item->economical_condition,
                    'educational_qualification' => $item->educational_qualification,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip,
                    'deleted_at' => $item->deleted_at,
                    'created_at' => $item->created_at,
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(),500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // bd_locations,
    // union_information,
    // allowances,
    // employees,

    // business_type,

    public function syncBusinessType(Request $r)
    {
        $data = json_decode($r->data);
        // return response()->json($data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                BusinessType::updateOrCreate([
                    'id' => $item->id
                ],[
                    'union_id' => $item->union_id,
                    'name_bn' => $item->name_bn,
                    'name_en' => $item->name_en,
                    'is_active' => $item->is_active,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_time' => $item->created_time,
                    'updated_time' => $item->updated_time,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // fiscal_years,

    public function syncFiscalYear(Request $r)
    {
        $data = json_decode($r->data);
        // return response()->json(['data']);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                FiscalYear::updateOrCreate([
                    'id' => $item->id
                ], [
                    'union_id' =>$item->union_id,
                    'name' =>$item->name,
                    'is_current' =>$item->is_current,
                    'is_active' =>$item->is_active,
                    'expire_date' =>$item->expire_date,
                    'created_by' =>$item->created_by,
                    'updated_by' =>$item->updated_by,
                    'created_time' =>$item->created_time,
                    'updated_time' =>$item->updated_time,
                    'created_by_ip' =>$item->created_by_ip,
                    'updated_by_ip' =>$item->updated_by_ip
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // notices,
    public function syncNotice(Request $r)
    {
        $data = json_decode($r->data);
        // return response()->json($data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                Notice::updateOrCreate([
                    'id' => $item->id
                ], [
                    'title' => $item->title,
                    'union_id' => $item->union_id,
                    'details' => $item->details,
                    'document' => $item->document,
                    'type' => $item->type,
                    'deleted_at' => $item->deleted_at,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // slides,
    public function syncSlides(Request $r)
    {
        $data = json_decode($r->data);
        // return response()->json($data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                Slide::updateOrCreate([
                    'id' => $item->id
                ], [
                    'title' => $item->title,
                    'caption' => $item->caption,
                    'photo' => $item->photo,
                    'sequence' => $item->sequence,
                    'union_id' => $item->union_id,
                    'status' => $item->status,
                    'deleted_at' => $item->deleted_at,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // designation
    public function syncDesignation(Request $r)
    {
        $data = json_decode($r->data);
        // return response()->json($r->all());

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                Designation::updateOrCreate([
                    'id' => $item->id
                ], [
                    'name' => $item->name,
                    'is_system' => $item->is_system,
                    'is_active' => $item->is_active,
                    'created_by' => $item->created_by,
                    'created_at' => $item->created_at,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by' => $item->updated_by,
                    'updated_at' => $item->updated_at,
                    'updated_by_ip' => $item->updated_by_ip
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }
}
