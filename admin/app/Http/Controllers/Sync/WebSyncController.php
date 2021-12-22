<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use App\Models\Geocode\BdLocation;
use App\Models\Management\Allowance\Allowance;
use App\Models\Management\BusinessType;
use App\Models\Management\Employee\Employee;
use App\Models\Management\Info\Notice;
use App\Models\Management\Slider\Slide;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Support\Facades\DB;

class WebSyncController extends Controller
{

    // all table sync method
    public function syncWeb()
    {
        echo '<h1>Bd location</h1>';
        self::syncBdLocation();

        echo '<h1>Union Information</h1>';
        self::syncUnionInformation();

        echo '<h1>Fiscal Year</h1>';
        self::syncFiscalYear();

        echo '<h1>Business Type</h1>';
        self::syncBusinessType();

        echo '<h1>Slides</h1>';
        self::syncSlides();

        echo '<h1>Employess</h1>';
        self::syncEmployees();

        echo '<h1>Allowance</h1>';
        self::syncAllowance();

        echo '<h1>Notice</h1>';
        self::syncNotice();
        echo '<h1>Designation</h1>';
        self::syncDesignation();
    }

    public static function syncBdLocation()
    {
        echo "\nsyncing bd location\n";
        $url = env('WEB_URL') . 'api/sync/bd-location';
        $form_data['data'] = json_encode(BdLocation::where('is_process_web', 0)->get());
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
        echo "\nTotal updated : " .count($modified). "\n";
        foreach ($modified ?? [] as $item) {
            BdLocation::where('id', $item)->update(['is_process_web' => 1]);
        }

        echo "end syncing bd location\n";
    }

    public static function syncUnionInformation()
    {
        echo "\nsyncing Union Information\n";
        $url = env('WEB_URL') . 'api/sync/union-information';
        $form_data['data'] = json_encode(UnionInformation::where('is_process_web', 0)->get());
        // dd($url,json_decode($form_data['data']));
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
            UnionInformation::where('id', $item)->update(['is_process_web' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";

        echo "End syncing Union Information\n";
    }

    public static function syncEmployees()
    {
        echo "\nsyncing Eemployees\n";
        $url = env('WEB_URL') . 'api/sync/employees';
        $form_data['data'] = json_encode(DB::table((new Employee)->getTable())->where('is_process_web', 0)->orWhereNotNull('deleted_at')->get());
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
            Employee::where('id', $item)->update(['is_process_web' => 1]);
        }

        echo "\nTotal updated : " .count($modified). "\n";
        // print_r($modified);
        echo "End syncing Eemployees\n";
    }

    public static function syncAllowance()
    {
        echo "\nsyncing Allowance\n";
        $url = env('WEB_URL') . 'api/sync/allowance';
        $form_data['allowance'] = json_encode(DB::table((new Allowance)->getTable())->where('is_process_web', 0)->get());
        // dd($form_data['allowance']);
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
            Allowance::where('id', $item)->update(['is_process_web' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Allowance\n";
    }


    // business_type,
    public static function syncBusinessType()
    {
        echo "\nsyncing Business Type\n";
        $url = env('WEB_URL') . 'api/sync/business-type';
        $form_data['data'] = json_encode(DB::table((new BusinessType)->getTable())->where('is_process', 0)->get());
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
        // dd($data);
        foreach ($modified ?? [] as $item) {
            BusinessType::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Business Type\n";
    }

    // fiscal_years,
    public static function syncFiscalYear()
    {
        echo "\nsyncing Fiscal Year\n";
        $url = env('WEB_URL') . 'api/sync/fiscal-year';
        $form_data['data'] = json_encode(DB::table((new FiscalYear)->getTable())->where('is_process', 0)->get());
        // dd($form_data['data'],$url);
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
            FiscalYear::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Fiscal Year\n";
    }

    // notices,
    public static function syncNotice()
    {
        echo "\nsyncing Notice\n";
        $url = env('WEB_URL') . 'api/sync/notice';
        $form_data['data'] = json_encode(DB::table((new Notice)->getTable())->where('is_process', 0)->get());
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
            Notice::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Notice\n";
    }

    // slides,
    public static function syncSlides()
    {

        echo "\nsyncing Slides\n";
        $url = env('WEB_URL') . 'api/sync/slides';

        $form_data['data'] = json_encode(DB::table((new Slide)->getTable())->where('is_process', 0)->get());
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
        // dd($modified);
        foreach ($modified ?? [] as $item) {
            Slide::where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Slides\n";
    }



    public static function syncDesignation(){
        echo "\nsyncing Designation\n";
        $url = env('WEB_URL') . 'api/sync/designation';
        $form_data['data'] = json_encode(DB::table('designation')->where('is_process', 0)->get());
        // dd(json_decode($form_data['data']));
        $client = new \GuzzleHttp\Client();

        try {

            $r = $client->request('POST',$url,[
                'form_params' => $form_data
            ]);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            throw $e;
        }

        $modified = json_decode($r->getBody()->getContents());
//         dd($modified);
        foreach ($modified ?? [] as $item) {
            DB::table('designation')->where('id', $item)->update(['is_process' => 1]);
        }
        echo "\nTotal updated : " .count($modified). "\n";
        echo "End syncing Designation\n";
    }

}
