<?php

namespace App\Http\Controllers\Carts;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class ShowCartController extends Controller
{
    public function index(Request $request){
        return Cart::showCart($request);
    }

}
