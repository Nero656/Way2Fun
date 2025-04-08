<?php

namespace App\Http\Controllers\Activity;

use App\Events\CommentsEvent;
use App\Http\Controllers\Controller;
use App\Models\Activity;
class ShowActivityController extends Controller
{
    public function index(Activity $activity) {
        $activity->load([
            'city.address',
            'guide',
            'images' => function ($query) {
                $query->orderBy('activity_id');
            },
            'activity_date' => function ($query) {
                $query->where('event_date', '>=', now())
                    ->orderBy('event_date')->limit(6);
            }
        ]);

        // Получаем пагинированные отзывы отдельно
        $reviews = $activity->review()
            ->orderBy('created_at', 'desc')
            ->with('user') // Подгружаем пользователя
            ->paginate(10);

        $average_rating = $activity->review()->avg('rating');
        $count_review = $activity->review()->count();
        $count_activities = $activity->booking()->count();

        return response()->json([
            'activity' => $activity,
            'reviews' => $reviews,
            'average_rating' => $average_rating,
            'count_review' => $count_review,
            'count_activities_booking' => $count_activities,
        ]);
    }
}
