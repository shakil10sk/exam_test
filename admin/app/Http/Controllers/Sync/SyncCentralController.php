<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Certificate;
use App\Models\Management\Project;
use App\Models\Geocode\BdLocation;
use App\Models\Management\Allowance\Allowance;
use App\Models\Management\Committee\ComMember;
use App\Models\Management\Committee\Committee;
use App\Models\Management\Committee\CommitteeType;
use App\Models\Management\Employee\Employee;
use App\Models\Management\Letter;
use App\Models\Management\Union\UnionInformation;
use App\Models\Reports\AssetRegister;
use App\Models\Reports\Attendance;
use App\Models\Reports\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyncCentralController extends Controller
{
    // all table sync method
    public function syncCentralRegular()
    {
        echo '<h1>Public Services</h1>';
        self::syncPublicServices();

        echo '<h1>Attendance</h1>';
        self::syncAttendance();
    }

    public function syncCentral()
    {
        echo '<h1>Bd Location </h1>';
        self::syncBdLocation();
        echo '<h1>Union Information</h1>';
        self::syncUnionInformation();
        echo '<h1>Employees</h1>';
        self::synEmployees();
        echo '<h1>Projects</h1>';
        self::syncProjects();
        echo '<h1>Allowance</h1>';
        self::syncAllowance();
        echo '<h1>Report</h1>';
        self::syncReport();
        
        echo '<h1>Committee</h1>';
        self::syncCommittee();
        echo '<h1>Commiittee Type</h1>';
        self::syncCommiitteeType();
        echo '<h1>Com Member</h1>';
        self::syncComMember();
        
        echo '<h1>Letter</h1>';
        self::syncLetter();

        echo '<h1>Asset Register</h1>';
        self::syncAssetRegister();
        
    }

    // -------------- full table sync zone ---------------------

    public static function syncBdLocation()
    {

        echo "\nsyncing bd location\n";
        $url = env('CENTRAL_URL') . 'api/sync/bd-location';
        $form_data['data'] = json_encode(BdLocation::where('is_process', 0)->get());
        // dd($form_data['data']);
        // dd($url);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // dd($e);
            throw $e;
        }

        // dd($r->getBody()->getContents());
        $modified = json_decode($r->getBody()->getContents());

        foreach ($modified ?? [] as $item) {
            BdLocation::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "end syncing bd location\n";
    }

    public static function synEmployees()
    {
        echo "\nsyncing Eemployees\n";
        $url = env('CENTRAL_URL') . 'api/sync/employees';
        $form_data['data'] = json_encode(Employee::where('is_process', 0)->get());
        // dd($form_data['data']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        // dd($r->getBody()->getContents());
        $modified = json_decode($r->getBody()->getContents());

        foreach ($modified ?? [] as $item) {
            Employee::where('id', $item)->update(['is_process' => 1]);
        }
        // print_r($modified);
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Eemployees\n";
    }

    public static function syncProjects()
    {
        echo "\nsyncing Project\n";
        $url = env('CENTRAL_URL') . 'api/sync/projects';
        $form_data['data'] = json_encode(Project::where('is_process', 0)->get());
        // dd($form_data['data']);

        $client = new \GuzzleHttp\Client();
        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        // dd($r->getBody()->getContents());
        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Project::where('id', $item)->update(['is_process' => 1]);
        }
        // print_r($modified);
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Project\n";
    }

    public static function syncAllowance()
    {
        echo "\nsyncing Allowance\n";
        $url = env('CENTRAL_URL') . 'api/sync/allowance';
        $form_data['allowance'] = json_encode(Allowance::where('is_process', 0)->get());
        // dd($form_data['allowance']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }
        // dd($r->getBody()->getContents());
        $data = json_decode($r->getBody()->getContents());
        // dd($data);
        foreach ($data->modified ?? [] as $item) {
            Allowance::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($data->modified). "\n";
        echo "End syncing Allowance\n";
    }

    public static function syncUnionInformation()
    {
        echo "\nsyncing Union Information\n";
        $url = env('CENTRAL_URL') . 'api/sync/union-information';
        $form_data['data'] = json_encode(UnionInformation::where('is_process', 0)->get());
        // dd(json_decode($form_data['data']));
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        if(is_array($modified))
        {
            foreach ($modified ?? [] as $item) {
                UnionInformation::where('id', $item)->update(['is_process' => 1]);
            }
        }
        else
        {
            dd($modified);
        }
        
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Union Information\n";
    }

    public static function syncReport()
    {
        echo "\nsyncing Report\n";

        $url = env('CENTRAL_URL') . 'api/sync/report';
        $form_data['data'] = json_encode(Reports::where('is_process', 0)->get());

        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Reports::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Report\n";
    }

    public static function syncCommittee()
    {
        echo "\nsyncing Committee\n";

        $url = env('CENTRAL_URL') . 'api/sync/committee';
        $form_data['data'] = json_encode(Committee::where('is_process', 0)->get());

        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Committee::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Committee\n";
    }

    public static function syncCommiitteeType()
    {
        echo "\nsyncing Committee Type\n";

        $url = env('CENTRAL_URL') . 'api/sync/committee-type';
        $form_data['data'] = json_encode(CommitteeType::where('is_process', 0)->get());

        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            CommitteeType::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Committee Type\n";
    }

    public static function syncComMember()
    {
        echo "\nsyncing Committee Member\n";

        $url = env('CENTRAL_URL') . 'api/sync/committee-member';
        $form_data['data'] = json_encode(ComMember::where('is_process', 0)->get());
        // dd($form_data['data']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            ComMember::whereId($item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Committee Member\n";
    }

    public static function syncLetter()
    {
        echo "\nsyncing Letter\n";

        $url = env('CENTRAL_URL') . 'api/sync/letter';
        $form_data['data'] = json_encode(Letter::where('is_process', 0)->get());
        // dd($form_data['data']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Letter::whereId($item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Letter\n";
    }
    
    public static function syncAssetRegister()
    {
        echo "\nsyncing Asset Register\n";

        $url = env('CENTRAL_URL') . 'api/sync/asset-register';
        $form_data['data'] = json_encode(AssetRegister::where('is_process', 0)->get());
        // dd($form_data['data']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            AssetRegister::whereId($item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Asset Register\n";
    }

    public static function syncAttendance()
    {
        echo "\nsyncing Attendance\n";

        $url = env('CENTRAL_URL') . 'api/sync/attendance';
        $form_data['data'] = json_encode(Attendance::where('is_process', 0)->get());
        // dd($form_data['data']);
        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Attendance::whereId($item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Attendance\n";
    }



    // ---------------- processed table data sync zone --------------

    public static function syncPublicServices()
    {
        echo "\n<h3> syncing Public Services</h3>\n";

        // ============================== certificate sync 
        echo "<h4>-- syncing Certificate Information</h4>\n";
        $certificate = self::getCertificateData();

        echo "\nTotal updated : " .count($certificate). "\n";
        // dd(json_encode($certificate));

        $url = env('CENTRAL_URL') . 'api/sync/public-service/certificate';
        $form_data['data'] = json_encode($certificate);

        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }
        // dd($r->getBody()->getContents());
        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        if($modified == "ok")
        {
            Certificate::where('is_process',0)->update(['is_process'=>1]);
        }
        echo "<h4>-- end syncing Certificate Information</h4>\n";

        // ======================== application sync 

        echo "<h4>-- syncing Application Information</h4>\n";

        $application = self::getApplicationData();

        // dd($application);

        // dd(json_encode($application));

        $url = env('CENTRAL_URL') . 'api/sync/public-service/application';
        $form_data['data'] = json_encode($application);

        echo "\nTotal updated : " .count($application). "\n";

        $client = new \GuzzleHttp\Client();

        try {
            $r = $client->request('POST', $url, [
                'form_params' => $form_data,
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }
        // dd($r->getBody()->getContents());
        $modified = json_decode($r->getBody()->getContents());
        // dd($modified);
        if ($modified == "ok") {
            Application::where('is_process', 0)->update(['is_process' => 1]);
        }

        echo "<h4>-- end syncing Application Information</h4>\n";

        echo "<h3>End syncing Public Services</h3>\n";

    }

    public static function getCertificateData()
    {
        // certificate 
        // DB::enableQueryLog();

        $cetificate_count = Certificate::select(DB::raw('union_id, type, cast(created_time as date) as day, COUNT(*) AS total'))->where('is_process', 0)->where('status', '!=', 3)->groupBy('day', 'type', 'union_id')->get();

        // dd($cetificate);
        // dd(DB::getQueryLog());

        $data = [];
        // dd($cetificate);
        foreach ($cetificate_count as $item) {

            $data[] = (object) [
                'union_id' => $item->union_id,
                'created_at' => $item->day . ' 00:00:00',
                'type' =>  $item->type,
                'total' => $item->total
            ];
        }
        
        
        $certificate_amount = DB::table('certificate as cer')->select(DB::raw('cer.union_id, CAST( cer.created_time AS DATE) AS day , SUM(acc.amount) AS amount'))->where('cer.is_process', 0)->where('status', '!=', 3)->join('acc_transaction as acc', 'acc.sonod_no', 'cer.sonod_no')->groupBy('day', 'cer.union_id')->get();

        // dd($certificate_amount);

        foreach ($certificate_amount as $item) {

            $data[] = (object) [
                'union_id' => $item->union_id,
                'created_at' => $item->day . ' 00:00:00',
                'type' => 100,
                'amount' => $item->amount
            ];
        }

        // dd($data);

        return $data;
    }

    public static function getApplicationData()
    {
        $application = Application::select(DB::raw('union_id, type,cast(created_time AS DATE) day, count(*) as total'))->where('application.is_process',0)->join('union_information as u','u.union_code','union_id')->groupBy('type','day', 'union_id')->get();

        $data = [];
        foreach ($application as $item) {

            $data[] = (object) [
                'union_id' => $item->union_id,
                'created_at' => $item->day . ' 00:00:00',
                'type' =>  $item->type,
                'total' => $item->total
            ];
        }

        // dd($data);
        return $data;
    }

}
