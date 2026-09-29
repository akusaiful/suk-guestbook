<?php

namespace App\Events;

use App\Models\SigningSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SigningSessionOpened implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public SigningSession $session
    ) {
        $this->session->load('signer');
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
        return 'signing.session.opened';
    }

    public function broadcastWith(): array
    {
        return [
            'session_id' => $this->session->id,

            'event_id' => $this->session->event_id,

            'status' => $this->session->status,

            'opened_at' =>
                $this->session->opened_at?->toIso8601String(),

            'signer' => [
                'id' => $this->session->signer->id,

                'name' =>
                    $this->session->signer->name,

                'position' =>
                    $this->session->signer->position,

                'organization' =>
                    $this->session->signer->organization,

                'photo' =>
                    $this->session->signer->photo,
            ],
        ];
    }
}