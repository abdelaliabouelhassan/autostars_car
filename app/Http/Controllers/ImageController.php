<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function getCarImage($path){
        $img = Storage::get('voitures/'.$path);
        return response($img)->header('Content-Type', 'image/jpeg');
    }
}
