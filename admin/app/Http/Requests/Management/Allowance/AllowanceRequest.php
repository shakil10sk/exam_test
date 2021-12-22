<?php

namespace App\Http\Requests\Management\Allowance;

use Illuminate\Foundation\Http\FormRequest;

class AllowanceRequest extends FormRequest
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
            "type"                      => 'required',
            "name"                      => 'required|string|max:150',
            "nid"                       => 'numeric|max:99999999999999999|unique:allowances|nullable',
            "educational_qualification" => 'string|max:255|nullable',
            "father_name"               => 'required|string|max:150',
            "date_of_birth"             => 'required|date',
            "mobile"                    => 'string|max:11|min:11|nullable',
            "village"                   => 'required|string|max:150',
            "ward_no"                   => 'required',
            "amount_of_allowance"       => 'numeric|nullable',
            "bio"                       => 'string|max:500|nullable',
            "photo"                     => 'mimes:jpg,png,jpeg|nullable'
        ];
    }

    public function messages()
    {
        return [
            'type.required'      => 'ইউপি ভাতার টাইপ নির্বাচন করুন....',
            'name.required'      => 'নাম দিন বাংলায়....',
            'name.string'        => 'নাম দিন বাংলায়....',
            'name.max'           => 'পূর্ণ নাম ১৫০ অক্ষরের নিচে দিন....',

            'nid.numeric'        => 'ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.max'            => '১৭ ডিজিটের ন্যাশনাল আইডি নং দিন ইংরেজিতে....',
            'nid.unique'         => 'এই ন্যাশনাল আই ডি নং ইতিমধ্যে নেওয়া হয়েছে....',
            'educational_qualification.string' => 'শিক্ষাগত যোগ্যতা দিন....',
            'educational_qualification.max'    => 'শিক্ষাগত যোগ্যতা ২৫৫ অক্ষরের নিচে দিন....',

            'father_name.required'      => 'পিতার নাম দিন বাংলায়....',
            'father_name.string'        => 'পিতার নাম দিন বাংলায়....',
            'father_name.max'           => 'পিতার নাম ১৫০ অক্ষরের নিচে দিন....',

            'date_of_birth.required'    => 'জম্ম তারিখ দিন....',
            'date_of_birth.date'        => 'সঠিক জম্ম তারিখ দিন....',

            'mobile.string'         => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.min'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',
            'mobile.max'            => '১১ ডিজিটের মোবাইল নম্বর দিন....',

            'village.required'  => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'village.string'    => 'গ্রাম/মহল্লা দিন বাংলায়....',
            'village.max'       => 'গ্রাম/মহল্লা ২৫৫ অক্ষরের নিচে দিন....',

            'ward_no.required'  => 'ওয়ার্ড নং দিন....',

            'amount_of_allowance.numeric' => 'ভাতার পরিমান প্রদান করুন....',
            'bio.string'    => 'জীবনবৃত্তান্ত দিন....',
            'bio.max'       => 'জীবনবৃত্তান্ত ৫০০ অক্ষরের নিচে দিন....',
            'photo.mimes'   => 'ভাতা গ্রহণকারীর ফটো (jpg, png, jpeg) ফরমেট দিন....'

        ];
    }
}
