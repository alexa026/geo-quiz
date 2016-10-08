<?php

namespace App\Events;

use App\Events\Event;
use App\Location;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserLocationChanged extends Event implements ShouldBroadcast
{
    use SerializesModels;

    protected $userWithLocation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Location $location)
    {
        $this->userWithLocation = compact('user', 'location');
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['location'];
    }

    /**
     * Append data to the message.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return $this->userWithLocation;
    }
}
