<?php


use App\Http\Controllers\User\GuidesListController;
use Illuminate\Support\Facades\Route;

// Role Controllers
use App\Http\Controllers\Role\ReadRoleController;
use App\Http\Controllers\Role\CreateRoleController;
use App\Http\Controllers\Role\UpdateRoleController;
use App\Http\Controllers\Role\DeleteRoleController;

// User Controllers
use App\Http\Controllers\User\ReadUserController;
use App\Http\Controllers\User\UpdateUserController;

// User Authorization Controllers
use App\Http\Controllers\User\Authorization\RegisterController;
use App\Http\Controllers\User\Authorization\LoginController;
use App\Http\Controllers\User\Authorization\LogoutController;
use App\Http\Controllers\User\Authorization\CurrentUserController;

// City Controllers
use App\Http\Controllers\City\CreateCityController;
use App\Http\Controllers\City\ReadCityController;
use App\Http\Controllers\City\UpdateCityController;
use App\Http\Controllers\City\DeleteCityController;

// Category Controllers
use App\Http\Controllers\Category\CreateCategoryController;
use App\Http\Controllers\Category\ReadCategoryController;
use App\Http\Controllers\Category\UpdateCategoryController;
use App\Http\Controllers\Category\DeleteCategoryController;

// Booking Controllers
use App\Http\Controllers\Booking\CreateBookingController;
use App\Http\Controllers\Booking\ReadBookingController;
use App\Http\Controllers\Booking\UserBookingController;
use App\Http\Controllers\Booking\UpdateBookingController;
use App\Http\Controllers\Booking\DeleteBookingController;
use App\Http\Controllers\Booking\ShowBookingController;

// Activity Controllers
use App\Http\Controllers\Activity\CreateActivityController;
use App\Http\Controllers\Activity\ReadActivityController;
use App\Http\Controllers\Activity\UpdateActivityController;
use App\Http\Controllers\Activity\DeleteActivityController;
use App\Http\Controllers\Activity\ShowActivityController;
use App\Http\Controllers\Activity\ActivityListController;
use App\Http\Controllers\Activity\ShowFoundActivity;

// AvailableSeats Controller
use App\Http\Controllers\AvailableSeats\CreateAvailableSeatController;
use App\Http\Controllers\AvailableSeats\ReadAvailableSeatController;
use App\Http\Controllers\AvailableSeats\UpdateAvailableSeatController;
use App\Http\Controllers\AvailableSeats\DeleteAvailableSeatController;

//activityDate Controllers
use App\Http\Controllers\ActivityDate\CreateActivityDateController;
use App\Http\Controllers\ActivityDate\ReadActivityDateController;

// Review Controllers
use App\Http\Controllers\Review\CreateReviewController;
use App\Http\Controllers\Review\ReadReviewController;
use App\Http\Controllers\Review\UpdateReviewController;
use App\Http\Controllers\Review\DeleteReviewController;

//chat
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\ChatListController;
use App\Http\Controllers\Chat\GetMessageController;
use App\Http\Controllers\Chat\SendMessageController;

//images
use App\Http\Controllers\Image\CreateImageController;
use App\Http\Controllers\Image\ReadImageController;

//carts
use App\Http\Controllers\Carts\ShowCartController;
use App\Http\Controllers\Carts\StoreCartController;

//favorites
use App\Http\Controllers\Favorites\StoreFavoriteController;

// Role Routes
Route::prefix('roles')->group(function () {
    Route::post('/', [CreateRoleController::class, 'index']);
    Route::get('/', [ReadRoleController::class, 'index']);
    Route::put('/{role}', [UpdateRoleController::class, 'index']);
    Route::delete('/{role}', [DeleteRoleController::class, 'index']);
});

Route::prefix('users')->group(function () {
    Route::get('/guides_list', [GuidesListController::class, 'index']);
//  User CRUD
    Route::get('/{user}', [ReadUserController::class, 'index']);
    Route::put('/{user}', [UpdateUserController::class, 'index']);
    // Authorization


    Route::prefix('/auth')->group(function () {
        Route::post('/register', [RegisterController::class, 'index']);
        Route::post('/login', [LoginController::class, 'index']);
        Route::middleware('jwt.auth')->group(function () {
            Route::get('/current_user', [CurrentUserController::class, 'index']);
            Route::post('/logout', [LogoutController::class, 'index']);
        });
    });
});

// City Routes
Route::prefix('cities')->group(function () {
    Route::post('/', [CreateCityController::class, 'index']);
    Route::get('/', [ReadCityController::class, 'index']);
    Route::put('/{city}', [UpdateCityController::class, 'index']);
    Route::delete('/{city}', [DeleteCityController::class, 'index']);
});

// Category Routes
Route::prefix('categories')->group(function () {
    Route::post('/', [CreateCategoryController::class, 'index']);
    Route::get('/', [ReadCategoryController::class, 'index']);
    Route::put('/{category}', [UpdateCategoryController::class, 'index']);
    Route::delete('/{category}', [DeleteCategoryController::class, 'index']);
});

// Booking Routes
Route::prefix('bookings')->group(function () {
    Route::post('/', [CreateBookingController::class, 'index']);
    Route::get('/', [ReadBookingController::class, 'index']);
    Route::get('/{booking}', [ShowBookingController::class, 'index']);
    Route::get('/booking/{user}', [UserBookingController::class, 'index']);
    Route::put('/{booking}', [UpdateBookingController::class, 'index']);
    Route::delete('/{booking}', [DeleteBookingController::class, 'index']);
});

// Activity Routes
Route::prefix('activities')->group(function () {
    Route::get('/', [ReadActivityController::class, 'index']);
    Route::middleware('jwt.auth')->group(function () {
        Route::post('/', function (\Illuminate\Http\Request $request) {
            if (auth()->user()->role_id == 2) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            return app(CreateActivityController::class)->index($request);
        });
        Route::put('/{activity}', [UpdateActivityController::class, 'index']);
        Route::delete('/{activity}', [DeleteActivityController::class, 'index']);
    });

    Route::get('/category/{category}', [ActivityListController::class, 'index']);
    Route::get('/city/{city}', [ActivityListController::class, 'cityList']);
    Route::get('/select/{category}', [ActivityListController::class, 'show']);
    Route::post('/search', [ShowFoundActivity::class, 'index']);
    Route::get('/activity/{activity}', [ShowActivityController::class, 'index']);
});
// Activity_date Routes
Route::prefix('activities_dates')->group(function () {
    Route::middleware('jwt.auth')->group(function () {
        Route::post('/', function (\Illuminate\Http\Request $request) {
            if (auth()->user()->role_id == 2) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            return app(CreateActivityController::class)->index($request);
        });

        Route::post('/', [CreateActivityDateController::class, 'index']);
    });

    Route::get('/', [ReadActivityDateController::class, 'index']);
});

//available-seats routes
Route::prefix('available_seats')->group(function () {
    Route::post('/', [CreateAvailableSeatController::class, 'index']);
    Route::get('/{event_date_id}/{activity_id}', [ReadAvailableSeatController::class, 'index']);
    Route::put('/{id}', [UpdateAvailableSeatController::class, 'index']);
    Route::delete('/{id}', [DeleteAvailableSeatController::class, 'index']);
});

// Review Routes
Route::prefix('reviews')->group(function () {
    Route::middleware('jwt.auth')->group(function () {
        Route::post('/', [CreateReviewController::class, 'index']);
        Route::put('/{review}', [UpdateReviewController::class, 'index']);
    });
    Route::get('/', [ReadReviewController::class, 'index']);
    Route::delete('/{review}', [DeleteReviewController::class, 'index']);
});

//chats
Route::middleware('jwt.auth')->group(function () {
    Route::get('/chat/{userId}/{guideId}', [ChatController::class, 'index']);
    Route::get('/chat/{userId}', [ChatListController::class, 'index']);
    Route::get('/messages/{chatId}', [GetMessageController::class, 'index']);
    Route::post('/message/{chatId}', [SendMessageController::class, 'index']);
});
//images
Route::post('/image', [CreateImageController::class, 'index']);
Route::get('/image/{image}', [ReadImageController::class, 'index']);

//cart
Route::get('/cart', [ShowCartController::class, 'index']);
Route::post('/cart', [StoreCartController::class, 'index']);

//favorites
Route::post('/favorites', [StoreFavoriteController::class, 'index']);


