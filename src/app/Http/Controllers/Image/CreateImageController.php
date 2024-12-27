<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\ImageUploader;
use Illuminate\Http\Request;

class CreateImageController extends Controller
{
    public function index(Request $request){
        return ImageUploader::make($request);
    }
}
