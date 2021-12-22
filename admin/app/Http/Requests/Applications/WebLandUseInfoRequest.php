<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class WebLandUseInfoRequest extends FormRequest
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
        $validation = [


            'gender' => ['required'],
            'marital_status' => ['required'],

            'present_village_en' => ['string', 'max:255', 'nullable'],
            'present_village_bn' => ['required', 'string', 'max:255'],
            'present_holding_no' => ['string', 'nullable'],
            'present_ward_no' => ['required'],

            'present_district_id' => ['required'],
            'present_upazila_id' => ['required'],
            'present_postoffice_id' => ['required'],




            'dag_no_cs' => ['required', 'max:50'],
            'khotian_no_cs' => ['required', 'max:50'],
            'dag_no_sa' => ['required', 'max:50'],
            'khotian_no_sa' => ['required', 'max:50'],
            'dag_no_rs' => ['required', 'max:50'],
            'khotian_no_rs' => ['required', 'max:50'],
            'mojar_name' => ['required', 'max:50'],
            'mojar_no' => ['required', 'max:50'],
            'land_amount' => ['required', 'max:50'],
            'land_type' => ['required', 'max:50'],

            'plot_proposed_use' => ['required', 'max:70'],
            'plot_owner_details' => ['required', 'max:70'],
            'owner_cue' => ['required', 'max:70'],
            'registration_date' => ['required', 'max:50'],
            'current_land_use' => ['required', 'max:50'],
            'radius_land_current_use' => ['required', 'max:50'],
            'ploat_near_road' => ['required', 'max:50'],
            'join_ploat_road' => ['required', 'max:50'],


            'main_road' => ['nullable'],
            'river_port' => ['nullable'],
            'hat_bazaar' => ['nullable'],
            'airport' => ['nullable'],
            'railway_station' => ['nullable'],
            'pond' => ['nullable'],
            'flood_control_reservoirs' => ['nullable'],
            'wetlands' => ['nullable'],
            'forest' => ['nullable'],
            'natural_waterways' => ['nullable'],
            'park' => ['nullable'],
            'hill' => ['nullable'],
            'dal' => ['nullable'],
            'historical_site' => ['nullable'],
            'key_point' => ['nullable'],
            'samorik' => ['nullable'],
            'special_area' => ['nullable'],

            'north' => ['nullable', 'max:50'],
            'east' => ['nullable', 'max:50'],
            'south' => ['nullable', 'max:50'],
            'west' => ['nullable', 'max:50'],

        ];




        return $validation;
    }

    public function messages()
    {
        return [
            'name_en.string' => 'নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_en.max' => 'নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_en.regex' => 'নাম ইংরেজি বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'name_bn.required' => 'নাম দিন বাংলায়....',
            'name_bn.string' => 'নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_bn.max' => 'নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_bn.regex' => 'নাম বাংলা বর্ণের সাথে ডট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'nid.max' => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.unique' => 'এই ন্যাশনাল আইডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'birth_id.max' => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.unique' => 'এই জন্ম নিবন্ধন নং ইতিমধ্যে নেওয়া হয়েছে....',
            'passport_no.max' => 'পাসপোর্ট নং দিন ইংরেজিতে....',
            'passport_no.unique' => 'এই পাসপোর্ট নং ইতিমধ্যে নেওয়া হয়েছে....',

            'birth_date.required' => 'জম্ম তারিখ দিন....',
            'birth_date.date' => 'দুঃক্ষিত! আপনার সঠিক জম্ম তারিখ দিন....',

            'father_name_en.string' => 'পিতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'father_name_en.max' => 'পিতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_en.regex' => 'পিতার নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'father_name_bn.required' => 'পিতার নাম দিন বাংলায়....',
            'father_name_bn.string' => 'পিতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'father_name_bn.max' => 'পিতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'father_name_bn.regex' => 'পিতার নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_en.string' => 'মাতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'mother_name_en.max' => 'মাতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_en.regex' => 'মাতার নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'mother_name_bn.required' => 'মাতার নাম দিন বাংলায়....',
            'mother_name_bn.string' => 'মাতার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'mother_name_bn.max' => 'মাতার নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'mother_name_bn.regex' => 'মাতার নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',


            'gender.required' => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.required' => 'অনুগ্রহ করে নির্বাচন করুন....',

            'present_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.max' => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'present_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.string' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'present_village_bn.max' => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_rbs_en.string' => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.max' => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'present_rbs_bn.required' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.string' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'present_rbs_bn.max' => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'present_holding_no.string' => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.required' => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.required' => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.required' => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.required' => 'পোষ্ট অফিস নির্বাচন করুন....',

            'permanent_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.max' => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.string' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.max' => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_en.string' => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.max' => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            // 'permanent_rbs_bn.required' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.string' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.max' => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_holding_no.string' => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.required' => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.required' => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.required' => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.required' => 'পোষ্ট অফিস নির্বাচন করুন....',


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

            'mojar_no.required' => 'মৌজার নং দিন',
            'mojar_no.max' => 'মৌজার নং দিন ৫০ শব্দের মধ্যে হবে....',

            'mojar_name.required' => 'মৌজার নাম  দিন',
            'mojar_name.max' => 'মৌজার নাম দিন ৫০ শব্দের মধ্যে হবে....',

            'land_amount.required' => 'আবেদনকারীর জমির পরিমাণ দিন',
            'land_amount.max' => 'আবেদনকারীর জমির পরিমাণ দিন ৫০ শব্দের মধ্যে হবে....',

            'land_type.required' => 'জমির ধরণ দিন',
            'land_type.max' => 'জমির ধরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'plot_proposed_use.required' => 'আবেদনকারী কি সূত্রে জমি অর্জন করেছেন তার বিবরণ  দিন',
            'plot_proposed_use.max' => 'প্লট /জমি এর প্রস্তাবিত ব্যবহার উল্লেখ করুন ৭০ শব্দের মধ্যে হবে....',

            'plot_owner_details.required' => 'প্লটের মালিকানার বিবরণ দিন',
            'plot_owner_details.max' => 'প্লটের মালিকানার বিবরণ দিন ৭০ শব্দের মধ্যে হবে....',

            'owner_cue.required' => 'মালিকানার সূত্র ও তারিখ উল্লেখ করুন',
            'owner_cue.max' => 'মালিকানার সূত্র ও তারিখ উল্লেখ করুন ৫০ শব্দের মধ্যে হবে....',

            'registration_date.required' => 'রেজিস্টেশনের তারিখ ও দলিল নং দিন',
            'registration_date.max' => 'রেজিস্টেশনের তারিখ ও দলিল নং দিন ৫০ শব্দের মধ্যে হবে....',

            'current_land_use.required' => 'ভূমির বর্তমান ব্যবহার উল্লেখ করুন',
            'current_land_use.max' => 'ভূমির বর্তমান ব্যবহার উল্লেখ করুন ৫০ শব্দের মধ্যে হবে....',

            'radius_land_current_use.required' => '২৫০ মিটার ব্যসার্ধে অন্তর্ভুক্ত ভূমির বর্তমান ব্যবহার উল্লেখ করুন',
            'radius_land_current_use.max' => '২৫০ মিটার ব্যসার্ধে অন্তর্ভুক্ত ভূমির বর্তমান ব্যবহার উল্লেখ করুন ৫০ শব্দের মধ্যে হবে....',

            'ploat_near_road.required' => 'প্লটের নিকটতম দুরত্বে অবস্থিত প্রধান সড়কের নাম ও প্রশস্ততা দিন',
            'ploat_near_road.max' => 'প্লটের নিকটতম দুরত্বে অবস্থিত প্রধান সড়কের নাম ও প্রশস্ততা দিন ৫০ শব্দের মধ্যে হবে....',

            'join_ploat_road.required' => 'প্লটের সংযোগ সড়কের নাম ও প্রশস্ততা দিন',
            'join_ploat_road.max' => 'প্লটের সংযোগ সড়কের নাম ও প্রশস্ততা দিন ৫০ শব্দের মধ্যে হবে....',

            'north.max' => 'উত্তর সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'east.max' => 'পূর্ব সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'south.max' => 'দক্ষিন সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',

            'west.max' => 'পশ্চিম সীমানা হইতে  বিবরণ দিন ৫০ শব্দের মধ্যে হবে....',


            'mobile.required' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email' => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',


        ];
    }
}
