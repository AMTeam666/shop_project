<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y')
{
   return Jalalian::forge($date)->format($format);
}

function convertArabicToEnglish($number)
{
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);

    return $number;
}
function convertPersianToEnglish($number)
{
   $number = str_replace('۰', '0', $number);
   $number = str_replace('۱', '1', $number);
   $number = str_replace('۲', '2', $number);
   $number = str_replace('۳', '3', $number);
   $number = str_replace('۴', '4', $number);
   $number = str_replace('۵', '5', $number);
   $number = str_replace('۶', '6', $number);
   $number = str_replace('۷', '7', $number);
   $number = str_replace('۸', '8', $number);
   $number = str_replace('۹', '9', $number);

   return $number;
}

function convertEnglishToPersian($number)
{
   $number = str_replace('0', '۰', $number);
   $number = str_replace('1', '۱', $number);
   $number = str_replace('2', '۲', $number);
   $number = str_replace('3', '۳', $number);
   $number = str_replace('4', '۴', $number);
   $number = str_replace('5', '۵', $number);
   $number = str_replace('6', '۶', $number);
   $number = str_replace('7', '۷', $number);
   $number = str_replace('8', '۸', $number);
   $number = str_replace('9', '۹', $number);

   return $number;
}

function priceFormat($price)
{
   $price = number_format($price, 0, '/', ',');
   $price = convertEnglishToPersian($price);

   return $price;
}

function validateNationalCode($nationalCode)
{
    $nationalCode = trim($nationalCode, ' .');
    $nationalCode = convertArabicToEnglish($nationalCode);
    $nationalCode = convertPersianToEnglish($nationalCode);
    $bannedArray = ['0000000000', '1111111111', '2222222222', '3333333333', '4444444444', '5555555555', '6666666666', '7777777777', '8888888888', '9999999999'];

    if(empty($nationalCode))
    {
        return false;
    }
    else if(count(str_split($nationalCode)) != 10)
    {
        return false;
    }
    else if(in_array($nationalCode, $bannedArray))
    {
        return false;
    }
    else{

        $sum = 0;

        for($i = 0; $i < 9; $i++)
        {
            // 1234567890
            $sum += (int) $nationalCode[$i] * (10 - $i);
        }

        $divideRemaining = $sum % 11;

        if($divideRemaining < 2)
        {
            $lastDigit = $divideRemaining;
        }
        else{
            $lastDigit = 11 - ($divideRemaining);
        }

        if((int) $nationalCode[9] == $lastDigit)
        {
            return true;
        }
        else{
            return false;
        }

    }
}


function timeAgo ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'سال',
        2592000 => 'ماه',
        604800 => 'هفته',
        86400 => 'روز',
        3600 => 'ساعت',
        60 => 'دقیقه',
        1 => 'ثانیه'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

    function bankCardCheck($card='', $irCard=true)
{
    $card = (string) preg_replace('/\D/','',$card);
    $strlen = strlen($card);
    if($irCard==true and $strlen!=16)
        return false;
    if($irCard!=true and ($strlen<13 or $strlen>19))
        return false;
    if(!in_array($card[0],[2,4,5,6,9]))
        return false;
    
    for($i=0; $i<$strlen; $i++)
    {
        $res[$i] = $card[$i];
        if(($strlen%2)==($i%2))
        {
            $res[$i] *= 2;
            if($res[$i]>9)
                $res[$i] -= 9;        
        }
    }
    return array_sum($res)%10==0?true:false;    
}

}

