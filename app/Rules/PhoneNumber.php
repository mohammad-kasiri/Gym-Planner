<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Str;

class PhoneNumber implements Rule
{
    private string $message;


    public function passes($attribute, $value)
    {
        //Get Phone Length
        $phoneLength   = Str::length($value);
        //Get Country Code
        $countryCode   = Str::substr($value, 0               , $phoneLength-10);
        //Get Phone Number
        $phoneNumber   = Str::substr($value, $phoneLength-10 , $phoneLength);

        //Refactor Iranian Country Code
        if ($countryCode == "" || $countryCode == "0" || $countryCode== "+98") $countryCode = "98";

        //Check Length
        if ($phoneLength < 10 || $phoneLength > 15)
        {
            $this->message = "طول شماره تلفن وارد شده اشتباه است";
            return false;
        }

        //Check , is it Numeric?
        if (!is_numeric($phoneNumber))
        {
            $this->message = "شماره تلفن باید فقط شامل اعداد باشد";
            return false;
        }

        //Check Country code
        if (!$this->checkCountryCode($countryCode)) {
            $this->message = "پیش شماره ی کشور وارد شده صحیح نمی باشد";
            return false;
        }


        return true;
    }


    private function checkCountryCode($countryCode): bool
    {

        $chars  = ["00"  , "+"];

        //Refactore Country Code Format Based on "+" , "00"
        foreach ($chars as $char)
        {
            if (Str::startsWith($countryCode,$char))
                $countryCode = Str::replaceFirst($char, '', $countryCode);
        }

        //Check Country Code
        foreach ($this->validCountryCodes as $country) {
            if ($countryCode == $country['code']) return true;
        }

        return  false;
    }


    private function checkIranOperators($phoneNumber):bool
    {
        //Does Phone Number Have A Valid Operator
        foreach ($this->iranOperators as $operator) {
            if (Str::startsWith($phoneNumber, $operator))  return true;
        }

        return false;
    }



    public function message()
    {
        return $this->message;
    }


    private array $iranOperators     = [
        //irancel
        "930" , "933" , "935" , "936" , "937" , "938" , "939" , "901" , "902" , "903" , "904" , "905", "941",
        //IR-MCI
        "910" , "911" , "912" , "913" , "914" , "915" , "916" , "917" , "918" , "919" , "990" , "991" , "992" , "993" , "994",
        //Rightel
        "920" , "921" , "922",
        //Taliya
        "932" ,
        //TeleKish
        "934" ,
        //Aptel
        "99910" , "99911" , "99913" ,
        //azartel
        "99914" ,
        //SamanTel
        "99999" , "99998" , "99997" , "99996" ,
        //LOTUSTEL
        "9990" ,
        //Shatel Mobile
        "99810" , "99811" , "99812" , "99814" , "99815" ,
        //ArianTel
        "9998" ];

    private array $validCountryCodes =  [
        ['name'=>'IRAN','code'=>'98']
    ];
}
