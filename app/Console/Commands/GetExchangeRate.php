<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GetExchangeRateJob;

class GetExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:exchange-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the latest exchange rates for crypto currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new GetExchangeRateJob);
    }
}
