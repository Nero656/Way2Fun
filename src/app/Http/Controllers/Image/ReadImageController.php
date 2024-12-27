<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\ImageUploader;
use Illuminate\Http\Request;

class ReadImageController extends Controller
{
    public function index(ImageUploader $image){
        return $image;
    }
}
