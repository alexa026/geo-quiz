<?php

namespace App\Listeners;

use App\Events\QuestionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyOtherUsers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuestionCreated  $event
     * @return void
     */
    public function handle(QuestionCreated $event)
    {
        //
    }
}
