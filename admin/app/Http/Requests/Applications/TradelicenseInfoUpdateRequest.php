<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TradelicenseInfoUpdateRequest extends FormRequest
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
            'organization_name_en' => ['string', 'max:255', 'nullable'],
            'organization_name_bn' => ['required', 'string', 'max:255'],

            'owner_type' => ['required'],

            'name_en.*' => ['string', 'max:100', 'nullable'],
            'name_bn.*' => ['required', 'string', 'max:100'],

            'nid.*' => ['numeric', 'max:99999999999999999', 'nullable'],


            'vat_id' => ['max:17', 'nullable'],
            'tax_id' => ['max:17', 'nullable'],

            'business_type' => ['required'],
            'capital' => ['string', 'max:255', 'nullable'],

            'office_village_en' => ['string', 'max:255', 'nullable'],
            'office_village_bn' => ['required', 'string', 'max:255'],
            'office_rbs_en' => ['string', 'max:255', 'nullable'],
            'office_rbs_bn' => ['nullable', 'string', 'max:255'],
            'office_holding_no' => ['nullable'],
            'office_ward_no' => ['required'],

            'trade_district_id' => ["required_if:trade_district_txt,==,''"],
            'trade_upazila_id' => ["required_if:trade_upazila_id_txt,==,''"],
            'trade_postoffice_id' => ["required_if:trade_postoffice_id_txt,==,''"],

            'mobile' => ['required', 'min:11', 'max:11'],
            'email' => ['email', 'nullable'],
            'tel' => ['max:20', 'nullable'],
        ];

        if ((int)$r->owner_type != 4) {
            $validation += [
                'birth_id.*' => ['numeric', 'max:99999999999999999', 'nullable'],

                'marital_status.*' => ['required'],
                'gender.*' => ['required'],
                'father_name_en.*' => ['string', 'max:100', 'nullable'],
                'father_name_bn.*' => ['required', 'string', 'max:100', 'nullable'],
                'husband_name_en.*' => ['string', 'max:100', 'nullable'],
                'husband_name_bn.*' => ['string', 'max:100', 'nullable'],

                'mother_name_en.*' => ['string', 'max:100', 'nullable'],
                'mother_name_bn.*' => ['required', 'string', 'max:100'],

                'religion.*' => ['required'],
                'educational_qualification.*' => ['string', 'max:255', 'nullable'],
                'occupation.*' => ['string', 'max:255', 'nullable'],
                'resident.*' => ['required'],
                'present_village_en.*' => ['string', 'max:255', 'nullable'],
                'present_village_bn.*' => ['required', 'string', 'max:255'],
                'present_rbs_en.*' => ['string', 'max:255', 'nullable'],
                'present_rbs_bn.*' => ['string', 'max:255', 'nullable'],
                'present_holding_no.*' => ['string', 'nullable'],
                'present_ward_no.*' => ['required'],

                'present_district_id.*' => Rule::requiredIf(empty($r->present_district_txt)),
               'present_upazila_id.*' => Rule::requiredIf(empty($r->present_upazila_txt)),
               'present_postoffice_id.*' => Rule::requiredIf(empty($r->present_postoffice_txt)),
               
               'permanent_district_id.*' => Rule::requiredIf(empty($r->permanent_district_txt)),
               'permanent_upazila_id.*' => Rule::requiredIf(empty($r->permanent_upazila_txt)),
               'permanent_postoffice_id.*' => Rule::requiredIf(empty($r->permanent_postoffice_txt)),

                'permanent_village_en.*' => ['string', 'max:255', 'nullable'],
                'permanent_village_bn.*' => ['required', 'string', 'max:255'],
                'permanent_rbs_en.*' => ['string', 'max:255', 'nullable'],
                'permanent_rbs_bn.*' => ['nullable', 'string', 'max:255'],
                'permanent_holding_no.*' => ['nullable'],
                'permanent_ward_no.*' => ['required']
            ];
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
            'organization_name_en.string' => 'প্রতিষ্ঠানের নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'organization_name_en.max' => 'প্রতিষ্ঠানের নাম ইংরেজি বর্ণের ১০০ শব্দের মধ্যে হবে....',

            'organization_name_bn.required' => 'প্রতিষ্ঠানের নাম দিন বাংলায়....',
            'organization_name_bn.string' => 'প্রতিষ্ঠানের নাম অবশ্যই বাংলা বর্ণের হবে....',
            'organization_name_bn.max' => 'প্রতিষ্ঠানের নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',

            'owner_type.required' => 'প্রতিষ্ঠানের মালিকানার ধরণ চিহ্নিত করুন....',

            'name_en.*.string' => 'মালিকের নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_en.*.max' => 'মালিকের নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',

            'name_bn.*.required' => 'মালিকের নাম দিন বাংলায়....',
            'name_bn.*.string' => 'মালিকের নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_bn.*.max' => 'মালিকের নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',

            'nid.*.max' => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.*.unique' => 'এই ন্যাশনাল আইডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'birth_id.*.max' => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.*.unique' => 'এই জন্ম নিবন্ধন নং ইতিমধ্যে নেওয়া হয়েছে....',


            'father_name_en.*.string' => 'পিতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'father_name_en.*.max' => 'পিতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',

            'father_name_bn.*.required' => 'পিতার নাম দিন বাংলায়....',
            'father_name_bn.*.string' => 'পিতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'father_name_bn.*.max' => 'পিতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',

            'husband_name_en.*.string' => 'স্বামীর নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'husband_name_en.*.max' => 'স্বামীর নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',

            'husband_name_bn.*.string' => 'স্বামীর নাম অবশ্যই বাংলা বর্ণের হবে....',
            'husband_name_bn.*.max' => 'স্বামীর নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',

            'mother_name_en.*.string' => 'মাতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'mother_name_en.*.max' => 'মাতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',

            'mother_name_bn.*.required' => 'মাতার নাম দিন বাংলায়....',
            'mother_name_bn.*.string' => 'মাতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'mother_name_bn.*.max' => 'মাতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',

            'religion.*.required' => 'অনুগ্রহ করে নির্বাচন করুন....',
            'resident.*.required' => 'অনুগ্রহ করে নির্বাচন করুন....',

            'gender.*.required' => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.*.required' => 'অনুগ্রহ করে নির্বাচন করুন....',

            'educational_qualification.*.string' => 'শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....',
            'educational_qualification.*.max' => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা ৫০-৭০ শব্দের মধ্যে হবে....',

            'occupation.*.string' => 'পেশা দিন ইংরেজিতে/বাংলায়....',
            'occupation.*.max' => 'পেশা ইংরেজি/বাংলা ৭০ শব্দের মধ্যে হবে....',


            'present_village_en.*.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.*.max' => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.*.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.string' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.max' => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.*.string' => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.*.max' => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'present_rbs_bn.*.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.string' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.max' => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.*.string' => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.*.required' => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.*.required' => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.*.required' => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.*.required' => 'পোষ্ট অফিস নির্বাচন করুন....',

            'permanent_village_en.*.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.*.max' => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_village_bn.*.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.*.string' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.*.max' => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_en.*.string' => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.*.max' => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_rbs_bn.*.required'           => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.*.string' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.*.max' => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_holding_no.*.required'       => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.*.required' => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.*.required' => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.*.required' => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.*.required' => 'পোষ্ট অফিস নির্বাচন করুন....',

            'office_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'office_village_en.max' => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'office_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'office_village_bn.string' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'office_village_bn.max' => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'office_rbs_en.string' => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'office_rbs_en.max' => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'office_rbs_bn.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'office_rbs_bn.string' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'office_rbs_bn.max' => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            // 'office_holding_no.required'         => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'office_ward_no.required' => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'trade_district_id.required' => 'জেলা নির্বাচন করুন....',
            'trade_upazila_id.required' => 'উপজেলা/থানা নির্বাচন করুন....',
            'trade_postoffice_id.required' => 'পোষ্ট অফিস নির্বাচন করুন....',

            'vat_id.max' => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',
            'tax_id.max' => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',

            'business_type.required' => 'ব্যবসার ধরন দিন বাংলায়....',

            'capital.string' => 'পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে) দিন ইংরেজিতে....',
            'capital.max' => 'পরিশোধিত মূলধন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'mobile.required' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email' => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',
            'tel.max' => 'অনুগ্রহ করে ভ্যালিড ফোন নম্বর দিন....',
        ];
    }
}
