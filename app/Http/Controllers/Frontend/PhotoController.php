<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    public function index(){
        $wallpapers = Photo::latest()->paginate(20);
        return view('wallpaper', compact('wallpapers'));
    }
    public function download800x600($id, $title){
        $title = Str::of($title)->replace('-',' ');
        $image = Photo::where('id', $id)->where('title', $title)->first();
        $imageName = $image->file;
        $filePath = public_path('uploads/').$imageName;
        return Response::download($filePath);
    }
    public function download1280x1024($id, $title){
        $title = Str::of($title)->replace('-',' ');
        $image = Photo::where('id', $id)->where('title', $title)->first();
        $imageName = $image->file;
        $filePath = public_path('uploads/1280x1024/').$imageName;
        return Response::download($filePath);
    }
    public function download316x255($id, $title){
        $title = Str::of($title)->replace('-',' ');
        $image = Photo::where('id', $id)->where('title', $title)->first();
        $imageName = $image->file;
        $filePath = public_path('uploads/316x255/').$imageName;
        return Response::download($filePath);
    }
    public function download118x95($id, $title){
        $title = Str::of($title)->replace('-',' ');
        $image = Photo::where('id', $id)->where('title', $title)->first();
        $imageName = $image->file;
        $filePath = public_path('uploads/118x95/').$imageName;
        return Response::download($filePath);
    }
}
