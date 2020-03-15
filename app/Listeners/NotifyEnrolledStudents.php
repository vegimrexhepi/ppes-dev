<?php

namespace ppes\Listeners;

use ppes\Events\StudentEvaluationStarted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyEnrolledStudents
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
     * @param  StudentEvaluationStarted  $event
     * @return void
     */
    public function handle(StudentEvaluationStarted $event)
    {
        $student = $event->student;
        
        echo json_encode('Student: ' . $student->first_name . ' ' . $student->last_name . 'is being evaluated.');
    }
}
