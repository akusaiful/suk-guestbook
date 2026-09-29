<?php

namespace App\Events;

use App\Models\SigningSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SigningSessionCancelled implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public SigningSession $session
    ) {
        $this->session->loadMissing('signer');
    }

    public function broadcastOn(): array
    {
        return [
            new Channel(
                'signing.event.' . $this->session->event_id
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'signing.session.cancelled';
    }

    public function broadcastWith(): array
    {
        return [
            'session_id' => $this->session->id,

            'event_id' => $this->session->event_id,

            'signer_id' => $this->session->signer_id,

            'status' => $this->session->status,

            'signer' => $this->session->signer
                ? [
                    'id' => $this->session->signer->id,
                    'name' => $this->session->signer->name,
                    'position' => $this->session->signer->position,
                    'organization' => $this->session->signer->organization,
                    'photo' => $this->session->signer->photo,
                ]
                : null,
        ];
    }
}