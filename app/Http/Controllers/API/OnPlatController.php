<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Exomere;
use Exception;
use Illuminate\Routing\Route;



class OnPlatController extends Exomere
{

    public $pgInfoId;
    public $store_id;
    public $api_path;

    public function __construct() {
        
        $this->store_id = env('ON_PLAT_KEY' ,'29151');

        if(env('APP_ENV') == 'production'){
            $this->api_path = "https://pro-api.pay-onplat.com";
        }else{
            $this->api_path = "https://dev-api.on-plat.com";
        }

        $pgInfo = Http::get($this->api_path.'/onplat/out/pgInfo?storeId='.$this->store_id)->json();

        $this->pgInfoId = $pgInfo[0]['id'];    
    }

    public function userOrderPayment($data){ 

        try{
            $response = Http::post($this->api_path.'/onplat/out/receipt/oldCert', [
                'pgInfoId' => $this->pgInfoId,
                'storeId' => $this->store_id,
                'productName' => $data['productName'],
                'customerName'=> $data['customerName'],
                'customerPhone'=> $data['customerPhone'],
                'totalAmount'=> $data['totalAmount'],
                'cardNum'=> $data['cardNum'],
                'cardInst'=> $data['cardInst'],
                'expiryDate'=> $data['expiryDate'],
                'password2'=> $data['password2'],
                'userInfo'=> $data['userInfo'],
                'returnVal'=> $data['returnVal'] ?? '-',
            ]);
            
            return $response->json();
        }catch(Exception $e){
            $e->getMessage();
        }

    }
}