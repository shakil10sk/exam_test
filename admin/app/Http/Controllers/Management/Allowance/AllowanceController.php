<?php

namespace App\Http\Controllers\Management\Allowance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Management\Allowance\AllowanceRequest;
use App\Http\Requests\Management\Allowance\AllowanceUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\Management\Allowance\Allowance;
use App\Models\Management\Allowance\AllowanceLog;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Support\Facades\DB; 
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AllowanceController extends Controller
{
    //view allowance add form
    public function viewAllowanceAddForm()
    {
        return view('management.allowance.add_allowance');
    }

    //store allowance
    public function store(AllowanceRequest $request)
    {
        $request['allowance_id']    = $this->genId(Auth::User()->union_id);
        $request['union_id']        = Auth::user()->union_id;
        $request['created_by']      = Auth::user()->employee_id;
        $request['created_by_ip']   = $request->ip();

        $res = Allowance::store($request);

        if ($res){
            Alert::toast('ভাতার তালিকা সফলভাবে যোগ করা হয়েছে!','success');
            return redirect(route('show-allowance', ['type' => $request->type]));
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //show allowance
    public function show($type)
    {
        return view('management.allowance.view_allowance', ['type' => $type]);
    }

    //get allowance by type for datatable
    public function getAllowance(Request $request)
    {
        $searchContent = ($request['search']['value'] != '') ? $request['search']['value'] : false;


        $fromDate = (isset($request->fromDate)) ? $request->fromDate : date('Y-m-d');

        $toDate = (isset($request->toDate)) ? $request->toDate : date('Y-m-d');

        $data = Allowance::getAllowance($request, $searchContent);

        $count = DB::select("SELECT FOUND_ROWS() as `row_count`")[0]->row_count;

        $data['recordsTotal']    = $count;
        $data['recordsFiltered'] = $count;


        $data['draw'] = $request->draw;

        return json_encode($data);
        
    }

    //show allowance edit page
    public function showAllowanceEditForm($id)
    {
        $data = Allowance::getAllowanceById($id);

        return view('management.allowance.edit_allowance', ['data' => $data]);
    }

    //get allowance info for vata payment
    public function getAllowanceInfo(Request $request)
    {
        $data = Allowance::getAllowanceById($request->id);
        return $data;
    }

    //store vata payment
    public function storeVata(Request $request)
    {
        $request['union_id']        = Auth::user()->union_id;
        $request['created_by']      = Auth::user()->employee_id;
        $request['created_by_ip']   = $request->ip();

        $res = AllowanceLog::store($request);
        if ($res){
            Alert::toast('ভাতার সফলভাবে প্রদান করা হয়েছে!','success');
            return redirect(route('show-allowance', ['type' => $request->type]));
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //show allowance profile page
    public function showAllowanceProfile($type,$id)
    {
        $profile = Allowance::getAllowanceWithUnionInfo($type,$id);
        $allowance = AllowanceLog::getAllowance($profile[0]->allowance_id, $type);

        return view('management.allowance.profile', ['profile' => $profile, 'allowance' => $allowance, 'type' => $type]);
    }

    //print vata card
    public function stramVataCard($type, $id)
    {
        $profile = Allowance::getAllowanceWithUnionInfo($type,$id);
        $allowance = AllowanceLog::getAllowance($profile[0]->allowance_id, $type);

        $pdf = PDF::loadView('management.allowance.vata_card', ['profile' => $profile, 'allowance' => $allowance, 'type' => $type]);
        return $pdf->stream('vata_card.pdf');
    }

    //print all vata card by type
    public function stramAllVataCard($type)
    {
        $data = Allowance::getAllAllowanceWithUnionInfo($type);

        $pdf = PDF::loadView('management.allowance.all_vata_card', ['data' => $data, 'type' => $type]);
        return $pdf->stream('all_vata_card.pdf');
    }

    //update allowance info
    public function updateAllowance(AllowanceUpdateRequest $request)
    {
        $request['updated_by'] = Auth::user()->employee_id;
        $request['updated_by_ip'] = $request->ip();
        $res = Allowance::updateAllowance($request);
        if ($res){
            Alert::toast('ভাতার তালিকা সফলভাবে আপডেট করা হয়েছে!','success');
            return redirect(route('show-allowance', ['type' => $request->type]));
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //delete allowance
    public function deleteAllowance(Request $request)
    {
        $res = Allowance::deleteAllowance($request->id);
        if ($res){
            return redirect()->back();
        }else{
            Alert::toast('কিছু ভুল হয়েছে!','error');
            return redirect()->back();
        }
    }

    //Generate allowance Id
    private function genId($unionId)
    {
        $employee = count(Allowance::where('union_id', $unionId)->whereNull('deleted_at')->get());
        $unionId = UnionInformation::where('union_code', $unionId)->whereNull('deleted_at')->first()->id;
        $uidLen = strlen($unionId);

        if ($employee < 1){
            $id = '001';
            $idLen = strlen($id);
            $id = $this->unionCOdeGen($id, $idLen, $unionId, $uidLen);
        }else{
            $id = $employee+1;
            $idLen = strlen($id);
            $id = $this->unionCOdeGen($id, $idLen, $unionId, $uidLen);
        }

        return $id;
    }

    //union codeGen
    private function unionCOdeGen($id, $idLen, $unionId, $uidLen)
    {
        if ($uidLen == 1){
            $uid = '000'.$unionId;
        }elseif($uidLen == 2){
            $uid = '00'.$unionId;
        }elseif($uidLen == 3){
            $uid = '0'.$unionId;
        }
        if ($idLen == 1){
            $id = '00'.$id;
        }elseif($idLen == 2){
            $id = '0'.$id;
        }
        
        $id = date("y").$uid.$id;
        return $id;
    }
}
