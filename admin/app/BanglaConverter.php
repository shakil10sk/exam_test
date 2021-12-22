<?php

class BanglaConverter
{
    private static $en = [0,1,2,3,4,5,6,7,8,9];
    private static $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];

    private static $enWord = [
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety'
    ];

    private static $bnWord = ['', 'এক', 'দুই', 'তিন', 'চার', 'পাঁচ', 'ছয়', 'সাত', 'আট', 'নয়', 'দশ', 'এগারো', 'বারো', 'তেরো', 'চৌদ্দ', 'পনেরো', 'ষোল', 'সতেরো', 'আঠারো', 'উনিশ','বিশ','একুশ', 'বাইশ', 'তেইশ', 'চব্বিশ', 'পঁচিশ', 'ছাব্বিশ', 'সাতাশ', 'আঠাশ', 'ঊনত্রিশ', 'ত্রিশ', 'একত্রিশ', 'বত্রিশ', 'তেত্রিশ', 'চৌত্রিশ', 'পঁয়ত্রিশ', 'ছত্রিশ', 'সাঁইত্রিশ', 'আটত্রিশ', 'ঊনচল্লিশ','চল্লিশ','একচল্লিশ', 'বিয়াল্লিশ', 'তেতাল্লিশ', 'চুয়াল্লিশ', 'পঁয়তাল্লিশ', 'ছেচল্লিশ', 'সাতচল্লিশ', 'আটচল্লিশ', 'ঊনপঞ্চাশ', 'পঞ্চাশ', 'একান্ন','বাহান্ন', 'তিপ্পান্ন', 'চুয়ান্ন', 'পঞ্চান্ন', 'ছাপ্পান্ন', 'সাতান্ন', 'আটান্ন', 'ঊনষাট','ষাট','একষট্টি', 'বাষট্টি', 'তেষট্টি', 'চৌষট্টি', 'পঁয়ষট্টি', 'ছেষট্টি', 'সাতষট্টি', 'আটষট্টি', 'ঊনসত্তর', 'সত্তর', 'একাত্তর','বাহাত্তর', 'তিয়াত্তর', 'চুয়াত্তর', 'পঁচাত্তর', 'ছিয়াত্তর', 'সাতাত্তর', 'আটাত্তর', 'ঊনআশি','আশি','একাশি', 'বিরাশি', 'তিরাশি', 'চুরাশি','পঁচাশি', 'ছিয়াশি', 'সাতাশি', 'আটাশি', 'ঊননব্বই', 'নব্বই', 'একানব্বই','বিরানব্বই', 'তিরানব্বই', 'চুরানব্বই', 'পঁচানব্বই', 'ছিয়ানব্বই', 'সাতানব্বই', 'আটানব্বই', 'নিরানব্বই'];

    public static function isValid($number)
    {
        if(!is_numeric($number)){
            return 'Given value is not a number.';
        }

        if($number > 99999999){
            return 'Given value exceded the max range.';
        }

        return true;
    }

    public static function bn_number($number)
    {
        // if(self::isValid($number) !== true){
        //     return self::isValid($number);
        // }
        
        return strtr($number, self::$bn);
    }

    public static function en_word($number)
    {
        if(self::isValid($number) !== true){
            return self::isValid($number);
        }

        if($number == 0){
            return "zero";
        }

        $txt = '';

        // core
        $core = (int)($number/10000000);

        if($core > 0){
            if($core > 20){
                $txt .= self::en_word($core) . ' core ';
            } else {
                $txt .= self::$enWord[$core] . ' core ';
            }
        }

        $core_restof = $number%10000000;

        $lakh = (int) ($core_restof/100000);

        if($lakh > 0){
            if($lakh > 20){
                $txt .= self::en_word($lakh) . ' lakh ';
            } else {
                $txt .= self::$enWord[$lakh] . ' lakh ';
            }
        }

        $lakh_restof = $core_restof%100000;

        $thousand = (int) ($lakh_restof/1000);

        if($thousand > 0){
            if($thousand > 20){
                $txt .= self::en_word($thousand) . ' thousand ';
            } else {
                $txt .= self::$enWord[$thousand] . ' thousand ';
            }
        }

        $thousand_restof = $lakh_restof%1000;
        
        $hundred = (int) ($thousand_restof/100);

        if($hundred > 0){
            if($hundred > 20){
                $txt .= self::en_word($hundred) . ' hundred ';
            } else {
                $txt .= self::$enWord[$hundred] . ' hundred ';
            }
        }

        $hundred_restof = $thousand_restof%100;

        $decimal = (int) ($hundred_restof/10);

        if($decimal > 0){
            $txt .= self::$enWord[$decimal*10] . ' ';
        }

        $decimal_restof = $hundred_restof%10;

        if($decimal_restof){
            $txt .= self::$enWord[$decimal_restof];
        }
        
        return $txt;
    }

    public static function bn_word($number)
    {
        if(self::isValid($number) !== true){
            return self::isValid($number);
        }

        if($number == 0){
            return "শূন্য";
        }

        $txt = '';

        // core
        $core = (int)($number/10000000);

        if($core > 0){
            $txt .= self::$bnWord[$core] . ' কোটি ';
        }

        $core_restof = $number%10000000;

        $lakh = (int) ($core_restof/100000);

        if($lakh > 0){
            $txt .= self::$bnWord[$lakh] . ' লক্ষ ';
        }

        $lakh_restof = $core_restof%100000;

        $thousand = (int) ($lakh_restof/1000);

        if($thousand > 0){
            $txt .= self::$bnWord[$thousand] . ' হাজার ';
        }

        $thousand_restof = $lakh_restof%1000;
        
        $hundred = (int) ($thousand_restof/100);

        if($hundred > 0){
            $txt .= self::$bnWord[$hundred] . ' শত ';
        }

        $hundred_restof = $thousand_restof%100;

        if($hundred_restof > 0){
            $txt .= self::$bnWord[$hundred_restof] . ' ';
        }
        
        return $txt;
    }

    public static function bn_others($number)
    {
        return strtr($number, self::$bn);
    }
    
}