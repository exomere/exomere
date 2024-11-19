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

    public function userOrderPayment(){ 

        try{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->api_path.'/onplat/out/pgInfo', [
                'pgInfoId' => $this->pgInfoId,
                'storeId' => $this->store_id,
                'productName' => '상품명',
                'customerName' => '구매자명',
                'customerPhone' => '구매자연락처(숫자만 입력)',
                'totalAmount' => '결제금액',
                'cardNum' => '카드번호',
                'cardInst' => '할부개월수',
                'expiryDate' => '유효기간',
                'returnVal' => '그대로 되돌려받을 값 상점처리용',
            ]);
        }catch(Exception $e){
            $e->getMessage();
        }

    }
}