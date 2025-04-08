<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class StoreFavoriteController extends Controller
{
    public function index(Request $request){
        return Favorite::makeOrUpdate($request);
    }
}
