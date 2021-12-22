<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RoadExcavationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $r)
    {
        $validation = [
            'name_en'                      => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'name_bn'                      => ['required','string','max:100','regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'nid'                          => ['max:17',Rule::unique('citizen_information', 'nid')->whereNull('deleted_at'), 'nullable'],

            'birth_id'                     => ['max:17',Rule::unique('citizen_information', 'birth_id')->whereNull('deleted_at'),
            'nullable'],

            'passport_no'                  => ['string','max:17',Rule::unique('citizen_information', 'passport_no')->whereNull('deleted_at'),'nullable'],

            'birth_date'                   => ['required','date'],

            'father_name_en'               => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'father_name_bn'               => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],
            'mother_name_en'               => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable','nullable'],
            'mother_name_bn'               => ['required','string','max:100','regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'gender'                       => ['required'],
            'marital_status'               => ['required'],

            'religion'                       => ['required'],
            'resident'                      => ['required'],

            'road_holding_no'              => ['numeric','required'],
            'road_cutting_amount'          => ['numeric','required'],
            'road_moholla_en'              => ['string','max:255','nullable'],
            'road_moholla_bn'              => ['required','string','max:255'],
            'road_name_en'                 => ['string','max:255','nullable'],
            'road_name_bn'                 => ['required','string','max:255'],
            'road_type'                    => ['required', 'numeric'],
            'road_cutting_cause'           => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'permanent_village_en'         => ['string','max:255','nullable'],
            'permanent_village_bn'         => ['required','string','max:255'],
            'permanent_rbs_en'             => ['string','max:255','nullable'],
            'permanent_rbs_bn'             => ['nullable','string','max:255'],
            'permanent_holding_no'         => ['string','nullable'],
            'permanent_ward_no'            => ['required'],

            'permanent_district_id'        => ['required'],
            'permanent_upazila_id'         => ['required'],
            'permanent_postoffice_id'      => ['required'],

            'mobile'                       => ['required','min:11','max:11'],
            'email'                        => ['email','nullable']
        ];

        if(route('road_update') == url()->current())
        {
            $validation['nid'] = ['max:17',Rule::unique('citizen_information', 'nid')->ignore($this->citizen_id)->whereNull('deleted_at'), 'nullable'];

            $validation['birth_id'] = ['max:17',Rule::unique('citizen_information', 'birth_id')->ignore($this->citizen_id)->whereNull('deleted_at'),
            'nullable'];

            $validation['passport_no'] = ['string','max:17',Rule::unique('citizen_information', 'passport_no')->ignore($this->citizen_id)->whereNull('deleted_at'),'nullable'];
        }

        if($r->pin){
            unset($validation['nid'], $validation['birth_id'], $validation['passport_no']);
        }

        return $validation;
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'name_en.string'            => 'নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_en.max'               => 'নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_en.regex'             => 'নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'name_bn.required'          => 'নাম দিন বাংলায়....',
            'name_bn.string'            => 'নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_bn.max'               => 'নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_bn.regex'             => 'নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'nid.max'                   => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.unique'                => 'এই ন্যাশনাল আইডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'birth_id.max'              => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.unique'           => 'এই জন্ম নিবন্ধন নং ইতিমধ্যে নেওয়া হয়েছে....',
            'passport_no.max'           => 'পাসপোর্ট নং দিন ইংরেজিতে....',
            'passport_no.unique'        => 'এই পাসপোর্ট নং ইতিমধ্যে নেওয়া হয়েছে....',

            'birth_date.required'       => 'জম্ম তারিখ দিন....',
            'birth_date.date'           => 'দুঃক্ষিত! আপনার সঠিক জম্ম তারিখ দিন....',

            'father_name_en.string'     => 'পিতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'father_name_en.max'        => 'পিতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_en.regex'      => 'পিতার নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'father_name_bn.required'   => 'পিতার নাম দিন বাংলায়....',
            'father_name_bn.string'     => 'পিতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'father_name_bn.max'        => 'পিতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_bn.regex'      => 'পিতার নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_en.string'     => 'মাতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'mother_name_en.max'        => 'মাতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_en.regex'      => 'মাতার নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_bn.required'   => 'মাতার নাম দিন বাংলায়....',
            'mother_name_bn.string'     => 'মাতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'mother_name_bn.max'        => 'মাতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_bn.regex'      => 'মাতার নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'gender.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',

            'road_holding_no.required'     => 'হোল্ডিং নং দিন',
            'road_holding_no.numeric'      => 'হোল্ডিং নং ইংরেজীতে দিন',
            'road_cutting_amount.required' => 'রাস্তা কাটা/বোরিং এর পরিমাণ দিন',
            'road_cutting_amount.numeric'  => 'রাস্তা কাটা/বোরিং এর পরিমাণ ইংরেজীতে দিন',
            'road_moholla_bn.required'     => 'মহল্লার নাম দিন বাংলায়',
            'road_name_bn.required'        => 'রাস্তার নাম দিন বাংলায়',
            'road_type.required'           => 'রাস্তার ধরন নির্বাচন করুন',
            'road_cutting_cause.required'  => 'রাস্তা কাটার কারন নির্বাচন করুন',

            'present_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.string'   => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.max'      => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'present_rbs_bn.required' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.string'   => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.max'      => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.string'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'permanent_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.string'   => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.max'      => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_rbs_bn.required' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.string'   => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.max'      => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_holding_no.string'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'mobile.required'                    => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email'                        => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....'
        ];
    }

}
