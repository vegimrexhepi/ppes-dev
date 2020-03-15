<?php

namespace ppes\Listeners;

use ppes\Events\StudentWasBanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailBanNotification implements ShouldQueue
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
     * @param  StudentWasBanned  $event
     * @return void
     */
    public function handle(StudentWasBanned $event)
    {
        var_dump('Notify '.$event->user->first_name.' '.$event->user->last_name.' that they have been banned from the site.');
    }
}
