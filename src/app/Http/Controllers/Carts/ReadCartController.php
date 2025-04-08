<?php

namespace App\Http\Controllers\Carts;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class ReadCartController extends Controller
{
    public function index(){
        return Cart::all();
    }
}
