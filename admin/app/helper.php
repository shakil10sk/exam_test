<?php

use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;


function unionStatusCheck()
{
    if (!DB::table('union_information')->where('union_code', auth()->user()->union_id)->first()->is_active) {
        echo "<h1 style='color:red; text-align:center;'>আপনার বকেয়া পরিশোধ করার জন্য অনুরোধ করা হল। <br> যোগাযোগের নাম্বার সমূহ: ০১৬৩৩০৩৬১৮৯, ০১৬৩৩০৩৬১৯০ বিকাশঃ ০১৭২১৫১৮৩৮১ ,রকেটঃ ০১৯১৭৫৭৯৬৪৩৬</h1> :";
        exit();
    }
}


function translateToEnglish($sentences='', $lan = 'en')
{
    $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default
    $tr->setSource('bn'); // Translate from Bangla
    $tr->setSource(); // Detect language automatically
    $tr->setTarget($lan); // Translate to Georgian

    if (is_array($sentences)) {
        $words = [];

        foreach ($sentences as $key => $item) {
            $words[$key] = $tr->translate($item);
        }

        return $words;

    } else {
        return !is_null($sentences)? $tr->translate($sentences) : '';
    }


}
