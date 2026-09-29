<?php

namespace App\Events;

use App\Models\Visitor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VisitorRegistered implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Visitor $visitor
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel(
                'guestbook.event.' . $this->visitor->event_id
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'visitor.registered';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->visitor->id,
            'event_id' => $this->visitor->event_id,
            'name' => $this->visitor->name,
            'registered_at' => $this->visitor->checked_in_at?->toIso8601String(),
        ];
    }
}