<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExchangeRateUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private $exchangeRate;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function broadcastWith()
    {

        return [
            "rate" =>
            [
                'currency_code_from' => $this->exchangeRate->currency_code_from,
                'currency_code_to' => $this->exchangeRate->currency_code_to,
                'value' => $this->exchangeRate->value
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('exchange-rate-channel');
    }

    public function broadcastAs()
    {
        return "rate";
    }
}
