<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;

class PhotoController extends Controller
{
    public function index(){
        $wallpapers = Photo::latest()->paginate(20);
        return view('wallpaper', compact('wallpapers'));
    }
}
