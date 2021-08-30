<?php

namespace App\Observers;

use App\Models\ExchangeRate;
use App\Events\ExchangeRateUpdated;

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
