<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventImagesDisplayControl implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $eventId,
        public string $action,
        public array $images = [],
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('guestbook.event.' . $this->eventId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'event.images.display.control';
    }

    public function broadcastWith(): array
    {
        return [
            'event_id' => $this->eventId,
            'action' => $this->action,
            'images' => $this->images,
        ];
    }
}
