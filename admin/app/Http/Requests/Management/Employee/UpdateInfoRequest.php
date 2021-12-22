<?php

namespace App\Http\Requests\Management\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInfoRequest extends FormRequest
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
    public function rules($id)
    {

     
        return [

            'name'      => ['required'],
            'device_id'                 => ['sometimes,required','numeric',Rule::unique('employees')->whereNull('deleted_at')->ignore($this->id)],

            'designation_id'            => ['required'],
            'gender'                    => ['required'],
            'marital_status'            => ['required'],
            'mobile'                    => ['required','min:11','max:11'],
            'district_id'               => ['required'],
            'upazila_id'                => ['required'],
            'postal_id'                 => ['required'],
            'address'                   => ['required']
           
        ];
    }
    /**
     * Get the validation errors message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => 'নাম দিন বাংলায়....',
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

            'address.required'               => 'আপনার ঠিকানা দিন....'
         

        ];
    }
}
