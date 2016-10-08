<?php

namespace App\Events;

use App\Events\Event;
use App\Question;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuestionCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    protected $question;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['question'];
    }

    /**
     * Append data to the event
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['question' => $this->question];
    }
}
