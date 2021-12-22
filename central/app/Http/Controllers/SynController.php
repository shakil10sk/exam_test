<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AssetRegister;
use App\Models\Attendance;
use App\Models\BdLocation;
use App\Models\Committee\ComMember;
use App\Models\Committee\Committee;
use App\Models\Committee\CommitteeType;
use App\Models\Employee;
use App\Models\Letter;
use App\Models\Project;
use App\Models\PublicService;
use App\Models\Report;
use App\Models\UnionInformation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SynController extends Controller
{

    function __construct()
    {
        if(env('APP_ENV') == 'local')
        {
            DB::disconnect('mysql');
            Config::set('database.connections.mysql.database', env('CENTRAL_DB'));
            DB::reconnect();
        }
    }

    public function syncBdLoaction(Request $r)
    {
        // return config('database.connections.mysql.database');
        // bd location array
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

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

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncUnionInformation(Request $r)
    {
        // return $r->data;
        $data = json_decode($r->data);

        // return response()->json($data[0]->union_code);
        $modified = [];
        foreach ($data ?? [] as $item) {

            try {

                UnionInformation::updateOrCreate([
                    'union_code' => $item->union_code,
                ], [
                    'district_id'=> $item->district_id, 
                    'upazila_id'=> $item->upazila_id,
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
                    'created_at' => $item->created_at,
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }


            $modified[] = $item->id;
        }

        return response()->json($modified);
    }


    public function syncAllowance(Request $r)
    {
        $allowance = json_decode($r->allowance);
        // return response()->json($allowance[0]);

        $data['modified'] = [];
        // $data['id'] = [];
        foreach ($allowance ?? [] as $item) {

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

            $data['modified'][] = $item->id;
        }

        // return response()->json([$modified,$ids]);
        return response()->json($data);
    }

    public function syncEmployees(Request $r)
    {
        $data = json_decode($r->data);

        // return response()->json($data);
        $modified = [];


        foreach ($data ?? [] as $item) {
            try {
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
                    'created_at' => $item->created_at,
                ]);

                $modified[] = $item->id;

            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }



        return response()->json($modified);
    }

    public function syncProjects(Request $r)
    {
        $data = json_decode($r->data);

        // return response()->json($data);
        $modified = [];

        foreach ($data ?? [] as $item) {

            try {
                Project::updateOrCreate([
                    'id' => $item->id,
                ], [
                    'union_id' => $item->union_id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'pre_photo' => $item->pre_photo,
                    'final_photo' => $item->final_photo,
                    'file' => $item->file,
                    'descrip' => $item->descrip,
                    'status' => $item->status,
                    'is_active' => $item->is_active,
                    'entry_date' => $item->entry_date,
                    'deleted_at' => $item->deleted_at,
                    'created_by' => $item->created_by,
                    'created_by_ip' => $item->created_by_ip,
                    'created_time' => $item->created_time,
                    'updated_time' => $item->updated_time,
                    'updated_by' => $item->updated_by,
                    'updated_by_ip' => $item->updated_by_ip,
                    'created_at' => $item->created_at,
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncReport(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            Report::updateOrCreate([
                'id' => $item->id
            ], [
                'union_id' => $item->union_id,
                'title' => $item->title,
                'file' => $item->file,
                'type' => $item->type,
                'is_active' => $item->is_active,
                'created_time' => $item->created_time,
                'created_by' => $item->created_by,
                'created_by_ip' => $item->created_by_ip,
                'updated_time' => $item->updated_time,
                'updated_by' => $item->updated_by,
                'updated_by_ip' => $item->updated_by_ip,
                'created_at' => $item->created_at
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncCommittee(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            Committee::updateOrCreate([
                'id' => $item->id
            ], [
                'union_id' => $item->union_id,
                'committee_name' => $item->committee_name,
                'committee_step' => $item->committee_step,
                'ward_no' => $item->ward_no,
                'is_active' => $item->is_active,
                'created_time' => $item->created_time,
                'created_by' => $item->created_by,
                'created_by_ip' => $item->created_by_ip,
                'updated_time' => $item->updated_time,
                'updated_by' => $item->updated_by,
                'updated_by_ip' => $item->updated_by_ip
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public static function syncCommitteeType(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            CommitteeType::updateOrCreate([
                'id' => $item->id
            ], [
                'union_id' => $item->union_id,
                'name' => $item->name,
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public static function syncComMember(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            ComMember::updateOrCreate([
                'id' => $item->id
            ], [
                'union_id' => $item->union_id,
                'committee_id' => $item->committee_id,
                'name' => $item->name,
                'designation' => $item->designation,
                'mobile' => $item->mobile,
                'email' => $item->email,
                'nid' => $item->nid,
                'social_status' => $item->social_status,
                'address' => $item->address,
                'is_active' => $item->is_active,
                'created_time' => $item->created_time,
                'created_by' => $item->created_by,
                'created_by_ip' => $item->created_by_ip,
                'updated_by' => $item->updated_by,
                'updated_by_ip' => $item->updated_by_ip
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncLetter(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            Letter::updateOrCreate([
                'id' => $item->id
            ], [
                'union_id' => $item->union_id,
                'accept_send_date' => $item->accept_send_date,
                'acc_send_no_date' => $item->acc_send_no_date,
                'office' => $item->office,
                'description' => $item->description,
                'repley_no_date' => $item->repley_no_date,
                'file' => $item->file,
                'is_active' => $item->is_active,
                'comment' => $item->comment,
                'type' => $item->type,
                'created_by' => $item->created_by,
                'created_time' => $item->created_time,
                'updated_time' => $item->updated_time,
                'updated_by' => $item->updated_by
            ]);

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncAssetRegister(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                AssetRegister::updateOrCreate([
                    'id' => $item->id
                ], [
                    'union_id' => $item->union_id,
                    'asset_name_point' => $item->asset_name_point,
                    'create_buy_date' => $item->create_buy_date,
                    'rate' => $item->rate,
                    'stock_source' => $item->stock_source,
                    'last_care_date' => $item->last_care_date,
                    'expence_amount' => $item->expence_amount,
                    'care_expense_source' => $item->care_expense_source,
                    'next_care_date' => $item->next_care_date,
                    'file' => $item->file,
                    'comment' => $item->comment,
                    'type' => $item->type,
                    'is_active' => $item->is_active,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip,
                    'created_time' => $item->created_time,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(),500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    public function syncAttendance(Request $r)
    {
        $data = json_decode($r->data);

        $modified = [];
        foreach ($data ?? [] as $item) {

            try {
                Attendance::updateOrCreate([
                    'id' => $item->id
                ], [
                    'union_id' => $item->union_id,
                    'record_id' => $item->record_id,
                    'attendance_date' => $item->attendance_date,
                    'login_time' => $item->login_time,
                    'logout_time' => $item->logout_time,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by,
                    'created_by_ip' => $item->created_by_ip,
                    'updated_by_ip' => $item->updated_by_ip,
                    'created_time' => $item->created_time,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by
                ]);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }

            $modified[] = $item->id;
        }

        return response()->json($modified);
    }

    // --------------- public service sync---------------
    public function syncPublicServiceCertificate(Request $r)
    {

        $data = json_decode($r->data);

        foreach ($data as $item) {

            $update_data = [];
            switch ($item->type) {
                case 1:
                    $update_data['nagorik_certi'] = $item->total;
                    break;
                case 2:
                    $update_data['death_certi'] = $item->total;
                    break;
                case 3:
                    $update_data['unmarried_certi'] = $item->total;
                    break;
                case 4:
                    $update_data['punobibaho_certi'] = $item->total;
                    break;
                case 5:
                    $update_data['same_name_certi'] = $item->total;
                    break;
                case 6:
                    $update_data['sonaton_certi'] = $item->total;
                    break;
                case 7:
                    $update_data['prottyon_certi'] = $item->total;
                    break;
                case 8:
                    $update_data['nodibanga_certi'] = $item->total;
                    break;
                case 9:
                    $update_data['character_certi'] = $item->total;
                    break;
                case 10:
                    $update_data['vumihin_certi'] = $item->total;
                    break;
                case 11:
                    $update_data['yearly_income_certi'] = $item->total;
                    break;
                case 12:
                    $update_data['protibondi_certi'] = $item->total;
                    break;
                case 13:
                    $update_data['onumoti_certi'] = $item->total;
                    break;
                case 14:
                    $update_data['voter_transper_certi'] = $item->total;
                    break;
                case 15:
                    $update_data['onapotti_certi'] = $item->total;
                    break;
                case 16:
                    $update_data['road_cutting_certi'] = $item->total;
                    break;
                case 17:
                    $update_data['warish_certi'] = $item->total;
                    break;
                case 18:
                    $update_data['family_certi'] = $item->total;
                    break;
                case 19:
                    $update_data['trade_certi'] = $item->total;
                    break;
                case 20:
                    $update_data['married_certi'] = $item->total;
                    break;
                case 100:
                    $update_data['total_amount'] = $item->amount ?? 0;
                    break;
            }

            try {
                PublicService::updateOrCreate([
                    'union_id'  => $item->union_id,
                    'created_at'  => $item->created_at,
                ], $update_data);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }

        return response()->json('ok');
    }

    public function syncPublicServiceApplication(Request $r)
    {

        $data = json_decode($r->data);

        foreach ($data as $item) {

            $update_data = [];
            switch ($item->type) {
                case 1:
                    $update_data['nagorik_app'] = $item->total;
                    break;
                case 2:
                    $update_data['death_app'] = $item->total;
                    break;
                case 3:
                    $update_data['unmarried_app'] = $item->total;
                    break;
                case 4:
                    $update_data['punobibaho_app'] = $item->total;
                    break;
                case 5:
                    $update_data['same_name_app'] = $item->total;
                    break;
                case 6:
                    $update_data['sonaton_app'] = $item->total;
                    break;
                case 7:
                    $update_data['prottyon_app'] = $item->total;
                    break;
                case 8:
                    $update_data['nodibanga_app'] = $item->total;
                    break;
                case 9:
                    $update_data['character_app'] = $item->total;
                    break;
                case 10:
                    $update_data['vumihin_app'] = $item->total;
                    break;
                case 11:
                    $update_data['yearly_income_app'] = $item->total;
                    break;
                case 12:
                    $update_data['protibondi_app'] = $item->total;
                    break;
                case 13:
                    $update_data['onumoti_app'] = $item->total;
                    break;
                case 14:
                    $update_data['voter_transper_app'] = $item->total;
                    break;
                case 15:
                    $update_data['onapotti_app'] = $item->total;
                    break;
                case 16:
                    $update_data['road_cutting_app'] = $item->total;
                    break;
                case 17:
                    $update_data['warish_app'] = $item->total;
                    break;
                case 18:
                    $update_data['family_app'] = $item->total;
                    break;
                case 19:
                    $update_data['trade_app'] = $item->total;
                    break;
                case 20:
                    $update_data['married_app'] = $item->total;
                    break;
            }


            try {
                PublicService::updateOrCreate([
                    'union_id'  => $item->union_id,
                    'created_at'  => $item->created_at,
                ], $update_data);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }

        return response()->json('ok');
    }
}
