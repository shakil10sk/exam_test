<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebPremiseslicensInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_Of_organization_en'   => ['string', 'max:255', 'regex:/^[a-zA-Z. ()_,;:]+$/','nullable'],
            'name_Of_organization_bn'   => ['required','string', 'max:255', 'regex:/^[\p{Bengali}. (),;_:]{0,100}$/u'],

            'type_of_organization'      => ['required'],

            'name_en.*'                 => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'name_bn.*'                 => ['required','string','max:100','regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'nid.*'                     => ['numeric','max:99999999999999999', Rule::unique('citizen_information',
                'nid')->where(function ($query) {$query->whereNull('deleted_at');}), 'nullable'],
            'birth_id.*'                => ['numeric','max:99999999999999999', Rule::unique('citizen_information', 'birth_id')->where(function ($query) {$query->whereNull('deleted_at');}), 'nullable'],

            'marital_status.*'          => ['required'],
            'gender.*'                  => ['required'],
            'father_name_en.*'          => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'father_name_bn.*'          => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u', 'nullable'],
            'husband_name_en.*'         => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'husband_name_bn.*'         => ['string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u', 'nullable'],

            'mother_name_en.*'              => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'mother_name_bn.*'              => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'religion.*'                    => ['required'],
            'educational_qualification.*'   => ['string', 'max:255', 'regex:/^[\p{Bengali}. (),:;_।a-zA-Z]{0,255}$/u', 'nullable'],
            'occupation.*'                  => ['string', 'max:255', 'regex:/^[\p{Bengali}. (),:;_।a-zA-Z]{0,255}$/u', 'nullable'],
            'resident.*'                    => ['required'],
            'present_village_en.*'          => ['string','max:255','nullable'],
            'present_village_bn.*'          => ['required','string','max:255'],
            'present_rbs_en.*'              => ['string','max:255','nullable'],
            'present_rbs_bn.*'              => ['nullable','string','max:255'],
            'present_holding_no.*'          => ['string','nullable'],
            'present_ward_no.*'             => ['required'],

            'present_district_id.*'         => ['required'],
            'present_upazila_id.*'          => ['required'],
            'present_postoffice_id.*'       => ['required'],

            'permanent_village_en.*'        => ['string','max:255','nullable'],
            'permanent_village_bn.*'        => ['required','string','max:255'],
            'permanent_rbs_en.*'            => ['string','max:255','nullable'],
            'permanent_rbs_bn.*'            => ['nullable','string','max:255'],
            'permanent_holding_no.*'        => ['nullable'],
            'permanent_ward_no.*'           => ['required'],

            'permanent_district_id.*'       => ['required'],
            'permanent_upazila_id.*'        => ['required'],
            'permanent_postoffice_id.*'     => ['required'],

            'vat_id'                    => ['max:17', 'nullable'],
            'tax_id'                    => ['max:17', 'nullable'],
            'signboard_length'          => ['string','max:255', 'nullable'],
            'signboard_width'          => ['string','max:255', 'nullable'],
            'normal_signboard'          => ['string','max:255', 'nullable'],
            'lighted_signboard'          => ['string','max:255', 'nullable'],
            'agent_name_en'               => ['string','max:255', 'nullable'],
            'agent_name_bn'               => ['string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u', 'nullable'],

            'building_size'               => ['string','max:255', 'nullable'],
            'business_start_date'               => ['string','max:255', 'nullable'],
            'previous_license_data'               => ['string','max:255', 'nullable'],

            'business_type'             => ['required'],
            'capital'                   => ['string', 'max:255', 'nullable'],

            'trade_village_en'          => ['string','max:255','nullable'],
            'trade_village_bn'          => ['required','string','max:255'],
            'trade_rbs_en'              => ['string','max:255','nullable'],
            'trade_rbs_bn'              => ['nullable','string','max:255'],
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

            'name_en.*.string'                          => 'মালিকের নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_en.*.max'                             => 'মালিকের নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_en.*.regex'                           => 'মালিকের নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'name_bn.*.required'                        => 'মালিকের নাম দিন বাংলায়....',
            'name_bn.*.string'                          => 'মালিকের নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_bn.*.max'                             => 'মালিকের নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_bn.*.regex'                           => 'মালিকের নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'nid.*.numeric'                             => 'সঠিক ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.*.max'                                 => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.*.unique'                              => 'এই ন্যাশনাল আইডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'birth_id.*.numeric'                        => 'সঠিক জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.*.max'                            => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.*.unique'                         => 'এই জন্ম নিবন্ধন নং ইতিমধ্যে নেওয়া হয়েছে....',


            'father_name_en.*.string'                   => 'পিতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'father_name_en.*.max'                      => 'পিতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_en.*.regex'                    => 'পিতার নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'father_name_bn.*.required'                 => 'পিতার নাম দিন বাংলায়....',
            'father_name_bn.*.string'                   => 'পিতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'father_name_bn.*.max'                      => 'পিতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_bn.*.regex'                    => 'পিতার নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'husband_name_en.*.string'                  => 'স্বামীর নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'husband_name_en.*.max'                     => 'স্বামীর নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'husband_name_en.*.regex'                   => 'স্বামীর নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'husband_name_bn.*.string'                  => 'স্বামীর নাম অবশ্যই বাংলা বর্ণের হবে....',
            'husband_name_bn.*.max'                     => 'স্বামীর নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'husband_name_bn.*.regex'                   => 'স্বামীর নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_en.*.string'                   => 'মাতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'mother_name_en.*.max'                      => 'মাতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_en.*.regex'                    => 'মাতার নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_bn.*.required'                 => 'মাতার নাম দিন বাংলায়....',
            'mother_name_bn.*.string'                   => 'মাতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'mother_name_bn.*.max'                      => 'মাতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_bn.*.regex'                    => 'মাতার নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'religion.*.required'                       => 'অনুগ্রহ করে নির্বাচন করুন....',
            'resident.*.required'                       => 'অনুগ্রহ করে নির্বাচন করুন....',

            'gender.*.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.*.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',

            'educational_qualification.*.string'         => 'শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....',
            'educational_qualification.*.max'            => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা ৫০-৭০ শব্দের মধ্যে হবে....',
            'educational_qualification.*.regex'          => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'occupation.*.string'         => 'পেশা দিন ইংরেজিতে/বাংলায়....',
            'occupation.*.max'            => 'পেশা ইংরেজি/বাংলা ৭০ শব্দের মধ্যে হবে....',
            'occupation.*.regex'          => 'পেশা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',


            'present_village_en.*.string'           => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.*.max'              => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.*.required'         => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.string'           => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.*.max'              => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.*.string'               => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.*.max'                  => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'present_rbs_bn.*.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.string'               => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.*.max'                  => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.*.string'         => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.*.required'            => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.*.required'        => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.*.required'         => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.*.required'      => 'পোষ্ট অফিস নির্বাচন করুন....',

            'permanent_village_en.*.string'         => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.*.max'            => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_village_bn.*.required'       => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.*.string'         => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.*.max'            => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_en.*.string'             => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.*.max'                => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_rbs_bn.*.required'           => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.*.string'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.*.max'                => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_holding_no.*.required'       => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.*.required'          => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.*.required'      => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.*.required'       => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.*.required'    => 'পোষ্ট অফিস নির্বাচন করুন....',

            'trade_village_en.string'           => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'trade_village_en.max'              => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'trade_village_bn.required'         => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'trade_village_bn.string'           => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'trade_village_bn.max'              => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'trade_rbs_en.string'               => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'trade_rbs_en.max'                  => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'trade_rbs_bn.required'             => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'trade_rbs_bn.string'               => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'trade_rbs_bn.max'                  => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            // 'trade_holding_no.required'         => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'trade_ward_no.required'            => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'trade_district_id.required'        => 'জেলা নির্বাচন করুন....',
            'trade_upazila_id.required'         => 'উপজেলা/থানা নির্বাচন করুন....',
            'trade_postoffice_id.required'      => 'পোষ্ট অফিস নির্বাচন করুন....',

            'vat_id.max'                    => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',
            'tax_id.max'                    => 'ভ্যাট আইডি নং দিন ইংরেজিতে....',

            'signboard_length.string'          => 'সাইন বোর্ড দৈর্ঘ্য দিন ইংরেজিতে....',
            'signboard_length.max '          => 'সাইন বোর্ড দৈর্ঘ্য দিন ইংরেজিতে....',

            'signboard_width.string'          => 'সাইন বোর্ড প্রস্থ দিন ইংরেজিতে....',
            'signboard_width.max'          => 'সাইন বোর্ড প্রস্থ দিন ইংরেজিতে....',

            'normal_signboard.string'          => 'সাধারন সাইনবোর্ড দিন ....',
            'normal_signboard.max'          => 'সাধারন সাইনবোর্ড দিন ....',

            'lighted_signboard.string'          => 'আলোক সজ্জিত সাইনবোর্ড দিন....',
            'lighted_signboard.max'          => 'আলোক সজ্জিত সাইনবোর্ড দিন....',


            'agent_name_en.string'               => 'ম্যানেজিং এজেন্টের নাম দিন ইংরেজিতে....',
            'agent_name_en.max'               => 'ম্যানেজিং এজেন্টের নাম দিন ইংরেজিতে....',
            'agent_name_bn.string'               => 'ম্যানেজিং এজেন্টের নাম দিন বাংলায়....',
            'agent_name_bn.max'               => 'ম্যানেজিং এজেন্টের নাম দিন বাংলায়....',

            'building_size.string'               => 'ভবন/গৃহের আয়তন দিন....',
            'building_size.max'               => 'ভবন/গৃহের আয়তন দিন....',
            'business_start_date.string'               =>'ব্যবসা আরম্ভের তারিখ দিন ....',
            'business_start_date.max'               => 'ব্যবসা আরম্ভের তারিখ দিন ....',
            'previous_license_data.string'               =>'পূর্বে লাইসেন্স নবায়নের তারিখ দিন....',
            'previous_license_data.max'               => 'পূর্বে লাইসেন্স নবায়নের তারিখ দিন....',



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
