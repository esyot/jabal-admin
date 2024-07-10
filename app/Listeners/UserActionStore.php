<?php

namespace App\Listeners;

use App\Events\UserActions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Monitor;

class UserActionStore
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserActions $event): void
    {
        $monitor = Monitor::create([
            'user_name' => $event->name,
            'user_email' => $event->email,
            'action' => $event->action,
            'page' => $event->page,            
        ]);
    }
}
