<?php

namespace App\Xcoins\Queries;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

class ExchangeRateQuery
{

    public function getExchangeRate()
    {
        $exchangeRate = Cache::get('exchange-rate-btc-to-usd');
        if (empty($exchangeRate)) {
            $exchangeRate = Cache::rememberForever(
                'exchange-rate-btc-to-usd',
                function () {
                    return  ExchangeRate::where(
                        [
                            'currency_code_from' => 'BTC',
                            'currency_code_to' => 'USD'
                        ]
                    )->latest()
                        ->get(['currency_code_from', 'currency_code_to', 'value'])
                        ->first();
                }
            );
        }
        return $exchangeRate;
    }
}
