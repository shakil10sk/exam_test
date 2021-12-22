<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class WebFamilyRequest extends FormRequest
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
    public function rules()
    {
        return [

            'present_village_en'           => ['string','max:255','nullable'],
            'present_village_bn'           => ['required','string','max:255'],
            'present_rbs_en'               => ['string','max:255','nullable'],
            'present_rbs_bn'               => ['string','max:255','nullable'],
            'present_holding_no'           => ['string','nullable'],
            'present_ward_no'              => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'applicant_name_en'            => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'applicant_name_bn'            => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'applicant_father_name_en'     => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'applicant_father_name_bn'     => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'applicant_mobile'                       => ['nullable','min:11','max:11'],
            'applicant_email'                        => ['email','nullable'],

            'warish_name_bn.*'            => ['required'],
            'relation_bn.*'                 => ['required'],
            'relation_age.*'                => ['required'],

            'warish_name_en.*'            => ['string','nullable'],
            'relation_en.*'                 => ['string','nullable'],
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        return [

            'applicant_name_en.string'  => 'আবেদনকারীর নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'applicant_name_en.max'     => 'আবেদনকারীর নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'applicant_name_en.regex'   => 'আবেদনকারীর নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'applicant_name_bn.required'=> 'আবেদনকারীর নাম দিন বাংলায়....',
            'applicant_name_bn.string'  => 'আবেদনকারীর নাম অবশ্যই বাংলা বর্ণের হবে....',
            'applicant_name_bn.max'     => 'আবেদনকারীর নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'applicant_name_bn.regex'   => 'আবেদনকারীর নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'applicant_father_name_en.string'     => 'আবেদনকারীর পিতা/স্বামীর নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'applicant_father_name_en.max'        => 'আবেদনকারীর পিতা/স্বামীর নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'applicant_father_name_en.regex'      => 'আবেদনকারীর পিতা/স্বামীর নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'applicant_father_name_bn.required'   => 'আবেদনকারীর পিতা/স্বামীর নাম দিন বাংলায়....',
            'applicant_father_name_bn.string'     => 'আবেদনকারীর পিতা/স্বামীর নাম অবশ্যই বাংলা বর্ণের হবে....',
            'applicant_father_name_bn.max'        => 'আবেদনকারীর পিতা/স্বামীর নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'applicant_father_name_bn.regex'      => 'আবেদনকারীর পিতা/স্বামীর নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'present_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.string'   => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.max'      => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',


            'present_rbs_bn.string'   => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.max'      => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.string'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'applicant_mobile.required'                    => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'applicant_mobile.min'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'applicant_mobile.max'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'applicant_email.email'                        => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',

            'warish_name_bn.*.required'            => 'নাম দিন বাংলায়....',
            'relation_bn.*.required'                 => 'সম্পর্ক দিন বাংলায়....',
            'relation_age.*.required'                => 'বয়স দিন ইংরেজিতে....',

            'warish_name_en.*.string'            => 'নাম দিন ইংরেজিতে....',
            'relation_en.*.string'                 => 'সম্পর্ক দিন ইংরেজিতে....',
        ];
    }
}
