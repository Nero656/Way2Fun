<?php

namespace App\Events;

use App\Models\Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentsEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    private Activity $activity;
    public int $id;

    public function __construct(Activity $activity, $id)
    {
        $this->activity = $activity;
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('activity.comment.'.$this->id);
    }

    public function broadcastAs(): string
    {
        return 'comments.event';
    }

    public function broadcastWith(): array
    {
        $this->activity->load([
            'city',
            'guide',
            'activity_date' => function ($query) {
                $query->where('event_date', '>=', now())
                    ->orderBy('event_date')->limit(6);
            }
        ]);

        $reviews = $this->activity->review()
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);

        $average_rating = $this->activity->review()->avg('rating');
        $count_review = $this->activity->review()->count();
        $count_activities = $this->activity->booking()->count();

        return [
            'activity' => $this->activity,
            'reviews' => $reviews,
            'average_rating' => $average_rating,
            'count_review' => $count_review,
            'count_activities_booking' => $count_activities,
        ];
    }
}
