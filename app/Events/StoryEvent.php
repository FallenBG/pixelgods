<?php

namespace App\Events;

use App\StoriesEntries;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StoryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * User that sent the message
     *
     * @var User
     */
    public $user;

    /**
     * Message details
     *
     * @var StoriesEntries
     */
    public $storiesEntries;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param StoriesEntries $storiesEntries
     */
    public function __construct(User $user, StoriesEntries $storiesEntries)
    {
        $this->user = $user;
        $this->storiesEntries = $storiesEntries;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('story.'.$this->storiesEntries->story_id);
//        return new PrivateChannel('chat.'.$this->message->story_id);
    }
}
