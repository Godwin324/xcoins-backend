<?php

namespace App\Jobs;

use App\Events\ExchangeRateUpdated;
use App\Models\ExchangeRate;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GetExchangeRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $coinApi = new \CoinMarketCap\Api(config('coin_market.api_key'));
        $exchangeRate = $coinApi->tools()->priceConversion(
            ['amount' => 1, 'symbol' => 'BTC']);
        if (!empty($exchangeRate->data)) {
            $exchangeRateEntry = ExchangeRate::create(
                [
                    'currency_code_from' => "BTC",
                    'currency_code_to' => "USD",
                    'value' => $exchangeRate->data->quote->USD->price
                ]
            );

            Cache::put('exchange-rate-btc-to-usd', $exchangeRateEntry);

        }

    }
}
