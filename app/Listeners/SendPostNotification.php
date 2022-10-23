<?php

namespace App\Listeners;

use App\Events\PostProcessed;
use App\Mail\UsreMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendPostNotification
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
     * @param  \App\Events\PostProcessed  $event
     * @return void
     */
    public function handle(PostProcessed $event)
    {
        // \Mail::to(Auth::user()->email)->send(new UsreMail($event->post)); // Sending mail only login user.

        $users = User::all(); // Sending mail all register user.
        foreach ($users as $user) {
            \Mail::to($user->email)->send(new UsreMail($event->post));
        }
    }
}
