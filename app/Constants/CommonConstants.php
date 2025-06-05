<?php

namespace App\Constants;
use App\Models\ExBanks;

class CommonConstants
{
    
    public function getBankList(){
        $banks = ExBanks::all();
        $bank_list = [];
        
        foreach($banks as $bank){
             $bank_list[$bank->code] = $bank->name;
        }

        return $bank_list;
    }
}