<?php

namespace App\Events;

use App\Models\VisitorComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentPublished implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public VisitorComment $comment
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel(
                'guestbook.event.' . $this->comment->event_id
            ),
        ];
    }

    public function broadcastAs(): string
    {
        return 'comment.published';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->comment->id,
            'event_id' => $this->comment->event_id,
            'name' => $this->comment->name,
            'organization' => $this->comment->organization,
            'comment' => $this->comment->comment,
            'published_at' => $this->comment->published_at?->toIso8601String(),
        ];
    }
}