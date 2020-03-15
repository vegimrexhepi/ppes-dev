<?php

namespace ppes\Listeners;

use ppes\Events\StudentEvaluationFinished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyVotingStudents
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
     * @param  StudentEvaluationFinished  $event
     * @return void
     */
    public function handle(StudentEvaluationFinished $event)
    {
        //
    }
}
