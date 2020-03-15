<?php

namespace ppes\Listeners;

use ppes\Events\StudentJoinedEvaluation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncreaseActiveConnections
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
     * @param  StudentJoinedEvaluation  $event
     * @return void
     */
    public function handle(StudentJoinedEvaluation $event)
    {
        //
    }
}
