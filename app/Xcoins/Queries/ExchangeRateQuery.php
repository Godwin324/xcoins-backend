<?php

namespace App\Xcoins\Queries;

use Carbon\Carbon;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

class ExchangeRateQuery
{

    public function getExchangeRate()
    {
        $exchangeRate = Cache::get('exchange-rate-btc-to-usd');
        if (empty($exchangeRate)) {
            $exchangeRate = Cache::remember(
                'exchange-rate-btc-to-usd',
                Carbon::now()->addMinutes(5),
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
