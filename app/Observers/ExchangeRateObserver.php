<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\ExchangeRate;
use App\Events\ExchangeRateUpdated;
use Illuminate\Support\Facades\Cache;

class ExchangeRateObserver
{
    /**
     * Handle the ExchangeRate "created" event.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return void
     */
    public function created(ExchangeRate $exchangeRate)
    {
        broadcast(new ExchangeRateUpdated($exchangeRate));

        $currencyFrom = strtolower($exchangeRate->currency_code_from);
        $currencyTo = strtolower($exchangeRate->currency_code_to);
        $cacheKey = "exchange-rate-{$currencyFrom}-to-{$currencyTo}";

         Cache::put($cacheKey,$exchangeRate, Carbon::now()->addMinutes(5));
    }

    /**
     * Handle the ExchangeRate "updated" event.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return void
     */
    public function updated(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Handle the ExchangeRate "deleted" event.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return void
     */
    public function deleted(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Handle the ExchangeRate "restored" event.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return void
     */
    public function restored(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Handle the ExchangeRate "force deleted" event.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return void
     */
    public function forceDeleted(ExchangeRate $exchangeRate)
    {
        //
    }
}
