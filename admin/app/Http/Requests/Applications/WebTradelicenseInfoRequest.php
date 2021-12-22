<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class WebTradelicenseInfoRequest extends FormRequest
{

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
            'name_Of_organization_en'   => ['string', 'max:255', 'regex:/^[a-zA-Z. ()_,;:]+$/','nullable'],
            'name_Of_organization_bn'   => ['required','string', 'max:255', 'regex:/^[\p{Bengali}. (),;_:]{0,100}$/u'],

            'type_of_organization'      => ['required'],
            'marital_status.*'          => ['required'],
            'gender.*'                  => ['required'],

            'husband_name_en.*'         => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'husband_name_bn.*'         => ['string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u', 'nullable'],

            'present_village_en.*'          => ['string','max:255','nullable'],
            'present_village_bn.*'          => ['required','string','max:255'],
            'present_rbs_en.*'              => ['string','max:255','nullable'],
            'present_rbs_bn.*'              => ['string','max:255','nullable',],
            'present_holding_no.*'          => ['string','nullable'],
            'present_ward_no.*'             => ['required'],

            'present_district_id.*'         => ['required'],
            'present_upazila_id.*'          => ['required'],
            'present_postoffice_id.*'       => ['required'],

            'vat_id'                    => ['max:17', 'nullable'],
            'tax_id'                    => ['max:17', 'nullable'],

            'business_type'             => ['required'],
            'capital'                   => ['string', 'max:255', 'nullable'],

            'trade_village_en'          => ['string','max:255','nullable'],
            'trade_village_bn'          => ['required','string','max:255'],
            'trade_rbs_en'              => ['string','max:255','nullable'],
            'trade_rbs_bn'              => ['string','max:255','nullable'],
            'trade_holding_no'          => ['nullable'],
            'trade_ward_no'             => ['required'],

            'trade_district_id'         => ['required'],
            'trade_upazila_id'          => ['required'],
            'trade_postoffice_id'       => ['required'],

            'mobile'                    => ['required','min:11','max:11'],
            'email'                     => ['email','nullable'],
            'tel'                       => ['max:20', 'nullable'],
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
            'name_Of_organization_en.string'            => 'প্রতিষ্ঠানের নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_Of_organization_en.max'               => 'প্রতিষ্ঠানের নাম ইংরেজি বর্ণের ১০০ শব্দের মধ্যে হবে....',
            'name_Of_organization_en.regex'             => 'প্রতিষ্ঠানের নাম ইংরেজি বর্ণের সাথে ডট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না....',

            'name_Of_organization_bn.required'          => 'প্রতিষ্ঠানের নাম দিন বাংলায়....',
            'name_Of_organization_bn.string'            => 'প্রতিষ্ঠানের নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_Of_organization_bn.max'               => 'প্রতিষ্ঠানের নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_Of_organization_bn.regex'             => 'প্রতিষ্ঠানের নাম বাংলা বর্ণের সাথে ডট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না....',

            'type_of_organization.required'             => 'প্রতিষ্ঠানের মালিকানার ধরণ চিহ্নিত করুন....',

            'husband_name_en.*.string'                  => 'স্বামীর নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'husband_name_en.*.max'                     => 'স্বামীর নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'husband_name_en.*.regex'                   => 'স্বামীর নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'husband_name_bn.*.string'                  => 'স্বামীর নাম অবশ্যই বাংলা বর্ণের হবে....',
            'husband_name_bn.*.max'                     => 'স্বামীর নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'husband_name_bn.*.regex'                   => 'স্বামীর নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'gender.*.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.*.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',


            'present_village_en.*.string'           => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.*.max'              => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.*.required'         => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.string'           => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.max'              => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.*.string'               => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.*.max'                  => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_bn.*.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.string'               => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.max'                  => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.*.string'         => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.*.required'            => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.*.required'        => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.*.required'         => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.*.required'      => 'পোষ্ট অফিস নির্বাচন করুন....',

            'trade_village_en.string'           => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'trade_village_en.max'              => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'trade_village_bn.required'         => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'trade_village_bn.string'           => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'trade_village_bn.max'              => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'trade_rbs_en.string'               => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'trade_rbs_en.max'                  => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'trade_rbs_bn.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'trade_rbs_bn.string'               => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'trade_rbs_bn.max'                  => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'trade_holding_no.required'         => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'trade_ward_no.required'            => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'trade_district_id.required'        => 'জেলা নির্বাচন করুন....',
            'trade_upazila_id.required'         => 'উপজেলা/থানা নির্বাচন করুন....',
            'trade_postoffice_id.required'      => 'পোষ্ট অফিস নির্বাচন করুন....',

            'vat_id.max'                    => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',
            'tax_id.max'                    => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',

            'business_type.required'          => 'ব্যবসার ধরন দিন বাংলায়....',

            'capital.string'                        => 'পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) দিন ইংরেজিতে....',
            'capital.max'                           => 'পরিশোধিত মূলধন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'mobile.required'                       => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                            => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                            => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email'                           => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',
            'tel.max'                               => 'অনুগ্রহ করে ভ্যালিড ফোন নম্বর দিন....',
        ];
    }
}
