<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebFormRequestRule extends FormRequest
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
            'present_village_en'           => ['string','max:255','nullable'],
            'present_village_bn'           => ['required','string','max:255'],
            'present_rbs_en'               => ['string','max:255','nullable'],
            'present_rbs_bn'               => ['string','max:255','nullable'],
            'present_holding_no'           => ['string','nullable'],
            'present_ward_no'              => ['required'],

            'present_district_id'          => ['required'],
            'present_upazila_id'           => ['required'],
            'present_postoffice_id'        => ['required'],

            'comment_en'                   => ['string','max:255','regex:/^[a-zA-Z. (),;:_]+$/', 'nullable'],
            'comment_bn'                   => ['string','max:255','regex:/^[\p{Bengali}. (),:;_।]{0,300}$/u', 'nullable']
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

            'comment_en.string'                  => 'ইংরেজিতে লিখুন....',
            'comment_en.max'                     => 'মন্তব্য ২৫০ অক্ষরের নিচে লিখুন ইংরেজিতে....',
            'comment_en.regex'                   => 'মন্তব্য ইংরেজি বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'comment_bn.string'                  => 'বাংলায় লিখুন....',
            'comment_bn.max'                     => 'মন্তব্য ২৫০ অক্ষরের নিচে লিখুন বাংলায়....',
            'comment_bn.regex'                   => 'মন্তব্য বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',
            ];
    }
}
