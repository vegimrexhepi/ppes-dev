<?php

namespace ppes\Events;

use ppes\Models\User;
use ppes\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentEvaluationStarted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $student;

    /**
     * Create a new event instance.
     *
     * @param User|\Illuminate\Database\Eloquent\Model $student
     */
    public function __construct(User $student)
    {
        $this->student = $student;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['ppes.student-evaluation-channel'];
    }

    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'ppes.student-evaluation-started';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'response' => 'Evaluating '.$this->student->first_name . ' ' . $this->student->last_name,
            'student_id' => $this->student->id
        ];
    }
}
