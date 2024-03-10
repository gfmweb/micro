<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateCurrenciesListEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    protected $message;
    public function __construct()
    {
        $this->message = 'Обновляется список доступных валют';
    }



}
