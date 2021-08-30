<?php

namespace App\Http\Controllers\Api;


use App\Models\ExchangeRate;
use App\Http\Controllers\Controller;
use App\Models\Enums\CryptoCurrencyEnum;
use App\Xcoins\Queries\ExchangeRateQuery;
use Symfony\Component\HttpFoundation\Response;

class ExchangeRateController extends Controller
{

    public function getExchangeRate()
    {
        $btcToUsdExchangeRate = (new ExchangeRateQuery)->getExchangeRate();
        return response()->json($btcToUsdExchangeRate, Response::HTTP_OK);
    }


}
