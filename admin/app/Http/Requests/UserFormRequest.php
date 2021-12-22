<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name_en'                      => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'name_bn'                      => ['required','string','max:100','regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'nid'                          => ['max:17', 'nullable'],
            'birth_id'                     => ['nullable','max:17'],
            'passport_no'                  => ['nullable','max:17'],
            'birth_date'                   => ['required','date'],

            'father_name_en'               => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable'],
            'father_name_bn'               => ['required','string','max:100', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],
            'mother_name_en'               => ['string','max:100','regex:/^[a-zA-Z. ():]+$/','nullable','nullable'],
            'mother_name_bn'               => ['required','string','max:100','regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'occupation'                   => ['string','max:255','regex:/^[\p{Bengali}. (),:;_।a-zA-Z]{0,255}$/u','nullable'],
            'resident'                     => ['required'],
            'educational_qualification'    => ['string','max:255','regex:/^[\p{Bengali}. (),:;_।a-zA-Z]{0,255}$/u','nullable'],
            'religion'                     => ['required'],
            'gender'                       => ['required'],
            'marital_status'               => ['required'],

            'present_village_en'           => ['string','max:255','nullable'],
            'present_village_bn'           => ['required','string','max:255'],
            'present_rbs_en'               => ['string','max:255','nullable'],
            'present_rbs_bn'               => ['string','max:255','nullable'],
            'present_holding_no'           => ['string','nullable'],
            'present_ward_no'              => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'permanent_village_en'         => ['string','max:255','nullable'],
            'permanent_village_bn'         => ['required','string','max:255'],
            'permanent_rbs_en'             => ['string','max:255','nullable'],
            'permanent_rbs_bn'             => ['nullable','string','max:255'],
            'permanent_holding_no'         => ['required'],
            'permanent_ward_no'            => ['required'],

            'permanent_district_id'        => ['required'],
            'permanent_upazila_id'         => ['required'],
            'permanent_postoffice_id'      => ['required'],

            'mobile'                       => ['required','min:11','max:11'],
            'email'                        => ['email','nullable'],
            'comment_en'                   => ['string','max:500','regex:/^[a-zA-Z. (),;:_]+$/', 'nullable'],
            'comment_bn'                   => ['string','max:500','regex:/^[\p{Bengali}. (),:;_।]{0,255}$/u', 'nullable']
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
            'name_en.string'            => 'নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name_en.max'               => 'নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_en.regex'             => 'নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'name_bn.required'          => 'নাম দিন বাংলায়....',
            'name_bn.string'            => 'নাম অবশ্যই বাংলা বর্ণের হবে....',
            'name_bn.max'               => 'নাম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'name_bn.regex'             => 'নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'nid.max'                   => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'birth_id.max'              => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'passport_no.max'           => 'পাসপোর্ট নং দিন ইংরেজিতে....',

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

            'occupation.string'         => 'পেশা দিন ইংরেজিতে/বাংলায়....',
            'occupation.max'            => 'পেশা ইংরেজি/বাংলা ৭০ শব্দের মধ্যে হবে....',
            'occupation.regex'          => 'পেশা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'resident.required'         => 'অনুগ্রহ করে নির্বাচন করুন....',

            'educational_qualification.string'         => 'শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....',
            'educational_qualification.max'            => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা ৫০-৭০ শব্দের মধ্যে হবে....',
            'educational_qualification.regex'          => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'religion.required'         => 'অনুগ্রহ করে নির্বাচন করুন....',
            'gender.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',

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

            'permanent_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_village_bn.required' => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.string'   => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'permanent_village_bn.max'      => 'গ্রাম/মহল্লা দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_rbs_bn.required' => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.string'   => 'রোড/ব্লক/সেক্টর দিন বাংলায়....',
            'permanent_rbs_bn.max'      => 'রোড/ব্লক/সেক্টর দিন বাংলায় ৭০ শব্দের মধ্যে হবে....',

            'permanent_holding_no.required'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'mobile.required'                    => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email'                        => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',

            'comment_en.string'                  => 'ইংরেজিতে লিখুন....',
            'comment_en.max'                     => 'মন্তব্য ৫০০ অক্ষরের নিচে লিখুন ইংরেজিতে....',
            'comment_en.regex'                   => 'মন্তব্য ইংরেজি বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'comment_bn.string'                  => 'বাংলায় লিখুন....',
            'comment_bn.max'                     => 'মন্তব্য ৫০০ অক্ষরের নিচে লিখুন বাংলায়....',
            'comment_bn.regex'                   => 'মন্তব্য বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',
        ];
    }

}
