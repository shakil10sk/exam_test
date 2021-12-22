<?php

namespace App\Http\Requests\Management\Union;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UnionInfoRequest extends FormRequest
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
            'en_name'           =>  ['required', 'string', 'max:255', 'regex:/^[a-zA-Z. ():]+$/'],
            'bn_name'           =>  ['required', 'string', 'max:255', 'regex:/^[\p{Bengali}. ():]{0,100}$/u'],

            'district_id'       => ['required'],
            'upazila_id'        => ['required'],
            'postal_id'         => ['required'],
            'postal_code'       => ['required', 'numeric', 'max:9999999'],
            'union_code'        => ['required','unique:union_information', 'numeric', 'max:9999999'],

            'village_bn'        => ['required', 'string', 'max:255', 'regex:/^[\p{Bengali}. (),:;_।]{0,255}$/u'],
            'village_en'        => ['string', 'max:255', 'regex:/^[a-zA-Z. (),:;_]{0,255}$/u', 'nullable'],
            'mobile'            => ['required', 'min:11', 'max:11', 'string'],
            'telephone'         => ['string', 'max:15','nullable'],
            'email'             => ['email', 'nullable'],
            'sub_domain'        => ['url', 'nullable'],
            'about'             => ['string', 'max:1000', 'nullable']
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
            'en_name.required'          => 'পৌরসভার নাম দিন ইংরেজি....',
            'en_name.string'            => 'পৌরসভার নাম অবশ্যই ইংরেজি বর্ণের হবে....',
            'en_name.max'               => 'পৌরসভার নাম ইংরেজি বর্ণের ৭০ শব্দের মধ্যে হবে....',
            'en_name.regex'             => 'পৌরসভার নাম ইংরেজি বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'bn_name.required'          => 'পৌরসভার নাম দিন বাংলায়....',
            'bn_name.string'            => 'পৌরসভার নাম অবশ্যই বাংলা বর্ণের হবে....',
            'bn_name.max'               => 'পৌরসভার নাম বাংলা বর্ণের ৭০ শব্দের মধ্যে হবে....',
            'bn_name.regex'             => 'পৌরসভার নাম বাংলা বর্ণের সাথে ডেট (.) ও ব্রাকেট () দেওয়া যাবে না....',

            'union_code.required'       => 'অনুগ্রহ করে পৌরসভা কোড দিন....',
            'union_code.unique'         => 'এই পৌরসভা কোড ইতিমধ্যে নেওয়া হয়েছে....',
            'union_code.numeric'        => 'পৌরসভা কোড নম্বর হবে....',
            'union_code.max'            => 'পৌরসভা কোড সর্বোচ্চ ৭ ডিজিটের হবে....',

            'district_id.required'      => 'অনুগ্রহ করে জেলা নির্বাচন করুন....',
            'upazila_id.required'       => 'অনুগ্রহ করে নির্বাচন করুন....',
            'postal_id.required'      => 'পোস্ট অফিস নির্বাচন করুন....',

            'postal_code.required'      => 'অনুগ্রহ করে পোস্টাল কোড দিন....',
            'postal_code.numeric'       => 'পোস্টাল কোড নম্বর হবে....',
            'postal_code.max'           => 'পোস্টাল কোড সর্বোচ্চ ৭ ডিজিটের হবে....',

            'village_bn.required'          => 'গ্রাম/মহল্লা নাম দিন বাংলায়....',
            'village_bn.string'            => 'গ্রাম/মহল্লা নাম দিন বাংলায়....',
            'village_bn.max'               => 'গ্রাম/মহল্লা নাম বাংলা বর্ণের ৭০ শব্দের মধ্যে হবে....',
            'village_bn.regex'             => 'গ্রাম/মহল্লা নাম বাংলা বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'village_en.string'            => 'গ্রাম/মহল্লা নাম দিন ইংরেজিতে....',
            'village_en.max'               => 'গ্রাম/মহল্লা নাম ইংরেজিতে বর্ণের ৭০ শব্দের মধ্যে হবে....',
            'village_en.regex'             => 'গ্রাম/মহল্লা নাম ইংরেজিতে বর্ণের সাথে ডেট (.), কমা (,), সেমিকোলন (;), কোলন (:), ড্যাশ (_) ও ব্রাকেট () দেওয়া যাবে না ....',

            'email.email'               => 'অনুগ্রহ করে ভ্যালিড ই-মেইল দিন....',

            'mobile.required'           => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'                => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'                => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.string'             => '১১ ডিজিটের মোবাইল নম্বর দিন....',

            'telephone.string'          => 'টেলিফোন নম্বর দিন....',
            'telephone.max'             => 'ভ্যালিড টেলিফোন নম্বর দিন....',

            'sub_domain.url'            => 'অনুগ্রহ করে ভ্যালিড ওয়েব লিংক দিন....',
            'about.string'              => 'পৌরসভা  সম্পর্কে বাংলায় লিখুন....',
            'about.max'                 => 'পৌরসভা সম্পর্কে ৫০০ অক্ষরের নিচে লিখুন বাংলায়....'

        ];
    }
}
