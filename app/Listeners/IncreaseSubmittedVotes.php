<?php

namespace ppes\Listeners;

use ppes\Events\StudentHasVoted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncreaseSubmittedVotes
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
     * @param  StudentHasVoted  $event
     * @return void
     */
    public function handle(StudentHasVoted $event)
    {
        //
    }
}
