<?php

namespace App\Broadcasting;

use App\Events\ActivityUpdated;
use App\Models\Activity;
use App\Models\User;

class ActivityChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    public function updateActivity(Activity $activity): void
    {
        broadcast(new ActivityUpdated($activity));
    }

    /**
     * Authenticate the user's access to the channel.
     */
//    public function join(User $user): array|bool
//    {
//        //
//    }
}
