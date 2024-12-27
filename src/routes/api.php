<?php



use Illuminate\Http\Request;
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

// Review Controllers
use App\Http\Controllers\Review\CreateReviewController;
use App\Http\Controllers\Review\ReadReviewController;
use App\Http\Controllers\Review\UpdateReviewController;
use App\Http\Controllers\Review\DeleteReviewController;

//chat
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\GetMessageController;
use App\Http\Controllers\Chat\SendMessageController;

//images
use App\Http\Controllers\Image\CreateImageController;
use App\Http\Controllers\Image\ReadImageController;

// Role Routes
Route::prefix('roles')->group(function () {
    Route::post('/', [CreateRoleController::class, 'index']);
    Route::get('/', [ReadRoleController::class, 'index']);
    Route::put('/{role}', [UpdateRoleController::class, 'index']);
    Route::delete('/{role}', [DeleteRoleController::class,'index']);
});

Route::prefix('users')->group(function () {
//  User CRUD
    Route::get('/{user}', [ReadUserController::class, 'index']);
    Route::put('/{user}', [UpdateUserController::class, 'index']);
    // Authorization
    Route::prefix('/auth')->group(function () {
        Route::post('/register', [RegisterController::class, 'index']);
        Route::post('/login', [LoginController::class, 'index']);
        Route::post('/logout', [LogoutController::class, 'index']);
        Route::middleware('auth:api')->get('/current_user', [CurrentUserController::class, 'index']);
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
    Route::put('/{booking}', [UpdateBookingController::class, 'index']);
    Route::delete('/{booking}', [DeleteBookingController::class, 'index']);
});

// Activity Routes
Route::prefix('activities')->group(function () {
    Route::post('/', [CreateActivityController::class, 'index']);
    Route::get('/', [ReadActivityController::class, 'index']);
    Route::get('/{category}', [ActivityListController::class, 'index']);
    Route::get('/{activity}', [ShowActivityController::class, 'index']);
    Route::put('/{activity}', [UpdateActivityController::class, 'index']);
    Route::delete('/{activity}', [DeleteActivityController::class, 'index']);
});

// Review Routes
Route::prefix('reviews')->group(function () {
    Route::post('/', [CreateReviewController::class, 'index']);
    Route::get('/', [ReadReviewController::class, 'index']);
    Route::put('/{review}', [UpdateReviewController::class, 'index']);
    Route::delete('/{review}', [DeleteReviewController::class, 'index']);
});

//chats
Route::get('/chat/{userId}/{guideId}', [ChatController::class, 'index']);
Route::get('/messages/{chatId}', [GetMessageController::class, 'index']);
Route::post('/message/{chatId}', [SendMessageController::class, 'index']);

//images
Route::post('/image', [CreateImageController::class, 'index']);
Route::get('/image/{image}', [ReadImageController::class, 'index']);

