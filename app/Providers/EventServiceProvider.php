<?php

namespace ppes\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'ppes\Events\StudentWasBanned' => [
            'ppes\Listeners\EmailBanNotification',
        ],
        'ppes\Events\StudentEvaluationStarted' => [
            'ppes\Listeners\NotifyEnrolledStudents'
        ],
        'ppes\Events\StudentEvaluationExpired' => [
            'ppes\Listeners\NotifyStudentsForExpiration'
        ],
        'ppes\Events\StudentEvaluationFinished' => [
            'ppes\Listeners\NotifyVotingStudents'
        ],
        'ppes\Events\StudentJoinedEvaluation' => [
            'ppes\Listeners\IncreaseActiveConnections'
        ],
        'ppes\Events\StudentHasVoted' => [
            'ppes\Listeners\IncreaseSubmittedVotes'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
