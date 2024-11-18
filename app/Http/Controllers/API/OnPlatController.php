<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Exomere;
use Illuminate\Routing\Route;



class OnPlatController extends Exomere
{
    public function pgInfo($storeId){
        $response = Http::get('https://dev-api.on-plat.com/onplat/out/pgInfo?storeId='.$storeId)->json();
        
        return $response;
    }
}