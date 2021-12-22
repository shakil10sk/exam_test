<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class WebNewholdingInfoRequest extends FormRequest
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


    public function rules()
    {
        return [

            'gender' => ['required'],
            'marital_status' => ['required'],

            'present_village_en' => ['string', 'max:255', 'nullable'],
            'present_village_bn' => ['required', 'string', 'max:255'],
            'present_rbs_en' => ['string', 'max:255', 'nullable'],
            'present_rbs_bn' => ['nullable', 'string', 'max:255'],
            'present_holding_no' => ['string', 'nullable'],
            'present_ward_no' => ['required'],

            'present_district_id' => ['required'],
            'present_upazila_id' => ['required'],
            'present_postoffice_id' => ['required'],


            'nearby_holding_no' => ['required', 'string', 'max:50'],
            'holding_construction_date' => ['required', 'string'],

            'holding' => ['required', 'string', 'max:50'],

            'description_of_house' => ['string', 'max:100','nullable'],

            'submitted_papers' => ['nullable'],
            'loan_papers' => [ 'nullable']
        ];



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
            'passport_no.max' => 'পাসপোর্ট নং দিন ইংরেজিতে বর্ণের ১৭ শব্দের মধ্যে হবে....',
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

            'occupation.string' => 'পেশা দিন ইংরেজিতে/বাংলায়....',
            'occupation.max' => 'পেশা ইংরেজি/বাংলা ৭০ শব্দের মধ্যে হবে....',
            'occupation.regex' => 'পেশা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'resident.required' => 'অনুগ্রহ করে নির্বাচন করুন....',

            'educational_qualification.string' => 'শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....',
            'educational_qualification.max' => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা ৫০-৭০ শব্দের মধ্যে হবে....',
            'educational_qualification.regex' => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'religion.required' => 'অনুগ্রহ করে নির্বাচন করুন....',
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

            'mobile.required' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max' => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email' => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',

            'comment_en.string' => 'ইংরেজিতে লিখুন....',
            'comment_en.max' => 'মন্তব্য ২৫০ অক্ষরের নিচে লিখুন ইংরেজিতে....',
            'comment_en.regex' => 'মন্তব্য ইংরেজি বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'comment_bn.string' => 'বাংলায় লিখুন....',
            'comment_bn.max' => 'মন্তব্য ২৫০ অক্ষরের নিচে লিখুন বাংলায়....',
            'comment_bn.regex' => 'মন্তব্য বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',
            'nearby_holding_no.required' => 'প্রস্তাবিত হোল্ডিং এর পার্শ্ববর্তী হোল্ডিং নং দিন',
            'nearby_holding_no.string' => 'প্রস্তাবিত হোল্ডিং এর পার্শ্ববর্তী হোল্ডিং নং দিন',
            'nearby_holding_no.max' =>'প্রস্তাবিত হোল্ডিং এর পার্শ্ববর্তী হোল্ডিং ২৫০ অক্ষরের নিচে লিখুন ',

            'holding_construction_date.required' => 'প্রস্তাবিত হোল্ডিং এর নির্মাণ তারিখ দিন',
            'holding_construction_date.string' => 'প্রস্তাবিত হোল্ডিং এর নির্মাণ তারিখ দিন',

            'holding.required' => 'প্রস্তাবিত হোল্ডিং দিন ...',
            'holding.string' => 'প্রস্তাবিত হোল্ডিং দিন ইংরেজিতে...',
            'holding.max' => 'প্রস্তাবিত হোল্ডিং দিন ৫০ অক্ষরের নিচে লিখুন...',

            'description_of_house.string' =>'ঘরের পূর্ণ বিবরণ দিন ইংরেজিতে',
            'description_of_house.max' => 'ঘরের পূর্ণ বিবরণ দিন ৫০ অক্ষরের নিচে লিখুন ..',

        ];
    }
}
