<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class HoldingNamjariInfoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        $validation = [
            'name_en' => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'name_bn' => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'nid' => ['max:17', Rule::unique('citizen_information', 'nid')->whereNull('deleted_at'), 'nullable'],
            'birth_id' => ['max:17', Rule::unique('citizen_information', 'birth_id')->whereNull('deleted_at'), 'nullable'],
            'passport_no' => ['string', 'max:17', Rule::unique('citizen_information', 'passport_no')->whereNull('deleted_at'), 'nullable'],

            'birth_date' => ['required', 'date'],

            'father_name_en' => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'father_name_bn' => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],
            'mother_name_en' => ['string', 'max:100', 'regex:/^[a-zA-Z. ():]+$/', 'nullable', 'nullable'],
            'mother_name_bn' => ['required', 'string', 'max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],


            'gender' => ['required'],
            'marital_status' => ['required'],
            'resident'                     => ['required'],
            'religion'                     => ['required'],

            'present_village_en' => ['string', 'max:255', 'nullable'],
            'present_village_bn' => ['required', 'string', 'max:255'],
            'present_rbs_en' => ['string', 'max:255', 'nullable'],
            'present_rbs_bn' => ['nullable', 'string', 'max:255'],
            'present_holding_no' => ['string', 'nullable'],
            'present_ward_no' => ['required'],

            'present_district_id' => ['required'],
            'present_upazila_id' => ['required'],
            'present_postoffice_id' => ['required'],

            'permanent_village_en' => ['string', 'max:255', 'nullable'],
            'permanent_village_bn' => ['required', 'string', 'max:255'],
            'permanent_rbs_en' => ['string', 'max:255', 'nullable'],
            'permanent_rbs_bn' => ['nullable', 'string', 'max:255'],
            'permanent_holding_no' => ['string', 'nullable'],
            'permanent_ward_no' => ['required'],

            'permanent_district_id' => ['required'],
            'permanent_upazila_id' => ['required'],
            'permanent_postoffice_id' => ['required'],

            'mobile' => ['required', 'min:11', 'max:11'],
            'email' => ['email', 'nullable'],


            'former_owner_en' => ['string', 'max:50', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'former_owner_bn' => ['required', 'string', 'max:50', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],
            'former_owner_father_name_en' => ['string', 'max:50', 'regex:/^[a-zA-Z. ():]+$/', 'nullable'],
            'former_owner_father_name_bn' => ['required', 'string', 'max:50', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],
            'trimasik_tax' => ['required', 'string', 'max:20'],
            'yearly_rate' => ['required', 'string', 'max:20'],
            'yealry_tax_amount' => ['string', 'max:20', 'nullable'],
            'last_assesment_date' => ['required', 'string', 'max:20'],
            'holding_no' => ['required', 'string', 'max:30'],
            'bhumi_moja_no' => ['required', 'string', 'max:50'],
            'khotian_no' => ['required', 'string', 'max:30'],
            'dag_no' => ['required', 'string', 'max:30'],
            'land_amount' => ['required', 'string', 'max:50'],
            'dolil_datar_name' => ['string', 'max:50', 'nullable'],
            'dolil_no' => ['string', 'max:50', 'nullable'],
            'reg_office_name' => ['string', 'max:50', 'nullable'],
            'reg_date' => ['string', 'max:20', 'nullable'],
            'dolil_hold_no' => ['string', 'max:50', 'nullable'],
            'bohuthola_dalan' => ['string', 'max:50', 'nullable'],
            'ekthola_dalan' => ['string', 'max:50', 'nullable'],
            'ada_faka_ghor' => ['string', 'max:50', 'nullable'],
            'kaca_ghor' => ['string', 'max:50', 'nullable'],
            'latrin_no' => ['string', 'max:50', 'nullable'],
            'jhol_tap_no' => ['string', 'max:50', 'nullable'],
            'tubewel_no' => ['string', 'max:50', 'nullable'],
            'dokan_no' => ['string', 'max:50', 'nullable'],
            'family_no' => ['string', 'max:50', 'nullable'],
            'conditions' => ['string', 'max:100', 'nullable'],
            'monthly_rant_rate' => ['string', 'max:50', 'nullable'],
            'rant_last_date' => ['string', 'max:30', 'nullable'],
            'applicant_other_info' => ['string', 'max:100', 'nullable'],
            'govt_rent_no' => ['string', 'max:50', 'nullable'],

        ];

        if($this->pin){
            unset($validation['nid'], $validation['birth_id'], $validation['passport_no']);
        }

        return $validation;

    }
}
