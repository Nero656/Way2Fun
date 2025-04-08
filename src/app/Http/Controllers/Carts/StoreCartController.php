<?php

namespace App\Http\Controllers\Carts;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class StoreCartController extends Controller
{
    public function index(Request $request){
        return Cart::makeOrUpdate($request);
    }
}
