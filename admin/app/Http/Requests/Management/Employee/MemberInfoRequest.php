<?php

namespace App\Http\Requests\Management\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberInfoRequest extends FormRequest
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
            'name'                      => ['required'],
            // 'username'                  => ['required','string','max:100', Rule::unique('users')->whereNull('deleted_at')],
            'nid'                       => ['required','max:17', Rule::unique('employees')->whereNull('deleted_at')],
            
            'device_id'                 => ['nullable','numeric', 'unique:employees'],

            'designation_id'            => ['required'],
          
            'gender'                    => ['required'],
            'marital_status'            => ['required'],
           
            'mobile'                    => ['required','min:11','max:11'],
            'district_id'               => ['required'],
            'upazila_id'                => ['required'],
            'postal_id'                 => ['required'],
            
        ];
    }

    /**
     * Get the validation error message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'          => 'নাম দিন বাংলায়....',
            
            
            'username.required'          => 'ইউজারনেম দিন ইংরেজিতে....',
            'username.string'            => 'ইউজারনেম অবশ্যই বাংলা বর্ণের হবে....',
            'username.max'               => 'ইউজারনেম বাংলা বর্ণের ১০ শব্দের মধ্যে হবে....',
            'username.unique'            => 'এই ইউজারনেম ইতিমধ্যে নেওয়া হয়েছে....',

            'nid.required'           => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.max'                => '১৭ ডিজিটের ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.unique'             => 'এই ন্যাশনাল আই ডি নং ইতিমধ্যে নেওয়া হয়েছে....',

            'device_id.required'            => 'অনুগ্রহ করে ডিভাইস আই. ডি. নং দিন....',
            'device_id.numeric'             => 'ডিভাইস আই. ডি. নং নম্বর হবে....',
            'device_id.unique'              => 'এই ডিভাইস আই. ডি. নং ইতিমধ্যে নেওয়া হয়েছে....',

            'designation_id.required'=> 'অনুগ্রহ করে নির্বাচন করুন....',
            

            'gender.required'           => 'অনুগ্রহ করে নির্বাচন করুন....',
            'marital_status.required'   => 'অনুগ্রহ করে নির্বাচন করুন....',

           
            'mobile.required'       => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',

            'district_id.required'           => 'জেলা প্রদান করূন....',
            'upazila_id.required'            => 'উপজেলা/থানা প্রদান করূন....',
            'postal_id.required'             => 'পোস্ট অফিস প্রদান করূন....',

            'address.required'               => 'আপনার ঠিকানা দিন....',
           

        ];
    }
}
