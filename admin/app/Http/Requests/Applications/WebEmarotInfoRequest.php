<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class WebEmarotInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $validation = [

            'gender'                       => ['required'],
            'marital_status'               => ['required'],

            'present_village_en'           => ['string','max:255','nullable'],
            'present_village_bn'           => ['required','string','max:255'],
            'present_holding_no'           => ['string','nullable'],
            'present_ward_no'              => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'area_name' =>  ['required','max:50'],
            'build_type' =>  ['required'],
            'dag_no_cs' =>  ['required','max:50'],
            'khotian_no_cs' =>  ['required','max:50'],
            'dag_no_sa' =>  ['required','max:50'],
            'khotian_no_sa' =>  ['required','max:50'],
            'dag_no_rs' =>  ['required','max:50'],
            'khotian_no_rs' =>  ['required','max:50'],
            'sit_no' =>  ['required','max:50'],
            'mojar_name' =>  ['required','max:50'],
            'land_amount' =>  ['required','max:50'],
            'emarot_word_no' =>  ['required','max:20'],
            'land_earn_description' =>  ['required','max:50'],
            'road_name' =>  ['required','max:50'],
            'north' =>  ['nullable','max:50'],
            'south' =>  ['nullable','max:50'],
            'east' =>  ['nullable','max:50'],
            'west' =>  ['nullable','max:50'],
            'fast_floor' =>  ['required','max:50'],
            'other_floor' =>  ['required','max:50'],
            'total_floor' =>  ['required','max:50'],
            'site_name' =>  ['nullable','max:50'],
            'distance' =>  ['nullable','max:50'],
            'position' =>  ['nullable','max:50'],
            'spread' =>  ['nullable','max:50'],
            'near_way' =>  ['nullable','max:50'],
            'to_north' =>  ['required','max:50'],
            'to_east' =>  ['required','max:50'],
            'to_south' =>  ['required','max:50'],
            'to_west' =>  ['required','max:50'],
            'road_present_condition' =>  ['nullable','max:50'],
            'road_consider' =>  ['nullable','max:50'],
            'emarot_land' =>  ['nullable','max:50'],
            'previous_emarot_land' =>  ['nullable','max:50'],
            'electricity_line' =>  ['nullable','max:10'],
            'gass_line' =>  ['nullable','max:10'],
            'water_line' =>  ['nullable','max:10'],
            'drain_line' =>  ['nullable','max:10'],
            'ceptic_tank' =>  ['nullable','max:10'],
            'emarot_construction_start' =>  ['nullable','max:100'],
            'emarot_construction_destroy_purpose' =>  ['nullable','max:100'],
            'emarot_construction_notice_jari' =>  ['nullable','max:100'],
            'road_distance' =>  ['nullable','max:100'],
            'drain_distance' =>  ['nullable','max:100'],
            'emarot_distance' =>  ['nullable','max:100'],
            'electricity_distance' =>  ['nullable','max:100'],
            'gass_distance' =>  ['nullable','max:100'],


        ];


        return $validation;
    }

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



            'area_name.required' =>  'এলাকার নাম দিন',
            'area_name.max' =>  'এলাকার নাম দিন ৫০ শব্দের মধ্যে হবে....',

            'build_type.required' =>  'ভবনের ধরণ নির্বাচন করুন',


            'dag_no_cs.required' => 'দাগ নং-সি এস দিন',
            'dag_no_cs.max' => 'দাগ নং-সি এস দিন ৫০ শব্দের মধ্যে হবে....',

            'khotian_no_cs.required' => 'খতিয়ান নং-সি এস  দিন',
            'khotian_no_cs.max' => 'খতিয়ান নং-সি এস  দিন ৫০ শব্দের মধ্যে হবে....',

            'dag_no_sa.required' => 'দাগ নং- এস এ  দিন',
            'dag_no_sa.max' => 'দাগ নং- এস এ  দিন ৫০ শব্দের মধ্যে হবে....',

            'khotian_no_sa.required' => 'খতিয়ান নং- এস এ  দিন',
            'khotian_no_sa.max' => 'খতিয়ান নং- এস এ  দিন ৫০ শব্দের মধ্যে হবে....',

            'dag_no_rs.required' => 'দাগ নং-আর এস  দিন',
            'dag_no_rs.max' => 'দাগ নং-আর এস  দিন ৫০ শব্দের মধ্যে হবে....',

            'khotian_no_rs.required' => 'খতিয়ান নং-আর এস দিন',
            'khotian_no_rs.max' => 'খতিয়ান নং-আর এস দিন ৫০ শব্দের মধ্যে হবে....',

            'sit_no.required' => 'সিট নং দিন',
            'sit_no.max' => 'সিট নং দিন ৫০ শব্দের মধ্যে হবে....',

            'mojar_name.required' => 'মৌজার নাম  দিন',
            'mojar_name.max' => 'মৌজার নাম দিন ৫০ শব্দের মধ্যে হবে....',

            'land_amount.required' => 'আবেদনকারীর জমির পরিমাণ দিন',
            'land_amount.max' => 'আবেদনকারীর জমির পরিমাণ দিন ৫০ শব্দের মধ্যে হবে....',

            'emarot_word_no.required' => 'আবেদনকারীর ওয়ার্ড নং  দিন',
            'emarot_word_no.max' => 'আবেদনকারীর ওয়ার্ড নং  দিন ৫০ শব্দের মধ্যে হবে....',

            'land_earn_description.required' => 'আবেদনকারী কি সূত্রে জমি অর্জন করেছেন তার বিবরণ  দিন',
            'land_earn_description.max' => 'আবেদনকারী কি সূত্রে জমি অর্জন করেছেন তার বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'road_name.required' => 'রাস্তার নাম   দিন',
            'road_name.max' => 'রাস্তার নাম দিন ৫০ শব্দের মধ্যে হবে....',

            'fast_floor.required' => '১ ম তলা বিবরণ দিন',
            'fast_floor.max' => '১ ম তলা বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'other_floor.required' => 'অন্যান্য তলা বিবরণ দিন',
            'other_floor.max' => 'অন্যান্য তলা বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'total_floor.required' => 'মোট তলা  বিবরণ দিন',
            'total_floor.max' => 'মোট তলা  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'to_north.required' => 'উত্তর সীমানা হইতে  বিবরণ দিন',
            'to_north.max' => 'উত্তর সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'to_east.required' => 'পূর্ব সীমানা হইতে  বিবরণ দিন',
            'to_east.max' => 'পূর্ব সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'to_south.required' => 'দক্ষিন সীমানা হইতে  বিবরণ দিন',
            'to_south.max' => 'দক্ষিন সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'to_west.required' => 'পশ্চিম সীমানা হইতে  বিবরণ দিন',
            'to_west.max' => 'পশ্চিম সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',


            'mobile.required'                    => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email'                        => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',


        ];
    }
}
