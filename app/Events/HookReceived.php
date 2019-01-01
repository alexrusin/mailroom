<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HookReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hook;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($hook)
    {
        $this->hook = $hook;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel(auth()->user()->route_prefix);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->hook->id,
            'path' => $this->hook->path,
            'method' => $this->hook->method,
            'ip' => $this->hook->ip,
            'url' => $this->hook->url,
            'query_string' => $this->hook->query_string,
            'headers' => $this->hook->headers,
            'body' => $this->hook->body,
            'created_at' => $this->hook->created_at->toAtomString(),
            'updated_at' => $this->hook->updated_at->toAtomString()
        ];
    }
}
