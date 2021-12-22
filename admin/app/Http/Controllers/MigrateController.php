<?php

namespace App\Http\Controllers;

use App\Models\BillGenerate;
use App\Models\Global_model;
use App\Models\IdGenerate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MigrateController extends Controller
{


    public function migrate_data($type = 1, $invoice_type = 4)
    {
        $transaction_data = DB::table('acc_transaction as tns')
            ->select(DB::raw("tns.*,SUM(tns.amount) as total_amount"))
            ->where(['type' => $type, 'is_process' => 0])
            ->groupBy('sonod_no')
            ->limit(50)
            ->get();

        // dd($transaction_data);

        if (count($transaction_data) <= 0) {
            die("No data remaining");
        }


        $invoice_data = [];
        $transaction_update_data = [];
        $invoice_id = BillGenerate::generateID();
        $union_id = Auth::user()->union_id;
        $current_fiscal_year_id = Global_model::current_fiscal_year();

        $voucher_no = IdGenerate::voucher($union_id, $current_fiscal_year_id, $invoice_type);

        $created_by = Auth::user()->id;

//        echo "<pre>";
//        echo count($transaction_data);
//        exit();

        foreach ($transaction_data as $item) {
            $invoice_data[] = [
                'union_id' => $union_id,
                'invoice_id' => $invoice_id,
                'voucher_no' => $voucher_no,
                'sonod_no' => $item->sonod_no,
                'fiscal_year_id' => $item->fiscal_year_id,
                'amount' => $item->total_amount,
                'is_paid' => 1,
                'payment_date' => $item->created_time,
                'type' => $invoice_type,
                'created_by' => $created_by,
                'created_at' => Carbon::now(),
                'created_by_ip' => \request()->ip()
            ];

            $transaction_update_data[] = [
                'sonod_no' => $item->sonod_no,
                'voucher_no' => $voucher_no,
                'is_process' => 1
            ];

            $invoice_id++;
            $voucher_no++;

        }



        DB::beginTransaction();

        try {
            DB::table('acc_invoice')->insert($invoice_data);

            foreach ($transaction_update_data as $item) {
                DB::table('acc_transaction')
                     ->where('sonod_no', $item['sonod_no'])
                     ->update([ 'voucher' => $item['voucher_no'], 'is_process' => $item['is_process']]);
            }

            DB::commit();
            // all good
            die("Migrate successfully done");

        } catch (\Exception $e) {

            DB::rollback();

            die("error :" . $e->getMessage());
        }

    }


}
