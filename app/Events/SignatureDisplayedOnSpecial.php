<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SignatureDisplayedOnSpecial implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $eventId,
        public int $signerId,
        public int $signatureId,
        public string $signatureUrl,
        public string $signerName,
        public string $signerPosition,
        public int $duration = 20,
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel(
                'guestbook.special.event.' . $this->eventId
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'signature.displayed.on.special';
    }

    public function broadcastWith(): array
    {
        return [
            'event_id' => $this->eventId,
            'signer_id' => $this->signerId,
            'signature_id' => $this->signatureId,
            'signature_url' => $this->signatureUrl,
            'signer' => [
                'id' => $this->signerId,
                'name' => $this->signerName,
                'position' => $this->signerPosition,
            ],
            'duration' => $this->duration,
        ];
    }
}