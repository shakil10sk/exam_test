<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssociationMemberInfoRequest extends FormRequest
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



        $validation = [
            'name_en'                      => ['string','max:100','nullable'],
            'nid'                          => ['max:17',Rule::unique('association_member_list', 'nid')->whereNull('deleted_at'), 'nullable'],
            'birth_id'                     => ['max:17',Rule::unique('association_member_list', 'birth_id')->whereNull('deleted_at'),'nullable'],
            'passport_no'                  => ['string','max:17',Rule::unique('association_member_list', 'passport_no')->whereNull('deleted_at'),'nullable'],
            'birth_date'                   => ['required','date'],

            'father_name'               => ['string','max:100','nullable'],
            'mother_name'               => ['string','max:100','nullable'],

            'occupation'                   => ['string','max:255','nullable'],
            'educational_qualification'    => ['string','max:255','nullable'],
            'religion'                     => ['required'],
            'gender'                       => ['required'],
            'present_village_en'           => ['string','max:255','nullable'],
            'present_rbs_en'               => ['string','max:255','nullable'],
            'present_holding_no'           => ['string','nullable'],
            'present_ward_no'              => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'permanent_village_en'         => ['string','max:255','nullable'],
            'permanent_rbs_en'             => ['string','max:255','nullable'],
            'permanent_holding_no'         => ['string','nullable'],
            'permanent_ward_no'            => ['required'],

            'permanent_district_id'        => ['required'],
            'permanent_upazila_id'         => ['required'],
            'permanent_postoffice_id'      => ['required'],

            'mobile'                       => ['required','min:11','max:11'],
            'email'                        => ['email','nullable'],
            'chanda_amount'                        =>['required'],
            'photo'                        =>['nullable'],

        ];

        if(route('association_member_update') == url()->current())
        {
            $validation['nid'] = ['max:17',Rule::unique('association_member_list', 'nid')->ignore($this->row_id)->whereNull('deleted_at'), 'nullable'];

            $validation['birth_id'] = ['max:17',Rule::unique('association_member_list', 'birth_id')->ignore($this->row_id)->whereNull('deleted_at'),
                'nullable'];

            $validation['passport_no'] = ['string','max:17',Rule::unique('association_member_list', 'passport_no')->ignore($this->row_id)->whereNull('deleted_at'),'nullable'];
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
            'name.string'            => 'নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'name.max'               => 'নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',



            'nid.max'                   => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.unique'                => 'এই ন্যাশনাল আইডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'birth_id.max'              => 'জন্ম নিবন্ধন নং দিন ইংরেজিতে....',
            'birth_id.unique'           => 'এই জন্ম নিবন্ধন নং ইতিমধ্যে নেওয়া হয়েছে....',
            'passport_no.max'           => 'পাসপোর্ট নং দিন ইংরেজিতে....',
            'passport_no.unique'        => 'এই পাসপোর্ট নং ইতিমধ্যে নেওয়া হয়েছে....',

            'birth_date.required'       => 'জম্ম তারিখ দিন....',
            'birth_date.date'           => 'দুঃক্ষিত! আপনার সঠিক জম্ম তারিখ দিন....',

            'father_name.string'     => 'পিতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'father_name.max'        => 'পিতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',




            'mother_name.string'     => 'মাতার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'mother_name.max'        => 'মাতার নাম ইংরেজি বর্ণের ১০ শব্দের মধ্যে হবে....',



            'occupation.string'         => 'পেশা দিন ইংরেজিতে/বাংলায়....',
            'occupation.max'            => 'পেশা ইংরেজি/বাংলা ৭০ শব্দের মধ্যে হবে....',



            'educational_qualification.string'         => 'শিক্ষাগত যোগ্যতা দিন ইংরেজিতে/বাংলায়....',
            'educational_qualification.max'            => 'শিক্ষাগত যোগ্যতা ইংরেজি/বাংলা ৫০-৭০ শব্দের মধ্যে হবে....',


            'religion.required'         => 'অনুগ্রহ করে নির্বাচন করুন....',
            'gender.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',


            'present_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'present_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',



            'present_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'present_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',



            'present_holding_no.string'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'present_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'present_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'present_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'present_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'permanent_village_en.string' => 'গ্রাম/মহল্লা দিন ইংরেজিতে....',
            'permanent_village_en.max'    => 'গ্রাম/মহল্লা দিন ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',


            'permanent_rbs_en.string'   => 'রোড/ব্লক/সেক্টর দিন ইংরেজিতে....',
            'permanent_rbs_en.max'      => 'রোড/ব্লক/সেক্টর ইংরেজিতে ৭০ শব্দের মধ্যে হবে....',

            'permanent_holding_no.string'      => 'হোল্ডিং নং দিন ইংরেজিতে....',
            'permanent_ward_no.required'         => 'ওয়ার্ড নং দিন ইংরেজিতে....',

            'permanent_district_id.required'     => 'জেলা নির্বাচন করুন....',
            'permanent_upazila_id.required'      => 'উপজেলা/থানা নির্বাচন করুন....',
            'permanent_postoffice_id.required'   => 'পোষ্ট অফিস নির্বাচন করুন....',

            'mobile.required'                    => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'email.email'                        => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',
            'chanda_amount.required'                    => 'মাসিক চাঁদার সংখ্যা অংকে প্রদান করুন....'



        ];
    }
}
